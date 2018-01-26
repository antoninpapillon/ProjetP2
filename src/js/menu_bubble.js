var menu_bubble = document.getElementsByClassName("center");
var bulle_top = document.getElementsByClassName("bulle-top");
var bulle_right = document.getElementsByClassName("bulle-right");
var bulle_left = document.getElementsByClassName("bulle-left");
var bulle_bottom = document.getElementsByClassName("bulle-bottom");

menu_bubble[0].addEventListener("click", display);

function display() {
    menu_bubble[0].classList.toggle("active");
    bulle_top[0].classList.toggle("active");
    bulle_right[0].classList.toggle("active");
    bulle_left[0].classList.toggle("active");
    bulle_bottom[0].classList.toggle("active");
};
