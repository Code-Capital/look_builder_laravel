$(function () {
    $("#addLookBuilderProduct").on("submit", function (event) {
        console.log("hi");
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/look_builder_products/add",
            data: formData,
            type: "POST",
            processData: false, // Important: Don't process the data
            contentType: false,
            success: function (response) {
                $("#addLookBuilderProduct")[0].reset();
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
    $("#hello").on("click", function () {
        toastr.options = {
            progressBar: true,
            closeButton: true,
            backgroundColor: "#4CAF50 !important", // Set your desired background color here
        };
        toastr.success("Hello, toastr!", "Greetings");
    });
});
