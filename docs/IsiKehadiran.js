const GeoOptions = {
    enableHighAccuracy: true,
    maximumAge: 2000,
    timeout: 10000,
};

async function reverseGeocode(latitude, longitude) {
    try {
        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
        const data = await response.json();

        if (data && data.display_name !== undefined || data.display_name !== null) {
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
async function watchGPSLocation() {
    async function getGPSLocation() {
        try {
            const position = await new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(resolve, reject, GeoOptions);
            });
            return position;
        } catch (error) {
            return error;
        }
    }

    // Set the interval to run the geolocation search every 2 seconds
    const searchInterval = 2000; // 2 seconds
    setInterval(async () => {
        const position = await getGPSLocation();
        if (!(position instanceof Error)) {
            displayGPSLocation(position);
        } else {
            handleLocationError(position);
        }
    }, searchInterval);
}

function stopWatchingGPSLocation() {
    clearInterval(watchID);
}

document.addEventListener("DOMContentLoaded", function () {
    // Get the current date and display it
    var currentDate = new Date();
    document.getElementById("date").textContent = currentDate.toDateString();

    // Start watching the GPS location
    watchGPSLocation();

    // Handle form submission
    document.getElementById("bullet-form").addEventListener("submit", function (event) {
        event.preventDefault();
        // Get the selected value from the "Can Go to Work" selector
        var canGoToWork = document.querySelector('input[name="can-go-work"]:checked').value;

        // Get the reason for not going to work
        var reasonForNotGoing = document.getElementById("reason").value;

        console.log("Can Go to Work: " + canGoToWork);
        console.log("Reason for Not Going to Work: " + reasonForNotGoing);
    });
});