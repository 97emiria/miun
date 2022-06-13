
//Elements from public webbpage
let portfolioDiv = document.getElementById('portfolioDiv');
let workList = document.getElementById("workList");                     //Uses on work-page (not admin-related)

//Table element from front page
let courseListTable = document.getElementById("courseListTable");       //Uses on education-page (not admin-related)
let oldCourseList = document.getElementById("courseOldListTable");


//Get elements for index page
let indexEl = document.getElementById("indexText");
let aboutText = document.getElementById("aboutText");
let aboutImg = document.getElementById("aboutImg");
let aboutTitle = document.getElementById("aboutTitle");
let cMobile = document.getElementById("contact_mobile");
let cMail = document.getElementById('contact_mail');
let cGithub = document.getElementById('contact_github');

let getWorkFrontPage = () => {
    fetch(apiLinkWork)
    .then(response => response.json())
        .then(data => {
            data.forEach(work => {

              if (workList != null) {
                    workList.innerHTML += `
                        <section class="work_sectionDesign">
                            <div> 
                                <h2>${work.title}</h2>
                                <p> ${work.comment} </p>
                                <p class="work_dateTime"> ${work.workplace} <br> ${work.date}</p>
                            </div>
                        </section>
                    `;
              }
                
            })
        })
}


//Print out on main page 
let getWebbpages = () => {
    fetch(apiLinkWebbpages)
    .then(response => response.json())
        .then(data => {
            data.forEach(webbpages => {

                if(webbpages.imgPath == null || webbpages.imgPath == 'empty') {
                    
                    portfolioDiv.innerHTML += `
                        <h2>${webbpages.title}</h2>
                        <div class="portfolioFlex"> 
                            <div>
                                <p> ${webbpages.description} </p>
                                <p> Kika på webbplatsen här: <a href="${webbpages.link}" target="_blank"> webblänk till ${webbpages.title} </a> </p>
                            </div>

                            <div>
                                <img src="../images/missing.png" style="border: 2px solid #ddd;" alt="">
                            </div>
                        </div>

                    `;

                } else {
                    portfolioDiv.innerHTML += `
                    <h2>${webbpages.title}</h2>
                    <div class="portfolioFlex"> 
                        <div>
                            <p> ${webbpages.description} </p>
                            <p> Kika på webbplatsen här: <a href="${webbpages.link}" target="_blank"> webblänk till ${webbpages.title} </a> </p>
                        </div>

                        <div>
                            
                            <a href="${webbpages.link}" target="_blank" title="Till webbplatsen ${webbpages.title}" ><img src="${webbpages.imgPath}" alt=""></a>
                        </div>
                    </div>

                    `;
                }
                
            })
        })
}




let getTextsForIndex = () => {
    fetch(apiLinkTexts)
    .then(response => response.json())
        .then(data => {

            data.forEach(texts => {

                if(texts.title == 'Index' && indexEl != null) {
                    indexEl.innerHTML = texts.theText;
                }

                if(texts.title == 'About' && aboutText != null) {
                    aboutText.innerHTML = texts.theText;
                    aboutImg.innerHTML = `<img src="${texts.imgPath}" alt=""/> `
                }

                if(texts.title == 'Mobile' && cMobile != null) {
                    cMobile.innerHTML = `<a href="tel:${texts.theText}">${texts.theText}</a>`;
                }

                if(texts.title == 'Mail' && cMail != null) {
                    cMail.innerHTML = `<a href="mailto:${texts.theText}">${texts.theText}</a>`;
                }

                if(texts.title == 'Github' && cGithub != null) {
                    cGithub.innerHTML = `<a href="https://github.com/${texts.theText}">${texts.theText}</a>`;

                }
            })
        })

}



//Education page
let getTextsEducation = () => {
    fetch(apiLinkTextsWithID+3)
    .then(response => response.json())
        .then(data => {
            data.forEach(texts => {

            if(educationEl != null) {
                educationEl.innerHTML += `
                    <p> ${texts.theText} </p>
                `;
            }
                
            })
        })
}




//Uses on front page
let getEducationList = () => {
    fetch(apiLinkEducation)
    .then(response => response.json())
        .then(data => {

            data.forEach(education => {

                if(courseListTable != null && education.school == 'Mittuniversitetet' && education.status == 0) {
                    let edSta = "Pågående" ;

                    courseListTable.innerHTML += ` 
                    <tr> 
                        <td> ${education.title} </td>
                        <td> ${education.comment} </td>
                        <td> ${education.semester} ${education.date} </td>
                        <td> ${edSta} </td>
                    </tr>
                    `;
                } else if(courseListTable != null && education.school == 'Mittuniversitetet' && education.status == 1){
                    let edSta = "Avslutad" ;
                        courseListTable.innerHTML += ` 
                        <tr> 
                            <td> ${education.title} </td>
                            <td> ${education.comment} </td>
                            <td> ${education.semester} ${education.date} </td>
                            <td> ${edSta} </td>
                        </tr>
                        `;
                } 
            

                if(oldCourseList != null && education.school != 'Mittuniversitetet') {
                    oldCourseList.innerHTML += ` 
                    <tr> 
                        <td> ${education.title} </td>
                        <td> ${education.comment} </td>
                        <td> ${education.semester} ${education.date} </td>
                    </tr>
                    `;
                }

            })
        })
}


