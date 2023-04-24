////////////////// BURGER MENU //////////////////
let sidenav = document.getElementById("mySidenav");
let openBtn = document.getElementById("openBtn");
let closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

/* width of side nav = 250px */
function openNav() {
  sidenav.classList.add("active");
}

/* width of side nav = 0 */
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

let i = 1; //timer starts at index 2 because index 1 is displayed on load
if (typeof slides != "undefined") {
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
}

  ///////////////////// SELECT INPUT PRODUCTS //////////////////////
//on click select
const colorSelect = document.querySelector(".colors");
const categorySelect = document.querySelector(".categories");
const selectInputs = [colorSelect, categorySelect];

// div to open/close
const colorDiv = document.querySelector(".color-choices");
const categoryDiv = document.querySelector(".category-choices");
const selectOptions = [colorDiv, categoryDiv];

document.addEventListener("click", (e) => {
  const targetEl = e.target; // clicked element
  do {
    if(targetEl == colorSelect || targetEl != colorSelect.parentElement) {
      colorSelect.classList.remove("active");
      return;
    }
    // Go up the DOM
    targetEl = targetEl.parentNode;
  } while (targetEl);
  // This is a click outside.
  colorSelect.classList.remove("active");
});

/**
 * clicking on a select input will toggle its options
 */
selectInputs.forEach((element, index) => {
  element.addEventListener("click", (event) => {
    console.log("coucou");
    if (selectOptions[index].classList.contains("active")) {
      hideAll(selectOptions);
    } else {
      hideAll(selectOptions);
      showThis(selectOptions[index]);
    }
  })
})




