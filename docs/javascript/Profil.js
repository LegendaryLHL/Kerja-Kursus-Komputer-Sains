if (document.getElementById("delete-button")) {
    const urlParams = new URLSearchParams(window.location.search);
    const selected = urlParams.get('selected');
    const id = urlParams.get('id');
    document.getElementById("selected").value = selected;
    document.getElementById("id").value = id;
    document.getElementById("delete-button").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("request-input").value = "delete";
        document.getElementById("form").submit();
    });

    document.getElementById("password-button").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("request-input").value = "password";
        document.getElementById("form").submit();
    });
}