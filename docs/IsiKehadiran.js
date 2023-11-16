const GeoOptions = {
    enableHighAccuracy: true,
    maximumAge: 2000,
    timeout: 10000,
};
var latitudeTarget = 55.751244;
var longtitudeTarget = 37.618423;
var distanceFromTarget;
var rangeKm = 1;
async function reverseGeocode(latitude, longitude) {
    try {
        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
        const data = await response.json();
        if (data && data.display_name !== undefined || data.display_name !== null) {
            const locationDisplay = data.display_name;
            return locationDisplay;
        } else {
            return "Location not found";
        }
    } catch (error) {
        return "Error occurred during reverse geocoding" + error;
    }
}

function calculateDistanceKm(lat1, lon1, lat2, lon2) {
    const R = 6371; // Radius of the Earth in kilometers

    // Convert latitude and longitude from degrees to radians
    const lat1Rad = (lat1 * Math.PI) / 180;
    const lon1Rad = (lon1 * Math.PI) / 180;
    const lat2Rad = (lat2 * Math.PI) / 180;
    const lon2Rad = (lon2 * Math.PI) / 180;

    // Haversine formula
    const dLat = lat2Rad - lat1Rad;
    const dLon = lon2Rad - lon1Rad;

    const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1Rad) * Math.cos(lat2Rad) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);

    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    const distance = R * c; // Distance in kilometers

    return distance;
}

// Display the updated GPS location
function displayGPSLocation(position) {
    var latitude = position.coords.latitude;
    var longtitude = position.coords.longitude;
    distanceFromTarget = calculateDistanceKm(latitude, longtitude, latitudeTarget, longtitudeTarget)
    if (distanceFromTarget < 5) {
        document.getElementById("gps-location").textContent = "* Lokasi GPS anda di tempat kerja";
        document.getElementById("gps-location").style.color = "green";
    }
    else {
        document.getElementById("gps-location").textContent = "* Lokasi GPS anda tidak di tempat kerja";
        document.getElementById("gps-location").style.color = "#d93025";
    }

    reverseGeocode(latitudeTarget, longtitudeTarget)
        .then(locationName => {
            var element = document.getElementById("gps-location");
            element.setAttribute("data-tooltip", "Jarak daripada tempat kerja iaitu " + locationName + " ialah " + Math.round(distanceFromTarget) + "Km");
        })
        .catch(error => {
            handleLocationError(error);
        });
}


function handleLocationError(error) {
    var errorMessage = "ERROR " + error.message;
    document.getElementById("gps-location").textContent = errorMessage;
    document.getElementById("gps-location").style.color = "#d93025";
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

const noRadio = document.getElementById("no-radio");
const yesRadio = document.getElementById("yes-radio");
const reasonBox = document.getElementsByClassName("reason-box")[0];

yesRadio.addEventListener("change", function () {
    if (reasonBox.classList.contains("active")) {
        reasonBox.classList.toggle("active");
    }
});

noRadio.addEventListener("change", function () {
    reasonBox.classList.toggle("active");
});

document.addEventListener("DOMContentLoaded", function () {
    var currentDate = new Date();
    document.getElementById("date").textContent = currentDate.getDate() + "/" + currentDate.getMonth() + "/" + currentDate.getYear();

    watchGPSLocation();

    document.getElementById("kehadiran-form").addEventListener("submit", function (event) {
        event.preventDefault();
        var canGoToWork = document.querySelector('input[name="can-go-work"]:checked').value;
        var reasonForNotGoing = document.getElementById("reason").value;

        alert(canGoToWork + "\n " + reasonForNotGoing)
    });
});