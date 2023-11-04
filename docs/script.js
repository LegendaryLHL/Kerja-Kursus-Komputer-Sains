document.getElementById("login-form").addEventListener("submit", function (event) {
    event.preventDefault();

    // Get input values
    var username = document.getElementById("ic-number").value;
    var password = document.getElementById("password").value;

    // Authentication logic here

    // Redirect to the new page after form submission
    window.location.href = "IsiKehadiran.html";
});


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
