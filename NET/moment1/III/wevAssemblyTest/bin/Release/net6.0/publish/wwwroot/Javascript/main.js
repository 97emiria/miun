"use strict";

let month = "";
let t = new Date();

if ((t.getUTCMonth() + 1) < 10) {
    month = "0" + (t.getUTCMonth() + 1);
} else {
    month = (t.getUTCMonth() + 1);
}
document.getElementById('timestamp').innerHTML = "Dagens datum �r: " +
    t.getUTCFullYear() + "-" +
    month + "-" +
    t.getUTCDate();

