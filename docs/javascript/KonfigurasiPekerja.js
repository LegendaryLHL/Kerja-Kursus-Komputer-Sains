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
    const addWorker = document.getElementById('add-worker-button');
    if (addWorker) {
        addWorker.addEventListener('click', function () {
            window.location.href = "./TambahPekerja.php?selected=pekerja";
        });
    }
    const addEmployer = document.getElementById('add-employer-button');
    if (addEmployer) {
        addEmployer.addEventListener('click', function () {
            window.location.href = "./TambahPekerja.php?selected=majikan";
        });
    }
    const selectWorker = document.getElementById('select-worker-button');
    if (selectWorker) {
        selectWorker.addEventListener('click', function () {
            window.location.href = "./KonfigurasiPekerja.php?selected=pekerja";
        });
    }
    const selectEmployer = document.getElementById('select-employer-button');
    if (selectEmployer) {
        selectEmployer.addEventListener('click', function () {
            window.location.href = "./KonfigurasiPekerja.php?selected=majikan";
        });
    }
});

function handleWorkerCardClick(event) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selected = urlParams.get('selected');
    const card = event.currentTarget.closest('.worker-card');
    const workerName = card.querySelector('.worker-id').innerText;

    const encodedWorkerName = encodeURIComponent(workerName);

    const url = `./Profil.php?selected=${selected}&id=${encodedWorkerName}`;

    window.location.href = url;
}


