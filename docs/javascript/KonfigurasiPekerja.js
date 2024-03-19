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

const workerCards = document.getElementsByClassName('worker-card');
for (let i = 0; i < workerCards.length; i++) {
    workerCards[i].addEventListener('click', handleWorkerCardClick);
    workerCards[i].style.cursor = 'pointer';
}



document.addEventListener('DOMContentLoaded', function () {
    const addButton = document.querySelector('.add-worker-button');

    addButton.addEventListener('click', handleAddButtonClick);

    function handleAddButtonClick(event) {
        window.location.href = "./TambahPekerja.php";
    }
});

function handleWorkerCardClick(event) {
    const card = event.currentTarget.closest('.worker-card');
    const workerName = card.querySelector('.worker-name').innerText;

    const encodedWorkerName = encodeURIComponent(workerName);

    const url = `./Pekerja.php?name=${encodedWorkerName}`;

    window.location.href = url;
}


