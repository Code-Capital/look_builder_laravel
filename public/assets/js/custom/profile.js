$(function () {
    var editItemId = 0;
    $("body").on("click", ".editProfile", function () {
        $.ajax({
            url: "/editProfile",
            type: "GET",
            success: function (response) {
                $("#editUserModal").modal("show");
                $("#editUserModal #name").val(response.name);
                $("#editUserModal #email").val(response.email);
                $("#editUserModal #phone").val(response.phone);
                $("#editUserModal #country").val(response.country);
            },
            error: function (xhr) {
                toastr.error(response.message, "Error");
            },
        });
    });
    $("#updateProfileForm").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "/update_profile",
            data: formData,
            type: "POST",
            processData: false,
            contentType: false,
            success: function (response) {
                $("#updateProfileForm")[0].reset();
                $("#editUserModal").modal("hide");
                toastr.options = {
                    progressBar: true,
                    closeButton: true,
                    timeOut: 2000,
                    extendedTimeOut: 2000,
                };
                if (response.status === true) {
                    toastr.success(response.message, "Success bg-success");
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
    $("#updatePasswordForm").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "/update_password",
            data: formData,
            type: "POST",
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                $("#updatePasswordForm")[0].reset();
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
    $("#addUserForm").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "/create_user",
            data: formData,
            type: "POST",
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                $("#addUserForm")[0].reset();
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

    $("body").on("click", ".deleteUser", function (event) {
        event.preventDefault();
        editItemId = $(this).data("user-id");
        $("#deleteUserModal").modal("show");
    });

    $("body").on("click", "#deleteUserButton", function (e) {
        e.preventDefault();
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            type: "DELETE",
            url: "/user/" + editItemId,
            data: {
                _token: token,
            },
            success: function (response) {
                toastr.options = {
                    progressBar: true,
                    closeButton: true,
                    timeOut: 2000,
                };
                console.log(response);
                if (response.status == true) {
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
