function searchGrid() {
    let input, filter, grid, card, name, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    grid = document.getElementsByClassName("worker-grid")[0];
    card = grid.getElementsByClassName("worker-card");

    for (i = 0; i < card.length; i++) {
        name = card[i].getElementsByClassName("worker-name")[0];
        if (name) {
            txtValue = name.textContent || name.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                card[i].style.display = "";
            } else {
                card[i].style.display = "none";
            }
        }
    }
}

function handleRemoveButtonClick(event) {
    const card = event.currentTarget.closest('.worker-card');
    const workerName = card.querySelector('.worker-name').innerText;

    $.ajax({
        type: "POST",
        url: "includes/signup_model.inc.php",
        data: { action: "removePekerja", nama_pekerja: workerName },
        success: function (response) {
            card.style.display = "none";
        }
    });
}


const removeButtons = document.getElementsByClassName('remove-button');
for (let i = 0; i < removeButtons.length; i++) {
    removeButtons[i].addEventListener('click', handleRemoveButtonClick);
    removeButtons[i].style.cursor = 'pointer';
}



document.addEventListener('DOMContentLoaded', function () {
    const addButton = document.querySelector('.add-worker-button');

    addButton.addEventListener('click', handleAddButtonClick);

    function handleAddButtonClick(event) {
        const workersContainer = document.getElementById("workers-container");
        const addWorkerForm = document.getElementById("add-worker-form");
        workersContainer.style.display = "none";
        addWorkerForm.style.display = "block";
    }
});

