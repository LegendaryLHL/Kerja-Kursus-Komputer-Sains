document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault();

    // Get input values
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // You can add your authentication logic here
    // For this example, we'll just display an alert with the values
    alert("Username: " + username + "\nPassword: " + password);
});
