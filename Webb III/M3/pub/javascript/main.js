"use strict";let txt="En JavaScript hälsning till Malin och Mattias!",o=0,speed=50;function typeWriter(){o<txt.length&&(document.getElementById("hiddenMessage").innerHTML+=txt.charAt(o),o++,setTimeout(typeWriter,speed))}typeWriter();
//# sourceMappingURL=../maps/main.js.map
