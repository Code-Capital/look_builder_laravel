$(function () {
    $("#loginForm").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "/login",
            data: $("#loginForm").serialize(),
            type: "POST",
            success: function (response) {
                $("#loginForm")[0].reset();
                window.location.href = "/";
            },
            error: function (errors) {
                console.log(errors);
                const errorMessages = Object.values(
                    errors?.responseJSON?.errors
                ).flat();
                console.log(errorMessages);

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
    $("#registerForm").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "/register",
            data: $("#registerForm").serialize(),
            type: "POST",
            success: function (response) {
                $("#registerForm")[0].reset();
                window.location.href = "/";
            },
            error: function (errors) {
                console.log(errors.responseJSON.errors);
                toastr.options = {
                    progressBar: true,
                    closeButton: true,
                };
                var errorMessages = "";

                if (errors.responseJSON.errors.name) {
                    errorMessages += errors.responseJSON.errors.name + "<br>";
                }

                if (errors.responseJSON.errors.email) {
                    errorMessages += errors.responseJSON.errors.email + "<br>";
                }

                if (errors.responseJSON.errors.password) {
                    errorMessages +=
                        errors.responseJSON.errors.password + "<br>";
                }

                if (errorMessages) {
                    toastr.error(errorMessages, "Error");
                }
            },
        });
    });
});
