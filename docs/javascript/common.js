const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]
const user = document.getElementsByClassName('user')[0]

toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
    user.classList.toggle('active')
})

//info
var button = document.getElementById("info-button");
var content = document.getElementById("info-content");
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

//user
var ubutton = document.getElementById("user-button");
var ucontent = document.getElementById("user-content");
var uhideTimeout;

var uisMouseOverContent = false;

ubutton.addEventListener("mouseenter", function () {
    clearTimeout(uhideTimeout);
    ucontent.style.display = "block";
});

ubutton.addEventListener("mouseleave", function () {
    if (uisMouseOverContent) {
        uisMouseOverContent = false;
        uhideTimeout = setTimeout(function () {
            ucontent.style.display = "none";
        }, 100);
    } else {
        uhideTimeout = setTimeout(function () {
            ucontent.style.display = "none";
        }, 100);
    }
});

ucontent.addEventListener("mouseenter", function () {
    clearTimeout(uhideTimeout);
    uisMouseOverContent = true;
});
ucontent.addEventListener("mouseleave", function () {
    uisMouseOverContent = false;
    uhideTimeout = setTimeout(function () {
        ucontent.style.display = "none";
    }, 100);
});