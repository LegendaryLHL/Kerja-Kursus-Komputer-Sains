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
            const locationDisplay = data.display_name + " Latitude: " + latitude + " Longtitude: " + longitude;
            return locationDisplay;
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
    var errorMessage = "ERROR " + error.message;
    document.getElementById("gps-location").textContent = errorMessage;
}

let watchID = null;
async function watchGPSLocation() {
    if ("geolocation" in navigator) {
        let geolocationPermission = await navigator.permissions.query({ name: 'geolocation' });

        const startWatching = async () => {
            if (watchID) {
                // A watch is already active
                return;
            }

            try {
                watchID = navigator.geolocation.watchPosition(displayGPSLocation, handleLocationError, GeoOptions);
                console.log("new Watcher");
            } catch (error) {
                handleLocationError(error);
            }
        };

        // Update geolocationPermission
        setInterval(async () => {
            geolocationPermission = await navigator.permissions.query({ name: 'geolocation' });
            if (geolocationPermission.state === "granted") {
                startWatching();
            } else {
                stopWatchingGPSLocation();
                handleLocationError(new Error("Tolong buka GPS"));
            }
        }, 500);

        // Start watching if the permission is initially granted
        if (geolocationPermission.state === "granted") {
            startWatching();
        }
        else {
            handleLocationError(new Error("Tolong buka GPS"));
        }
    } else {
        handleLocationError(new Error("Geolokasi tidak disokong dalam penyemak imbas anda."));
    }
}


function stopWatchingGPSLocation() {
    if (watchID) {
        navigator.geolocation.clearWatch(watchID);
        watchID = null;
    }
}

document.addEventListener("DOMContentLoaded", function () {
    // Get the current date and display it
    var currentDate = new Date();
    document.getElementById("date").textContent = currentDate.getDate() + "/" + currentDate.getMonth() + "/" + currentDate.getYear();

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