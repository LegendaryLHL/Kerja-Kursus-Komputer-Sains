const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]
const user = document.getElementsByClassName('user')[0]

toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
    user.classList.toggle('active')
})