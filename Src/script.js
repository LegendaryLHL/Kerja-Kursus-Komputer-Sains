document.getElementById("login-form").addEventListener("submit", function (event) {
    event.preventDefault();

    // Get input values
    var username = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // You can add your authentication logic here
    // For this example, we'll just display an alert with the values
    alert("E-mel: " + username + "\nKatalaluan: " + password);
});

const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]
const user = document.getElementsByClassName('user')[0]

toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
    user.classList.toggle('active')
})