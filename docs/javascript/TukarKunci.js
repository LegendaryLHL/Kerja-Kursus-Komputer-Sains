if (document.getElementById("key-change-button")) {
    document.getElementById("key-change-button").addEventListener("click", function (e) {
        e.preventDefault();
        // menulis post input
        document.getElementById("request-input").value = "key";
        document.getElementById("form").submit();
    });
}