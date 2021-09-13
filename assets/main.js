let submitButton = null;
let urlForm = null;
document.addEventListener('DOMContentLoaded', function () {
    submitButton = $("#submitURL");
    urlForm = $("#urlForm");
    submitButton.on("click", function () {
        addUrlToDB();
    });
});

function addUrlToDB() {
    let long = $("#input-long");
    let short = $("#input-short");

    $.ajax({
        url: "../includes/addUrlToDB.php",
        type: "post",
        dataType: 'json',
        data: {short: short.val(), long: long.val()},
        success: function (result) {
            console.log(result.status)
            if (result.status === "success") {
                short.val("");
                long.val("");
                $("#displayURL").attr("href", result.shortLink);
                $("#displayURL").text(result.shortLink);
                $("#urlCopy").on("click", copy(result.shortLink));
                $(".success").css("display", "block");


            } else if (result.status === "captcha-failure") {
                $(".error").text("Captcha is not valid!")
                $(".error").css("display", "block");
            } else if (result.status === "sql-failure") {
                $(".error").text("Internal Error: Database Failure. Write ReisMiner#1111 on Discord and report the issue!")
                $(".error").css("display", "block");
            } else if (result.status === "input-wrong") {
                $(".error").text("Please enter a Valid URL")
                $(".error").css("display", "block");
            }else if(result.status === "sql-connect-failure"){
                $(".error").text("Internal Error: Cannot connect to Database. Write ReisMiner#1111 on Discord and report the issue!")
                $(".error").css("display", "block");
            }
        }
    });
}

function copy(text) {
    let input = document.createElement('textarea');
    input.innerHTML = text;
    document.body.appendChild(input);
    input.select();
    let result = document.execCommand('copy');
    document.body.removeChild(input);
    return result;
}