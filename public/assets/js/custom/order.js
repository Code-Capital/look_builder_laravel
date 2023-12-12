$(function () {
    var dataAttributeId = 0;
    var editItemId = 0;
    $(".deliverOrder").on("click", function (event) {
        editItemId = $(this).data("order-id");
        $("#deliveredModal").modal("show");
        $("#deliveredModal #order_uuid").val(editItemId);
    });
    $("#deliverOrderForm").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/order/mark_delivered/" + editItemId,
            data: formData,
            type: "POST",
            processData: false, // Important: Don't process the data
            contentType: false,
            success: function (response) {
                $("#deliveredModal").modal("hide");

                $("#deliverOrderForm")[0].reset();
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
