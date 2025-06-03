document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".dashboard-card");
    cards.forEach((card) => {
        card.addEventListener("mouseenter", () => {
            card.style.transform = "translateY(-5px)";
        });
        card.addEventListener("mouseleave", () => {
            card.style.transform = "translateY(0)";
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Quick Actions toggle
    const toggleBtn = document.getElementById("toggleActions");
    const container = document.querySelector(".quick-actions-container");
    const icon = toggleBtn.querySelector("i");
    let isCollapsed = false;

    // Set initial height
    container.style.maxHeight = container.scrollHeight + "px";

    toggleBtn.addEventListener("click", function () {
        isCollapsed = !isCollapsed;

        if (isCollapsed) {
            container.style.maxHeight = "0px";
            container.classList.add("collapsed"); // Add collapsed class
            icon.classList.remove("fa-chevron-down");
            icon.classList.add("fa-chevron-up");
        } else {
            container.style.maxHeight = container.scrollHeight + "px";
            container.classList.remove("collapsed"); // Remove collapsed class
            icon.classList.remove("fa-chevron-up");
            icon.classList.add("fa-chevron-down");
        }
    });

    // Low Stock toggle
    const toggleLowStockBtn = document.getElementById("toggleLowStock");
    const lowStockContainer = document.querySelector(".low-stock-container");
    const lowStockIcon = toggleLowStockBtn.querySelector("i");
    let isLowStockCollapsed = false;

    // Set initial height for low stock container
    lowStockContainer.style.maxHeight = lowStockContainer.scrollHeight + "px";

    toggleLowStockBtn.addEventListener("click", function () {
        isLowStockCollapsed = !isLowStockCollapsed;

        if (isLowStockCollapsed) {
            lowStockContainer.style.maxHeight = "0px";
            lowStockContainer.classList.add("collapsed"); // Add collapsed class
            lowStockIcon.classList.remove("fa-chevron-down");
            lowStockIcon.classList.add("fa-chevron-up");
        } else {
            lowStockContainer.style.maxHeight =
                lowStockContainer.scrollHeight + "px";
            lowStockContainer.classList.remove("collapsed"); // Remove collapsed class
            lowStockIcon.classList.remove("fa-chevron-up");
            lowStockIcon.classList.add("fa-chevron-down");
        }
    });

    // Add hover effect
    const actionBtns = document.querySelectorAll(".action-btn");
    actionBtns.forEach((btn) => {
        btn.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-2px)";
        });

        btn.addEventListener("mouseleave", function () {
            this.style.transform = "translateY(0)";
        });
    });
});
