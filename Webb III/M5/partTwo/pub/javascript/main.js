"use strict";let courseListTable=document.getElementById("courseListTable"),codeInput=document.getElementById("code"),nameInput=document.getElementById("name"),progressionInput=document.getElementById("progression"),syllabusInput=document.getElementById("syllabus"),formMessage=document.getElementById("formMassage"),restAPIlink="https://studenter.miun.se/~emho2003/writeable/DT173G-m5/partTwo/pub/rest.php",apiLinkWithCode=restAPIlink+window.location.search;function getCourseList(){1==checkPage?fetch(restAPIlink).then((e=>e.json())).then((e=>{e.forEach((e=>{courseListTable.innerHTML+=`\n                    <tr> \n                    <td> ${e.code} </td>\n                    <td> ${e.name} </td>\n                    <td> ${e.progression} </td>\n                    <td> <a href="${e.syllabus}" target="_blank"> Webblänk </a> </td>\n                    <td> <button id="${e.code}"  onclick="window.location.href='edit.html?code=${e.code}';" > Hantera </button> </td>\n                    </tr>\n                    `}))})):fetch(apiLinkWithCode).then((e=>e.json())).then((e=>{e.forEach((e=>{codeInput.value=e.code,nameInput.value=e.name,progressionInput.value=e.progression,syllabusInput.value=e.syllabus}))}))}function addCourse(e){e.preventDefault();let t={code:codeInput.value,name:nameInput.value,progression:progressionInput.value,syllabus:syllabusInput.value};fetch(restAPIlink,{method:"POST",body:JSON.stringify(t)}).then((e=>e.json())).then((function(e){e.ok?getCourseList():"code"==e.message?(formMessage.classList.add("error"),formMessage.innerHTML="Kurskoden är felaktig"):"name"==e.message?(formMessage.classList.add("error"),formMessage.innerHTML="Kursnamnet är inte korrekt"):"progression"==e.message&&(formMessage.classList.add("error"),formMessage.innerHTML="Progressaionen är fel, <br> ange endast stort A eller B")})).catch((e=>{console.log("Message: ",e)}))}function editCourse(){let e={code:codeInput.value,name:nameInput.value,progression:progressionInput.value,syllabus:syllabusInput.value};fetch(apiLinkWithCode,{method:"PUT",body:JSON.stringify(e)}).then((e=>e.json())).then((e=>{e.forEach((e=>{getCourseList()}))})).catch((e=>{console.log("Error: ",e)}))}function deleteCourse(){1==confirm("Är du säker på att du vill radera kursen?")&&fetch(apiLinkWithCode,{method:"DELETE",body:JSON.stringify(window.location.search.substring(6))}).then((e=>e.json())).then((e=>{window.location="index.html"})).catch((e=>{console.log("Error: ",e)}))}window.addEventListener("load",getCourseList),0==checkPage&&(document.getElementById("editCourse").addEventListener("submit",editCourse),document.getElementById("deleteBtn").addEventListener("click",deleteCourse));
//# sourceMappingURL=../maps/main.js.map
