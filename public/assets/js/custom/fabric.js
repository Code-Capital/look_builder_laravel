$(function () {
    var editItemId = 0;
    $("#addFabricFrom").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/fabrics/add",
            data: formData,
            type: "POST",
            processData: false, // Important: Don't process the data
            contentType: false,
            success: function (response) {
                $("#addFabricFrom")[0].reset();
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

    $(".delete-fabric").on("click", function (event) {
        event.preventDefault();
        editItemId = $(this).data("fabric-id");
        $("#deleteFabricModal").modal("show");
    });
    $("#deleteFabricButton").click(function (e) {
        e.preventDefault();
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "/fabrics/" + editItemId,
            type: "DELETE",
            data: {
                _token: token,
            },
            success: function (response) {
                $("#deleteFabricModal").modal("hide");

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

    $(".editFabric").on("click", function (event) {
        editItemId = $(this).data("fabric-id");

        $.ajax({
            url: "/fabrics/" + editItemId,
            type: "GET",
            success: function (response) {
                $("#editFabricModal").modal("show");
                $("#editFabricModal #title").val(response.name);
                $("#editFabricModal #woven_by").val(response.woven_by);
                $("#editFabricModal #composition").val(response.composition);
                $("#editFabricModal #weight").val(response.weight);
                $("#editFabricModal #price").val(response.price);
                $("#editFabricModal #season").val(response.season);
                $("#editFabricModal #fabric_code").val(response.fabric_code);
                // $("#editFabricModal #price").val(response.price);
                // $("#editFabricModal #description").val(response.description);
            },
            error: function (xhr) {
                toastr.error(response.message, "Error");
            },
        });
    });
    $("#editFabricForm").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/fabrics/" + editItemId,
            data: formData,
            type: "POST",
            processData: false, // Important: Don't process the data
            contentType: false,
            success: function (response) {
                $("#editFabricModal").modal("hide");
                $("#editFabricForm")[0].reset();
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
