$(function () {
    var editItemId = 0;
    $("#addCategoryFrom").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/categories/add",
            data: formData,
            type: "POST",
            processData: false, // Important: Don't process the data
            contentType: false,
            success: function (response) {
                $("#addCategoryFrom")[0].reset();
                toastr.options = {
                    progressBar: true,
                    closeButton: true,
                    timeOut: 2000,
                };
                if (response.status === true) {
                    toastr.success(response.message, "Success");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    toastr.error(response.message, "Error");
                }
            },
            error: function (errors) {
                const errorMessages = Object.values(
                    errors?.responseJSON?.errors
                ).flat();
                toastr.options = {
                    progressBar: true,
                    closeButton: true,
                };
                for (let i = 0; i < errorMessages.length; i++) {
                    toastr.error(errorMessages[i], "Error");
                }
            },
        });
    });

    $(".delete-category").on("click", function (event) {
        event.preventDefault();
        editItemId = $(this).data("category-id");
        $("#deleteCategoryModal").modal("show");
    });
    $("#deleteCategoryButton").click(function (e) {
        e.preventDefault();
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "/categories/" + editItemId,
            type: "DELETE",
            data: {
                _token: token,
            },
            success: function (response) {
                $("#deleteCategoryModal").modal("hide");

                toastr.options = {
                    progressBar: true,
                    closeButton: true,
                    timeOut: 2000,
                };
                if (response.status == true) {
                    toastr.success(response.message, "Success");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    toastr.error(response.message, "Error");
                }
            },
            error: function (data) {
                const errorMessages = Object.values(
                    errors?.responseJSON?.errors
                ).flat();
                toastr.options = {
                    progressBar: true,
                    closeButton: true,
                };
                for (let i = 0; i < errorMessages.length; i++) {
                    toastr.error(errorMessages[i], "Error");
                }
            },
        });
    });

    $(".editCategory").on("click", function (event) {
        editItemId = $(this).data("category-id");

        $.ajax({
            url: "/categories/" + editItemId,
            type: "GET",
            success: function (response) {
                $("#editCategoryModal").modal("show");
                $("#editCategoryModal #name").val(response.name);
            },
            error: function (xhr) {
                toastr.error(response.message, "Error");
            },
        });
    });
    $("#editCategoryForm").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/categories/" + editItemId,
            data: formData,
            type: "POST",
            processData: false, // Important: Don't process the data
            contentType: false,
            success: function (response) {
                $("#editCategoryModal").modal("hide");
                $("#editCategoryForm")[0].reset();
                toastr.options = {
                    progressBar: true,
                    closeButton: true,
                    timeOut: 2000,
                };
                if (response.status === true) {
                    toastr.success(response.message, "Success");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    toastr.error(response.message, "Error");
                }
            },
            error: function (errors) {
                console.log(errors);
                const errorMessages = Object.values(
                    errors?.responseJSON?.errors
                ).flat();
                toastr.options = {
                    progressBar: true,
                    closeButton: true,
                };
                for (let i = 0; i < errorMessages.length; i++) {
                    toastr.error(errorMessages[i], "Error");
                }
            },
        });
    });
});
