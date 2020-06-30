/* let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById('abrir');
let cerrar = document.getElementById('close');

abrir.addEventListener('click', function(){
    modal.style.display='block';
});


cerrar.addEventListener('click', function(){
    modal.style.display='none';
});

window.addEventListener('click', function(e){
    if(e.target == flex){
        modal.style.display='none';
    }
}); */

let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById('abrir');
let cerrar = document.getElementById('close');

abrir.addEventListener('click', function(){
    modal.style.display='block';
});


cerrar.addEventListener('click', function(){
    modal.style.display='none';
});

window.addEventListener('click', function(e){
    if(e.target == flex){
        modal.style.display='none';
    }
});

var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  x[slideIndex-1].style.display = "block"; 
}