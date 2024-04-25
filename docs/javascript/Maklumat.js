let latitudeTarget = 2.984373436275586;
let longtitudeTarget = 101.5413571958214;

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

function handleLocationError(error) {
    var errorMessage = "ERROR " + error.message;
    document.getElementById("gps-location").textContent = errorMessage;
    document.getElementById("gps-location").style.color = "#d93025";
}

document.addEventListener("DOMContentLoaded", function () {
    reverseGeocode(latitudeTarget, longtitudeTarget)
        .then(locationName => {
            var element = document.getElementById("gps-location");
            element.textContent = locationName;
        })
        .catch(error => {
            handleLocationError(error);
        });
});

if (document.getElementById("key-change-button")) {
    document.getElementById("key-change-button").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("request-input").value = "key";
        document.getElementById("form").submit();
    });

    document.getElementById("coordinate-change-button").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("request-input").value = "coord";
        document.getElementById("form").submit();
    });
}