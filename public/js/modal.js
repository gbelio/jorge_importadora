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
getElementById('"")
window.addEventListener('click', function(e){
    if(e.target == flex){
        modal.style.display='none';
    }
}); */

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
} */

/* let box = document.getElementById('box_ppal');
let selection = [document.getElementById('galery');]
let selector = selection.src;
console.log(selector, box);

selection.addEventListener('click', function(e){
    console.log(selector);
    console.log(box);
    if(e.target == selection){
        box.src=selector;
        console.log(selector);
        console.log(box);
    }
}); */


let box = document.getElementById("box_ppal");
let that = document.getElementById("galery");
let photos = document.getElementsByClassName("img_gallery");
let selection = [];

for (i=0; i<photos.length; i++){
    selection.push(photos[i])/* .src */;
};

/* console.log(selection); */

for(i=0;i<selection.length;i++){
    console.log(selection[i]);
    selection[i].addEventListener('click',function(e){
        /* console.log(e);
        console.log(e.path[0].src);
        console.log("click");
        console.log(box.src);
        if(e.path[0].src !== box.src){
            box.src=e.path[0].src;
        } */
        if(e.target.currentSrc !== box.src){
            box.src=e.target.currentSrc;
        }
    });
}
/* that.addEventListener('click',function(){
    console.log("click");
}) */




/*  for(i=0; i< selection.length; i++){
    console.log(selection[i]);
     selection[i].addEventListener('click', function(){
         
        if(selection[i].src != box.src){
            
            box.src = selection[i].src;
        }
     }); */
    /* selection[i].addEventListener('click',function(e){
        console.log(selection[i]); */
        /* console.log(box.src); */
    /* }); */
/* };  */
/* console.log(selection);
console.log(that);
console.log(selection.src); */
/* for(i=0; i<that.length; i++){
    that.addEventListener('click',function(){
        if(that.src === selection.src){
            box.src = selection.src
        };
    });
}; */

