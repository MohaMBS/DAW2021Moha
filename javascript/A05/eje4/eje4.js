escullirColor = document.querySelectorAll("input[name=color]");
escullirSize = document.querySelectorAll("input[name=size]");
let color="";
let tamano="";
for (i=0; i< escullirColor.length; i++){
    escullirColor[i].addEventListener("change", (event) => { 
        color= event.target.value 
    });
}
for (i=0; i< escullirSize.length; i++){
    escullirSize[i].addEventListener("change", (event) => { 
        tamano= event.target.value
    });
}

botonOk = document.querySelector("#done");
botonOk.addEventListener("click", (event) => { 
        localStorage.color=color;
        localStorage.tamano=tamano;
        setTimeout(function(){
        window.location.replace("http://dawjavi.insjoaquimmir.cat/mboughima/javascript/A05/eje2/eje2.html"),500
      });
});