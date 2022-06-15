var menuBtn = document.querySelector("#content .navbar .nav-left");
var menuNav = document.querySelector("#menu");
var btnClose = document.querySelector(".icon-menu-close");
var mainContent = document.querySelector("#content");

menuBtn.onclick = function(e) {
    menuNav.classList.add("open");
    menuNav.classList.remove("close-nav");
}

btnClose.onclick = function(e) {
    menuNav.classList.remove("open");
    menuNav.classList.add("close-nav");
}

// var btnTrash = document.querySelectorAll(".table .trash");
// var btnCancel = document.querySelector(".modal .modal-btn .btn-cancel");
// var modal = document.querySelector(".modal");

// for(btn of btnTrash) {
//     btn.onclick = function(e) {
//         modal.classList.remove("close");
//         modal.classList.add("open");
//     }
// }
// btnCancel.onclick = function() {
//     modal.classList.remove("open");
//     modal.classList.add("close");
// }

var btnCC = document.querySelector(".cc-info .cc-btn");
var btnCancel = document.querySelector(".modal .modal-btn .btn-cancel");
var modal = document.querySelector(".modal");

btnCC.onclick = function(e) {
    modal.classList.remove("close");
    modal.classList.add("open");
}

btnCancel.onclick = function() {
    modal.classList.remove("open");
    modal.classList.add("close");
}