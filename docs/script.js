document.getElementById("login-form").addEventListener("submit", function (event) {
    event.preventDefault();

    // Get input values
    var username = document.getElementById("ic-number").value;
    var password = document.getElementById("password").value;

    // Authentication logic here

    // Redirect to the new page after form submission
    window.location.href = "IsiKehadiran.html";
});
document.getElementById("infoExpandButton").addEventListener("click", function () {
    var content = document.getElementById("infoExpandContent");
    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "block";
    } else {
        content.style.display = "none";
    }
});