const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]
const user = document.getElementsByClassName('user')[0]

toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
    user.classList.toggle('active')
})

//user
var button = document.getElementById("user-button");
var content = document.getElementById("user-content");
var hideTimeout;

var isMouseOverContent = false;

button.addEventListener("mouseenter", function () {
    clearTimeout(hideTimeout);
    content.style.display = "block";
});

button.addEventListener("mouseleave", function () {
    if (isMouseOverContent) {
        isMouseOverContent = false;
        hideTimeout = setTimeout(function () {
            content.style.display = "none";
        }, 100);
    } else {
        hideTimeout = setTimeout(function () {
            content.style.display = "none";
        }, 100);
    }
});

content.addEventListener("mouseenter", function () {
    clearTimeout(hideTimeout);
    isMouseOverContent = true;
});
content.addEventListener("mouseleave", function () {
    isMouseOverContent = false;
    hideTimeout = setTimeout(function () {
        content.style.display = "none";
    }, 100);
});