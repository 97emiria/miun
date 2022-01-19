/*JavaScript funktion made for Index page. Put the menu bar under video at top by changing z-index
Made in december 2020 of Emilia Holmström*/

// Get element that is needed
let headerBox = document.getElementById("headerBox");
let cartOverviewBox = document.getElementById("cartOverviewBox");


window.onload = headerBox.style.zIndex = "-1";


// When the user scrolls the page, execute myFunction
window.onscroll = function () { checkScrollLength() };

function checkScrollLength() {
    if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
        headerBox.style.zIndex = "10";
        cartOverviewBox.style.zIndex = "10";
    } else {
        headerBox.style.zIndex = "-1";
        cartOverviewBox.style.zIndex = "-1";
    }
}