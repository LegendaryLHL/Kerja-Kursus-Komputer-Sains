document.getElementById("login-form").addEventListener("submit", function (event) {
    event.preventDefault();

    // Get input values
    var username = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Authentication logic here

    // Redirect to the new page after form submission
    window.location.href = "IsiKehadiran.html";
});