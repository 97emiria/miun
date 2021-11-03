


let c = 19;
let y = 97;
let m = 8;
let d = 6;

//Kontrollera om vi måste genomföra steg 1 enligt instruktionerna ovan

let veckodag = (d + ((13*(m+1))/5) + y + (y/4) + (c/4) + 5*c ) % 7;

let num = Math.round(veckodag);

if (num == 1) {
    console.log('Söndag');
} else if (num == 2) {
    console.log('Måndag');
} else if (num == 3) {
    console.log('Tisdag');
} else if (num == 4) {
    console.log('Onsdag'); 
} else if (num == 5) {
    console.log('Torsdag');
} else if (num == 6) {
    console.log('Fredag');
} else if (num == 7) {
    console.log('Lördag')
}
