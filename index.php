<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
    body {
background-color: #b3daff;
 
}
#my-canvas {
  
  position:relative;
  left: 0px;
  top: 100px;
  
  border: groove 7px coral;
  background-color: black;
  z-index: 1;
}
#welcome-message{
position:absolute;
top:20px;
left:20px;
font-family:font-family: 'Castoro', serif;
font-size:20px;
z-index:12;
}
.btn--new {
  position: absolute;
  top: 5px;
  left: 50%;
  transform: translateX(-50%);
  color: #444;
  background: none;
  border: none;
  font-family: inherit;
  font-size: 1.8rem;
  text-transform: uppercase;
  cursor: pointer;
  font-weight: 400;
  transition: all 0.2s;

  background-color: white;
  background-color: rgba(255, 255, 255, 0.6);
  backdrop-filter: blur(10px);

  padding: 0.7rem 2.5rem;
  border-radius: 50rem;
  box-shadow: 0 1.75rem 3.5rem rgba(0, 0, 0, 0.1);
}
#high-score {
  position: absolute;
  top: 5px;
  left: 80%;
  transform: translateX(-50%);
  color: #444;
  background: none;
  border: none;
  font-family: inherit;
  font-size: 1.8rem;
  text-transform: uppercase;
  cursor: pointer;
  font-weight: 400;
  transition: all 0.2s;

  background-color: white;
  background-color: rgba(255, 255, 255, 0.6);
  backdrop-filter: blur(10px);

  padding: 0.7rem 2.5rem;
  border-radius: 50rem;
  box-shadow: 0 1.75rem 3.5rem rgba(0, 0, 0, 0.1);
}
#score {
  position: absolute;
  top: 5px;
  left: 20%;
  transform: translateX(-50%);
  color: #444;
  background: none;
  border: none;
  font-family: inherit;
  font-size: 1.8rem;
  text-transform: uppercase;
  cursor: pointer;
  font-weight: 400;
  transition: all 0.2s;

  background-color: white;
  background-color: rgba(255, 255, 255, 0.6);
  backdrop-filter: blur(10px);

  padding: 0.7rem 2.5rem;
  border-radius: 50rem;
  box-shadow: 0 1.75rem 3.5rem rgba(0, 0, 0, 0.1);
}
.btn--log{
position:absolute;
top:10px;
right:10px;
font-family:font-family: 'Castoro', serif;
font-size:20px;
z-index:12;
background-color:#ffcc00;

}

/*#rect {
  position: absolute;
  top: 415px;
  
  right: 700px'
  background-color: purple;
  width: 25px;
  height: 25px;
  z-index: 2;
}*/

    </style>
    <title>Snake</title>
  </head>
  <body>

<div id="welcome-message"></div>
    <div id="high-score" name="high-score">High Score:<span id="my-high-score">0</span></div>
    <div id="score">Score:<span id="my-score">0</span></div>
    <button class="btn btn--new">🔄 New game</button>
    <audio src="dead.wav" id="gameover"></audio>
    <audio src="up.mp3" id="up"></audio>
    <audio src="down.mp3" id="down"></audio>
    <audio src="left.mp3" id="left"></audio>
    <audio src="right.mp3" id="right"></audio>
    <audio src="gallop.wav" id="gallop"></audio>
    
   <!-- <form>
<input  style="position:relative;" name="new_high_score" id="myText">
    </form>-->
    <div id="rect"></div>
    <canvas
      id="my-canvas"
      width="1189px"
      height="514px"
      border="groove 7px coral"
    >
    </canvas>
    
    
    
    <script type="text/javascript">
     
    // document.querySelector("#myhighscore5").innerHTML=-90;
    

document.body.style.zoom = "90%";



var myCanvas = document.getElementById("my-canvas");
var context = myCanvas.getContext("2d");
let interval;
let highscore=0;
let dead=new Audio();
dead.src="gallop.mp3";
function newGame()
{
  alert("Please set the zoom level atmost 90% for best experiences");
let b=0;
document.querySelector("#score").textContent = "SCORE: "+0;
let box = 25;
let snake = [
  {
    snakeX: 575,
    snakeY: 250,
  },
  {
    snakeX: 600,
    snakeY: 250,
  },
];
let x, y;

function positionFood() {
  x = Math.floor(Math.random() * 47)+1;
  y = Math.floor(Math.random() * 20)+1;
  for(let j=0;j<snake.length;j++)
  if((snake[j].snakeX===(x-1)*25&&snake[j].snakeY===(y-1)*25)||(x==1||y==1))
  positionFood();
  context.beginPath();
  context.arc((2 * x - 1) * 12.5, (2 * y - 1) * 12.5, 12.5, 0, 2 * Math.PI);
  context.stroke();
  context.fillStyle = "#2e2eb8";
  context.fill();
}
positionFood();
//Properties

let time = 4;

//Animation

let d = "";
let score = 0;

document.addEventListener("keydown", function (e) {
  if(e.key==="ArrowLeft"||e.key==="ArrowRight"||e.key==="ArrowUp"||e.key==="ArrowDown")
  e.preventDefault();
  if (e.key === "ArrowLeft" && d != "right") {

    d = "left";
    const sound=document.getElementById("left");
  sound.pause();
  sound.currentTime=0;
  sound.play();
  
  } else if (e.key === "ArrowRight" && d != "left") {
    d = "right";
    const sound=document.getElementById("left");
  sound.pause();
  sound.currentTime=0;
  sound.play();
  } else if (e.key === "ArrowUp" && d != "down") {
    d = "up";
    const sound=document.getElementById("up");
  sound.pause();
  sound.currentTime=0;
  sound.play();
  } else if (e.key === "ArrowDown" && d != "up") {
    d = "down";
    const sound=document.getElementById("down");
  sound.pause();
  sound.currentTime=0;
  sound.play();
  }
});
let c = 0;
let oldX = 0;
let oldY = 0;
let X = 0;
let Y = 0;
function Alert()
{
  alert("Game Over");
 
}
function gameOver()
{
  clearInterval(interval);
  const sound=document.getElementById("gameover");
  sound.pause();
  sound.currentTime=0;
  sound.play();

 setTimeout(Alert,3000);

if(score>highscore)
{
  highscore=score;
  document.querySelector('#high-score').textContent="HIGH SCORE:"+highscore;
}

 
score=0;
}
function draw() {
  let k = 0;
  if (!((X - (2 * x - 1) * 12.5 === -12.5) && (Y - (2 * y - 1) * 12.5 === -12.5)))
    context.clearRect(oldX, oldY, box, box);
  else {
    score += 5;
    clearInterval(interval);
    interval=setInterval(draw,90-(score)/20);
    k = 1;
    document.querySelector("#score").textContent = "SCORE: "+score;
  }
   
  context.fillStyle = "purple";
  context.fillRect(snake[0].snakeX, snake[0].snakeY, box, box);
  
 
  if (k == 1) {
    k = 0;
    positionFood();
  }
  for (let i = 0; i < snake.length && c == 0; i++) {
    context.fillStyle = "purple";
    context.fillRect(snake[i].snakeX, snake[i].snakeY, box, box);
  }
  X = snake[0].snakeX;
  Y = snake[0].snakeY;
  oldX = snake[snake.length - 1].snakeX;
  oldY = snake[snake.length - 1].snakeY;
  if (d == "left") {
    X -= box;
    c++;
  }
  if (d == "right") {
    X += box;
    c++;
  }
  if (d == "up") {
    c++;
    Y -= box;
  }
  if (d == "down") {
    Y += box;
    c++;
  }
 b=0;
  if((X<0||X>1175||Y<0||Y>500))
  b=1;
  
  for(let j=1;j<snake.length;j++)
  {
    if(snake[j].snakeX===X&&snake[j].snakeY===Y&&d!="")
    {
      b=1;
      break;
    }
  }
  if(b===1)
  {
   
  setTimeout(gameOver,100);
  
  }
  let newHead = {
    snakeX: X,
    snakeY: Y,
  };
  if (!((X - (2 * x - 1) * 12.5 === -12.5) && (Y - (2 * y - 1) * 12.5 === -12.5))) {
    snake.pop();
  }
  else
  {
    const sound=document.getElementById("gallop");
    sound.pause();
    sound.currentTime=0;
    sound.play();
  }
  snake.unshift(newHead);
  /*if(b==1)
  {
  setTimeout(gameOver,100);
  return;
  }*/

}
 interval=setInterval(draw, 90);

}
newGame();
document.querySelector(".btn--new").addEventListener("click",function(){
  clearInterval(interval);

 context.clearRect(0,0,1189,514);
 
 
newGame();
});

    </script>
  </body>
</html>
