let submitButton = null;
let urlForm = null;
document.addEventListener('DOMContentLoaded', function () {
    submitButton = document.getElementById("submitURL");
    urlForm = document.getElementById("urlForm");
    submitButton.addEventListener("click", function () {
        urlForm.submit();
    });
});