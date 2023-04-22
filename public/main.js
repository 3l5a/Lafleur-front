// burger icon
let sidenav = document.getElementById("mySidenav");
let openBtn = document.getElementById("openBtn");
let closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

/* Set the width of the side navigation to 250px */
function openNav() {
  sidenav.classList.add("active");
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  sidenav.classList.remove("active");
}

///// SLIDER /////
let slides = document.querySelectorAll(".slide");

/**
 * function to hide all slides
 */
function hideAll() {
  slides.forEach(slide => {
    if (!slide.classList.contains("active")) {
      return;
    } else {
      slide.classList.remove("active");
    }
  })
}

/**
 * function to show one specified slide
 * @param {*} el slide div
 */
function showThis(el) {
  if (el.classList.contains("active")) {
    return;
  } else {
    el.classList.add("active");
  }
}

let slideCircles = document.querySelectorAll(".circle");

/**
 * clicking on a circle of the slider will display its assigned slide and hide the other ones
 */
slideCircles.forEach((element, index) => {
  element.addEventListener('click', e => {
    hideAll(slides[index + 1]);
    showThis(slides[index]);
  })
})

setTimeout(() => {
  console.log("Delayed for 1 second.");
}, 1000);


let i = 0;
setInterval(() => {
  console.log("coucou");
    hideAll();
    showThis(slides[i]);
    if (i<slides.length-1) {
      i++;
    } else {
      i=0;
    }
  }, 4000)





