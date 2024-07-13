function submitCustom() {
    document.getElementById("request-input").value = "delete";
    document.getElementById("form").submit();
}

// mengisi post input
if (document.getElementById("password-button")) {
    const selected = document.getElementById("status-web").textContent.trim();
    const id = document.getElementById("id-web").textContent.trim();
    document.getElementById("selected-input").value = selected;
    document.getElementById("id-input").value = id;

    document.getElementById("delete-button")?.addEventListener("click", function (e) {
        e.preventDefault();
    });

    document.getElementById("password-button").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("request-input").value = "password";
        document.getElementById("form").submit();
    });
}