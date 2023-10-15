async function reverseGeocode(latitude, longitude) {
    try {
        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
        const data = await response.json();

        if (data && data.display_name != undefined || data.display_name != null) {
            const locationName = data.display_name;
            return locationName;
        } else {
            return "Location not found";
        }
    } catch (error) {
        return "Error occurred during reverse geocoding" + error;
    }
}


// Display the updated GPS location
function displayGPSLocation(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    reverseGeocode(latitude, longitude)
        .then(locationName => {
            document.getElementById("gps-location").textContent = locationName;
        })
        .catch(error => {
            handleLocationError(error);
        });
}

function handleLocationError(error) {
    var errorMessage = "Unable to retrieve GPS location: " + error.message;
    document.getElementById("gps-location").textContent = errorMessage;
}

// Watch for changes in GPS location
var watchID;
async function watchGPSLocation() {
    if ("geolocation" in navigator) {
        try {
            watchID = navigator.geolocation.watchPosition(displayGPSLocation, handleLocationError);
        } catch (error) {
            handleLocationError(error);
        }
    } else {
        handleLocationError(new Error("Geolocation is not supported in your browser."));
    }
}

// To stop watching GPS location (if needed)
function stopWatchingGPSLocation() {
    if (watchID) {
        navigator.geolocation.clearWatch(watchID);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    // Get the current date and display it
    var currentDate = new Date();
    document.getElementById("date").textContent = currentDate.toDateString();

    // Start watching the GPS location
    watchGPSLocation();

    // Handle form submission
    document.getElementById("bullet-choice").addEventListener("submit", function (event) {
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