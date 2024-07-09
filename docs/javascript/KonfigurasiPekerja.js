function query() {
    if (document.getElementById('add-worker-button')) {
        window.location.href = "./KonfigurasiPekerja.php?selected=pekerja&query=" + document.getElementById('searchInput').value;
    }
    else if (document.getElementById('add-employer-button')) {
        window.location.href = "./KonfigurasiPekerja.php?selected=majikan&query=" + document.getElementById('searchInput').value;
    }
}

const workerCards = document.getElementsByClassName('worker-card');
for (let i = 0; i < workerCards.length; i++) {
    workerCards[i].addEventListener('click', handleWorkerCardClick);
    workerCards[i].style.cursor = 'pointer';
}



document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('query')) {
        document.getElementById('searchInput').value = urlParams.get('query');
        document.getElementById('searchInput').focus();
    }
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


