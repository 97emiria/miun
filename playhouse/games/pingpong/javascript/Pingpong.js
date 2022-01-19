import Ball from "./Ball.js"
import Paddle from "./Paddle.js"

const ball = new Ball(document.getElementById('ball'));
const playerPaddle = new Paddle(document.getElementById("player-paddle"));
const computerPaddle = new Paddle(document.getElementById("computer-paddle"));

//Score numbers
const playerScoreElem = document.getElementById('player-score');
const computerScoreElem = document.getElementById('computer-score');


let lastTime;


function update(time) {

    if(lastTime != null) {
        const delta = time - lastTime;
        ball.update(delta, [playerPaddle.rect(), computerPaddle.rect()]);

        //Make computer paddle to move
        computerPaddle.update(delta, ball.y)

        if(isLose()) handleLose() 
    }

    lastTime = time;
    window.requestAnimationFrame(update);
}

function isLose() {
    const rect = ball.rect();
    return rect.right >= window.innerWidth || rect.left <= 0
}

function handleLose() {
    const rect = ball.rect()
    if(rect.right >= window.innerWidth) {
        playerScoreElem.textContent = parseInt(playerScoreElem.textContent) + 1;
    } else {
        computerScoreElem.textContent = parseInt(computerScoreElem.textContent) + 1;
    }

    ball.reset();
    computerPaddle.reset()
}

document.addEventListener("mousemove", e => {
    playerPaddle.position = (e.y / window.innerHeight) * 100
})



let countDownMessage = document.getElementById('countDownMessage');
var timeleft  = 4;
var downloadTimer = setInterval(function(){

    countDownMessage.innerHTML = -1 + timeleft;


    if(timeleft <= 0){
      clearInterval(downloadTimer);
      countDownMessage.innerHTML = "";

      //Move ball?
        window.requestAnimationFrame(update);
    }

    timeleft -= 1;

}, 1000);

