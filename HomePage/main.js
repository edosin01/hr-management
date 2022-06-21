// Navbar
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

// Chấm công
if(document.querySelector(".cc-info .cc-btn") != null) {
    var btnCC = document.querySelector(".cc-info .cc-btn");
    var btnCancel_CC = document.querySelector(".modal .modal-btn .btn-cancel");
    var modal_CC = document.querySelector(".modal");

    btnCC.onclick = function(e) {
        modal_CC.classList.remove("close");
        modal_CC.classList.add("open");
    }

    btnCancel_CC.onclick = function() {
        modal_CC.classList.remove("open");
        modal_CC.classList.add("close");
    }
}