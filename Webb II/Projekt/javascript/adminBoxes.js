"use strict";

/*
Code made during march 2021 of Emilia Holmström
The code function is to show and hide boxes that exist on admin-page
*/


//Get boxes
let changePasswordBox = document.getElementById("changePasswordBox");
let setAdminBox = document.getElementById("setAdminBox");
let deletePostsBox = document.getElementById("deletePostsBox");
let deleteCommentBox = document.getElementById("deleteCommentBox");
let deleteUserBox = document.getElementById("deleteUserBox");

//Get buttons
let changePasswordBtn = document.getElementById("changePasswordBtn");
let setAdminBtn = document.getElementById("setAdminBtn");
let deletePostsBtn = document.getElementById("deletePostsBtn");
let deleteCommentBtn = document.getElementById("deleteCommentBtn");
let deleteUserBtn = document.getElementById("deleteUserBtn");





//EventListiner
changePasswordBtn.addEventListener("click", changePasswordBoxFunction, false);
setAdminBtn.addEventListener("click", adminBoxFunction, false);
deletePostsBtn.addEventListener("click", deletePostFunction, false);
deleteCommentBtn.addEventListener("click", deleteCommentFunction, false);
deleteUserBtn.addEventListener("click", deleteUserFunction, false);




//A function that change all boxes display to none, it will clear content boxes
function clear() {
    changePasswordBox.style.display = "none";
    setAdminBox.style.display = "none";
    deletePostsBox.style.display = "none";
    deleteCommentBox.style.display = "none";
    deleteUserBox.style.display = "none";
}



//Four function that will clear content box and change display to empty when you click button
function changePasswordBoxFunction() {
    clear();
    if (changePasswordBox.style.display === "none") {
        changePasswordBox.style.display = "block";
    } 
}

function adminBoxFunction() {
    clear();
    if (setAdminBox.style.display === "none") {
        setAdminBox.style.display = "block";
    } 
}


function deletePostFunction() {
    clear();
    if (deletePostsBox.style.display === "none") {
        deletePostsBox.style.display = "block";
    } 
}

function deleteUserFunction() {
    clear();
    if (deleteUserBox.style.display === "none") {
        deleteUserBox.style.display = "block";
    } 
}

function deleteCommentFunction() {
    clear();
    if (deleteCommentBox.style.display === "none") {
        deleteCommentBox.style.display = "block";
    } 
}










//Save in local storage the last selected box, so it is open if the page is reloaded