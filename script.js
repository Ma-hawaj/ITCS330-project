const toggleButton = document.getElementsByClassName('toggle-menu')[0]
const linkss = document.getElementsByClassName('links')[0]

toggleButton.addEventListener('click', ()=>{

  linkss.classList.toggle('active')
})
