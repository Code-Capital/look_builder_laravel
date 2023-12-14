$(function () {
    var dataAttributeId = 0;
    var editItemId = 0;

    $(".addOption").on("click", function (event) {
        event.preventDefault();

        // dataAttributeId = $(this).data("bs-attribute");
        // console.log(dataAttributeId);
        $("#addOptionImageModal").modal("show");
    });
    $("#addOptionImageForm").on("submit", function (event) {
        event.preventDefault();

        var formData = new FormData(this);
        $.ajax({
            url: "/image/add",
            data: formData,
            type: "POST",
            processData: false, // Important: Don't process the data
            contentType: false,
            success: function (response) {
                // $("#addOptionImageModal").modal("hide");
                // $("#addOptionImageForm")[0].reset();
                // toastr.options = {
                //     progressBar: true,
                //     closeButton: true,
                //     timeOut: 2000,
                // };
                // if (response.status === true) {
                //     toastr.success(response.message, "Success");
                //     setTimeout(function () {
                //         location.reload();
                //     }, 2000);
                // } else {
                //     toastr.error(response.message, "Error");
                // }
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

    // $(".editOption").on("click", function (event) {
    //     editItemId = $(this).data("option-id");
    //     $.ajax({
    //         url: "/custom_options/edit/" + editItemId,
    //         type: "GET",
    //         success: function (response) {
    //             $("#editOptionModal").modal("show");
    //             $("#editOptionModal #name").val(response.name);
    //             $("#editOptionModal #description").val(response.description);
    //         },
    //         error: function (xhr) {
    //             toastr.error(response.message, "Error");
    //         },
    //     });
    // });
    // $("#editOptionForm").on("submit", function (event) {
    //     event.preventDefault();
    //     var formData = new FormData(this);
    //     $.ajax({
    //         url: "/custom_options/update/" + editItemId,
    //         data: formData,
    //         type: "POST",
    //         processData: false, // Important: Don't process the data
    //         contentType: false,
    //         success: function (response) {
    //             $("#editOptionModal").modal("hide");

    //             $("#editOptionForm")[0].reset();
    //             toastr.options = {
    //                 progressBar: true,
    //                 closeButton: true,
    //                 timeOut: 2000,
    //             };
    //             if (response.status === true) {
    //                 toastr.success(response.message, "Success");
    //                 setTimeout(function () {
    //                     location.reload();
    //                 }, 2000);
    //             } else {
    //                 toastr.error(response.message, "Error");
    //             }
    //         },
    //         error: function (errors) {
    //             console.log(errors);
    //             const errorMessages = Object.values(
    //                 errors?.responseJSON?.errors
    //             ).flat();
    //             toastr.options = {
    //                 progressBar: true,
    //                 closeButton: true,
    //             };
    //             for (let i = 0; i < errorMessages.length; i++) {
    //                 toastr.error(errorMessages[i], "Error");
    //             }
    //         },
    //     });
    // });

    // $(".deleteOption").on("click", function (event) {
    //     event.preventDefault();
    //     dataAttributeId = $(this).data("option-id");
    //     $("#deleteOptionModal").modal("show");
    // });
    // $("#deleteOptionButton").on("click", function (event) {
    //     event.preventDefault();
    //     var token = $("meta[name='csrf-token']").attr("content");

    //     $.ajax({
    //         url: "/custom_options/delete/" + dataAttributeId,
    //         type: "DELETE",
    //         data: {
    //             _token: token,
    //         },
    //         success: function (response) {
    //             $("#deleteOptionModal").modal("hide");
    //             toastr.options = {
    //                 progressBar: true,
    //                 closeButton: true,
    //                 timeOut: 2000,
    //             };
    //             if (response.status == true) {
    //                 toastr.success(response.message, "Success");
    //                 setTimeout(function () {
    //                     location.reload();
    //                 }, 2000);
    //             } else {
    //                 toastr.error(response.message, "Error");
    //             }
    //         },
    //         error: function (xhr) {
    //             const errorMessages = Object.values(
    //                 errors?.responseJSON?.errors
    //             ).flat();
    //             toastr.options = {
    //                 progressBar: true,
    //                 closeButton: true,
    //             };
    //             for (let i = 0; i < errorMessages.length; i++) {
    //                 toastr.error(errorMessages[i], "Error");
    //             }
    //         },
    //     });
    // });
});
