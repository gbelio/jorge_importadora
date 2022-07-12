let box = document.getElementById("box_ppal");
let that = document.getElementById("galery");
let photos = document.getElementsByClassName("img_gallery");
let selection = [];
for (i=0; i<photos.length; i++){
    selection.push(photos[i]);
};
for(i=0;i<selection.length;i++){
    console.log(selection[i]);
    selection[i].addEventListener('click',function(e){
        if(e.target.currentSrc !== box.src){
            box.src=e.target.currentSrc;
        }
    });
}



