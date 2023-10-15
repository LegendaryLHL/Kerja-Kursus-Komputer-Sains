async function getGPSLocation() {
    var gpsLocation = "Not Set";
    if ("geolocation" in navigator) {
        try {
            const position = await navigator.geolocation.getCurrentPosition();
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            gpsLocation = "Latitude: " + latitude + ", Longitude: " + longitude;
        } catch (error) {
            gpsLocation = "Unable to retrieve GPS location: " + error.message;
        }
    } else {
        gpsLocation = "Geolocation is not supported in your browser.";
    }
    return gpsLocation;
}

document.addEventListener("DOMContentLoaded", async function () {
    // Get the current date and display it
    var currentDate = new Date();
    document.getElementById("date").textContent = currentDate.toDateString();

    // Get and display the GPS location asynchronously
    var gpsLocation = await getGPSLocation();
    document.getElementById("gps-location").textContent = gpsLocation;

    // Handle form submission
    document.getElementById("input-form").addEventListener("submit", function (event) {
        event.preventDefault();
        // Get the selected value from the "Can Go to Work" selector
        var canGoToWork = document.querySelector('input[name="can-go-work"]:checked').value;

        // Get the reason for not going to work
        var reasonForNotGoing = document.getElementById("reason").value;

        // You can now send this data to your server or perform further actions as needed
        // For demonstration, we'll just log the data to the console
        console.log("Can Go to Work: " + canGoToWork);
        console.log("Reason for Not Going to Work: " + reasonForNotGoing);
    });
});