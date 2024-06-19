if (document.getElementById("key-change-button")) {
    document.getElementById("key-change-button").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("request-input").value = "key";
        document.getElementById("form").submit();
    });
}