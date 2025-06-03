// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute("href")).scrollTop = 0;
        document.querySelector(this.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
        });
    });
});

// Animate statistics on scroll
const stats = document.querySelectorAll(".stat h3");
let animated = false;

function animateStats() {
    if (animated) return;

    stats.forEach((stat) => {
        const value = parseFloat(
            stat.innerText.replace(/,/g, "").replace(/\+/g, "")
        );
        let current = 0;
        const increment = value / 50;
        const duration = 2000;
        const interval = duration / 50;

        const counter = setInterval(() => {
            current += increment;
            if (current >= value) {
                stat.innerText = stat.innerText.includes("+")
                    ? Math.floor(value).toLocaleString() + "+"
                    : Math.floor(value).toLocaleString();
                clearInterval(counter);
            } else {
                stat.innerText = Math.floor(current).toLocaleString();
            }
        }, interval);
    });
    animated = true;
}

// Intersection Observer for animations
const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains("stats-section")) {
                    animateStats();
                } else {
                    entry.target.classList.add("animate");
                }
            }
        });
    },
    { threshold: 0.2 }
);

// Observe elements for animation
document
    .querySelectorAll(".feature-card, .testimonial-card, .stats-section")
    .forEach((element) => {
        observer.observe(element);
    });

// Add scroll-based navbar transparency
const header = document.querySelector("header");
window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
        header.classList.add("scrolled");
    } else {
        header.classList.remove("scrolled");
    }
});

// Add hover effect to CTA button
const ctaButton = document.querySelector(".cta-btn");
if (ctaButton) {
    ctaButton.addEventListener("mouseenter", () => {
        ctaButton.style.transform = "translateY(-3px)";
    });
    ctaButton.addEventListener("mouseleave", () => {
        ctaButton.style.transform = "translateY(0)";
    });
}
