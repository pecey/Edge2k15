var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');

'floor|random|round|abs|sqrt|PI|atan2|sin|cos|pow'
  .split('|')
  .forEach(function(p) { window[p] = Math[p]; });

var TAU = PI*2;

function r(n) { return random()*n; }
function rint(lo, hi) {
  return lo + floor(r(hi - lo + 1))
}
function choose() {
  return arguments[rint(0, arguments.length-1)];
}

/*---------------------------------------------------------------------------*/

var W, H, frame, t0, time;

function resize() {
  W = canvas.width = innerWidth;
  H = canvas.height = innerHeight;
}

function loop(t) {
  frame = requestAnimationFrame(loop);
  draw();
  if(time>500)
    return false;
  time++;

}

function pause() {
  cancelAnimationFrame(frame);
  frame = frame ? null : requestAnimationFrame(loop);
}

function reset() {
  cancelAnimationFrame(frame);
  resize();
  ctx.clearRect(0, 0, W, H);
  init();
  time = 0;
  frame = requestAnimationFrame(loop);
}

/*---------------------------------------------------------------------------*/

function Painter(size) {
  this.density = size*5;
  this.nibs = new Array(this.density);
  var c = color();
  for (var i = 0; i < this.density; i++){
    this.nibs[i] = new Nib(c);
  }
}

Painter.prototype.relocate = function(x, y) {
  var dir = choose([0, -1], [0, 1], [1, 0], [-1, 0]);
  for (var i = 0; i < this.density; i++)
    this.nibs[i].reset(offsetX + SIZE*x, offsetY + SIZE*y, dir);
};

Painter.prototype.draw = function() {
  for (var i = 0; i < this.density; i++)
    this.nibs[i].draw();
};

function Nib(color) {
  this.color = color;
}

Nib.prototype.reset = function(x, y, dir) {
  var dx = dir[0];
  var dy = dir[1];
  this.x = x + (this.dx === -1 ? SIZE : 0) + rint(-3, 3);
  this.y = y + (this.dy === -1 ? SIZE : 0) + rint(-3, 3);
  if (dx === 0) this.x += rint(0, SIZE);
  if (dy === 0) this.y += rint(0, SIZE);
  this.tx = this.x + (SIZE * dx) + rint(-3, 3);
  this.ty = this.y + (SIZE * dy) + rint(-3, 3);
  this.dx = (this.tx - this.x) / STEP;
  this.dy = (this.ty - this.y) / STEP;
};

Nib.prototype.draw = function() {
  var x = this.x + this.dx;
  var y = this.y + this.dy;
  ctx.beginPath();
  ctx.moveTo(this.x, this.y);
  ctx.lineTo(x, y);
  ctx.strokeStyle = this.color;
  ctx.stroke();
  
  this.x = x;
  this.y = y;
}


/*---------------------------------------------------------------------------*/

var P = 50;

var SIZE = 20;
var STEP = 6;
var offsetX, offsetY;
var lenX, lenY;


function init() {
  lenX = floor(W/SIZE);
  lenY = floor(H/SIZE);
  offsetX = (W - lenX*SIZE) / 2;
  offsetY = (H - lenY*SIZE) / 2;
  painters = new Array(P);
  for (var i = 0; i < P; i++) painters[i] = new Painter(SIZE);
}

function color() {
  var n = random() < 0.4 ? rint(20, 30) : rint(180, 190);
  return 'hsla('+n+', 65%, 50%, 0.05)';
}

function draw() {
  var i;
  
  if (time % STEP === 0)
    for (i = 0; i < P; i++) 
      painters[i].relocate(rint(0, lenX), rint(0, lenY));

  for (i = 0; i < P; i++) painters[i].draw();
}

/*---------------------------------------------------------------------------*/

//document.onclick = pause;
document.ondblclick = reset;

reset();