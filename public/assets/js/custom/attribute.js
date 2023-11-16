$(function () {
    $("#addBtn").click(function () {
        $(".appendCol").append(
            "<input name='attributes[]' type='text' class='form-control mb-3'>"
        );
    });

    $("#removeBtn").click(function () {
        $(".appendCol input:last").remove();
    });

    $("#addAttributeForm").on("submit", function (event) {
        console.log("hi");
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/attributes/add",
            data: formData,
            type: "POST",
            processData: false, // Important: Don't process the data
            contentType: false,
            success: function (response) {
                console.log(response);
                $("#addAttributeForm")[0].reset();
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
