$(function () {
    var editItemId = 0;

    $("#addBtn").click(function () {
        $(".input-rows").append(
            "<div class='row mb-3'>" +
                "<div class='col-lg-4 appendCol'>" +
                "<input name='name[]' type='text' class='form-control mb-2' placeholder='Name'>" +
                "<input name='description[]' type='text' class='form-control mb-2' placeholder='Description'>" +
                "</div>" +
                "</div>"
        );
    });
    $("#removeBtn").click(function () {
        $(".input-rows .row:last").remove();
    });

    $("#addAttributeForm").on("submit", function (event) {
        console.log("hi");
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/custom_arrtibutes/add",
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

    $(".editAttribute").on("click", function (event) {
        editItemId = $(this).data("attribute-id");
        $.ajax({
            url: "/custom_arrtibutes/" + editItemId,
            type: "GET",
            success: function (response) {
                $("#editAttributeModal").modal("show");
                $("#editAttributeModal #name").val(response.name);
                $("#editAttributeModal #description").val(response.description);
            },
            error: function (xhr) {
                toastr.error(response.message, "Error");
            },
        });
    });
    $("#editAttributeForm").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/custom_arrtibutes/" + editItemId,
            data: formData,
            type: "POST",
            processData: false, // Important: Don't process the data
            contentType: false,
            success: function (response) {
                $("#editAttributeModal").modal("hide");

                $("#editAttributeForm")[0].reset();
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

    $(".deleteAttribute").on("click", function (event) {
        event.preventDefault();
        editItemId = $(this).data("attribute-id");
        $("#deleteAttributeModal").modal("show");
    });
    $("#deleteAttributeButton").on("click", function (event) {
        event.preventDefault();
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "/custom_arrtibutes/" + editItemId,
            type: "DELETE",
            data: {
                _token: token,
            },
            success: function (response) {
                $("#deleteAttributeModal").modal("hide");
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
            error: function (xhr) {
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
