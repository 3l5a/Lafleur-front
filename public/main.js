////////////////// BURGER MENU //////////////////
let sidenav = document.getElementById("mySidenav");
let openBtn = document.getElementById("openBtn");
let closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

/* width of side navigation = 250px */
function openNav() {
  sidenav.classList.add("active");
}

/* width = 0 */
function closeNav() {
  sidenav.classList.remove("active");
}

//////////////////// SLIDER ////////////////////
let slides = document.querySelectorAll(".slide");

/**
 * function to hide all slides
 */
function hideAll(array) {
  array.forEach(el => {
    if (!el.classList.contains("active")) {
      return;
    } else {
      el.classList.remove("active");
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
    hideAll(slides);
    showThis(slides[index]);

    hideAll(slideCircles);
    showThis(slideCircles[index]);
  })
})

let i = 0;
setInterval(() => {
  //slide visible
    hideAll(slides);
    showThis(slides[i]);

    //round shape emphasis
    hideAll(slideCircles);
    showThis(slideCircles[i]);
    if (i<slides.length-1) {
      i++;
    } else {
      i=0;
    }
  }, 4000)





