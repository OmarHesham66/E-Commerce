$("#save").on("click", function (e) {
    e.preventDefault();
    let info = new FormData($("#form")[0]);
    $.ajax({
        type: "post",
        enctype: "multipart/form-data",
        url: route,
        data: info,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.massage == "done") {
                $("#update").slideDown().delay(1000).slideUp();
                $("input[name=cpassword]").val("");
                $("input[name=password]").val("");
                $("input[name=password_confirmation]").val("");
                $("input[name=photo]").val("");
            }
        },
        error: function (response) {
            if (response.responseJSON.errors) {
                $.each(
                    response.responseJSON.errors,
                    function (indexInArray, valueOfElement) {
                        $(`.error_${indexInArray}`)
                            .text(valueOfElement[0])
                            .css("color", "red")
                            .fadeIn()
                            .delay(3500)
                            .fadeOut();
                    }
                );
                $("input[name=cpassword]").val("");
                $("input[name=password]").val("");
                $("input[name=password_confirmation]").val("");
            }
        },
    });
});
