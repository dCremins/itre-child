const hamburger = document.getElementById('menu-toggle')
const menu = document.getElementById('mobile-nav')
let mobileActive = false

hamburger.addEventListener('click', toggleMobile)

function toggleMobile() {
  if (mobileActive) {
    mobileActive = false
    menu.removeAttribute('style')
  } else {
    mobileActive = true
    menu.setAttribute('style', 'display:block;')
  }
}
