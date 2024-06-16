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
    document.getElementById('add-worker-button')?.addEventListener('click', function () {
        window.location.href = "./TambahPekerja.php?selected=pekerja";
    });
    document.getElementById('add-employer-button')?.addEventListener('click', function () {
        window.location.href = "./TambahPekerja.php?selected=majikan";
    });
    document.getElementById('select-worker-button')?.addEventListener('click', function () {
        window.location.href = "./KonfigurasiPekerja.php?selected=pekerja";
    });
    document.getElementById('select-employer-button')?.addEventListener('click', function () {
        window.location.href = "./KonfigurasiPekerja.php?selected=majikan";
    });
});

function handleWorkerCardClick(event) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selected = urlParams.get('selected');
    const card = event.currentTarget.closest('.worker-card');
    const workerId = card.querySelector('.worker-id').innerText;

    const encodedWorkerId = encodeURIComponent(workerId);

    const url = `./Profil.php?selected=${selected}&id=${encodedWorkerId}`;

    window.location.href = url;
}


