$(function () {
    $("#addCustomProduct").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/custom_products/add",
            data: formData,
            type: "POST",
            processData: false,
            contentType: false,
            success: function (response) {
                $("#addCustomProduct")[0].reset();
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

    $(".delete-product").on("click", function (event) {
        event.preventDefault();
        editItemId = $(this).data("product-id");
        $("#deleteProductModal").modal("show");
    });
    $("#deleteCusProductButton").click(function (e) {
        e.preventDefault();
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "/custom_products/delete/" + editItemId,
            type: "DELETE",
            data: {
                _token: token,
            },
            success: function (response) {
                $("#deleteProductModal").modal("hide");

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

    $(".editProduct").on("click", function (event) {
        editItemId = $(this).data("product-id");

        $.ajax({
            url: "/custom_products/" + editItemId,
            type: "GET",
            success: function (response) {
                $("#editProductModal").modal("show");
                $("#editProductModal #title").val(response.title);
                $("#editProductModal #color").val(response.color);
                $("#editProductModal #price").val(response.price);
                $("#editProductModal #description").val(response.description);
            },
            error: function (xhr) {
                toastr.error(response.message, "Error");
            },
        });
    });
    $("#editProductForm").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/custom_products/" + editItemId,
            data: formData,
            type: "POST",
            processData: false, // Important: Don't process the data
            contentType: false,
            success: function (response) {
                $("#editProductModal").modal("hide");

                $("#editProductForm")[0].reset();
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
