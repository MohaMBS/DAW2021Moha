escullirColor = document.querySelectorAll("input[name=color]");
let color="";
for (i=0; i< escullirColor.length; i++){
    escullirColor[i].addEventListener("change", (event) => { 
        color= event.target.value 
    });
}

escullirColor = document.querySelector("#done");
escullirColor.addEventListener("click", (event) => { 
      setCookie("color",color, 30)
      setTimeout(function(){
        window.location.replace("http://dawjavi.insjoaquimmir.cat/mboughima/javascript/A05/eje2/eje2.html"),1000
      }) 
});


function setCookie(camp, valor, dies) {
    var d = new Date();
    d.setTime(d.getTime() + (dies*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = camp + "=" + valor + ";" + expires; }