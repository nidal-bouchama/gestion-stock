$(document).ready(function () {
    // Initialize DataTable with improved performance
    const table = $("#categoriesTable").DataTable({
        pageLength: 10,
        ordering: true,
        searching: true,
        responsive: true,
        processing: true,
        dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search categories...",
            lengthMenu: "Show _MENU_ entries",
        },
        initComplete: function () {
            $(".dataTables_filter input").addClass("form-control-sm");
            $(".dataTables_length select").addClass("form-select-sm");
        },
    });

    // Form validation and submission
    const form = $("#categoryForm");
    const submitBtn = $("#submitBtn");

    form.on("submit", function (e) {
        e.preventDefault();

        const nameInput = $("#name");
        if (!nameInput.val().trim()) {
            nameInput.addClass("is-invalid");
            return;
        }

        submitBtn
            .prop("disabled", true)
            .html('<i class="fas fa-spinner fa-spin me-2"></i> Saving...');

        $.ajax({
            url: form.attr("action"),
            method: "POST",
            data: form.serialize(),
            success: function (response) {
                table.ajax.reload();
                form[0].reset();
                submitBtn
                    .html('<i class="fas fa-check me-2"></i> Saved!')
                    .removeClass("btn-primary")
                    .addClass("btn-success");

                setTimeout(() => {
                    submitBtn
                        .prop("disabled", false)
                        .html('<i class="fas fa-save me-2"></i> Save Category')
                        .removeClass("btn-success")
                        .addClass("btn-primary");
                }, 2000);
            },
            error: function (xhr) {
                submitBtn
                    .prop("disabled", false)
                    .html('<i class="fas fa-save me-2"></i> Save Category');
                alert("Error saving category: " + xhr.responseText);
            },
        });
    });

    // Real-time validation
    $("#name").on("input", function () {
        $(this).removeClass("is-invalid");
    });

    // Delete handler
    $(".delete-btn").on("click", function () {
        const categoryId = $(this).data("id");
        if (confirm("Are you sure you want to delete this category?")) {
            $.post(`/categories/${categoryId}`, {
                _token: "{{ csrf_token() }}",
                _method: "DELETE",
            })
                .done(function () {
                    window.location.reload();
                })
                .fail(function () {
                    alert("Error deleting category");
                });
        }
    });

    // Edit handler
    $(".edit-btn").on("click", function () {
        const categoryId = $(this).data("id");
        window.location.href = `/categories/${categoryId}/edit`;
    });
});
