$(function () {
    var editItemId = 0;
    var dataAttributeId = 0;

    $(".addSize").on("click", function (event) {
        event.preventDefault();
        dataAttributeId = $(this).data("bs-size");
        console.log(dataAttributeId);
        $("#addCustomSizeModal").modal("show");
    });
    $("#addCustomSizeForm").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/add_size_of_custom_product/" + dataAttributeId,
            data: formData,
            type: "POST",
            processData: false, // Important: Don't process the data
            contentType: false,
            success: function (response) {
                $("#addCustomSizeModal").modal("hide");

                $("#addCustomSizeForm")[0].reset();
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
});
