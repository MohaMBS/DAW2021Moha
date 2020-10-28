if (getCookie("color")!=""){
    let color = getCookie("color")
    document.body.style.backgroundColor = color;
    
}else{
    escullirColor = document.querySelector("#escullir");
    escullirColor.addEventListener("click", (event) => { 
    window.location.replace("http://dawjavi.insjoaquimmir.cat/mboughima/javascript/A05/eje3/eje3.html");  
    });
}


if (localStorage.numero==null){
    document.querySelector("#contador").innerHTML="0";
    localStorage.numero=1;
} else {
    localStorage.numero=Number(localStorage.numero)+1;
    document.querySelector("#contador").innerHTML=localStorage.numero;
}

function getCookie(nom) {
    var name = nom + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }           return "";       }