escullirColor = document.querySelectorAll("input[name=color]");
escullirSize = document.querySelectorAll("input[name=size]");
let color="";
let tamano="";
function setCookie(camp, valor, dies) {
    var d = new Date();
    d.setTime(d.getTime() + (dies*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = camp + "=" + valor + ";" + expires; }
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
        setCookie("color",color+";path=/", 30);
        setCookie("size",tamano+";path=/", 30);
        setTimeout(function(){
        window.location.replace("http://dawjavi.insjoaquimmir.cat/mboughima/javascript/A05/eje2/eje2.html"),500
      });
});


