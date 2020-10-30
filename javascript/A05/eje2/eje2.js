if (getCookie("color")!="" && localStorage.color!=""){
    aplicarC = document.querySelector("#aplicarC");
    aplicarC.addEventListener("click", (event) => { 
        let color = getCookie("color")
        let tamano =getCookie("size")
        console.log(tamano)
        document.body.style.backgroundColor = color;
        document.images[0].width= tamano;
        document.images[0].height= tamano;  
    });

    aplicarL = document.querySelector("#aplicarL");
    aplicarL.addEventListener("click", (event) => { 
        document.body.style.backgroundColor = localStorage.color;
        document.images[0].width= localStorage.tamano;
        document.images[0].height= localStorage.tamano;  
    });

    escullirColor = document.querySelector("#escullirC");
    escullirColor.addEventListener("click", (event) => { 
        window.location.replace("http://dawjavi.insjoaquimmir.cat/mboughima/javascript/A05/eje3/eje3.html");  
    });
    escullirColor = document.querySelector("#escullirL");
    escullirColor.addEventListener("click", (event) => { 
        window.location.replace("http://dawjavi.insjoaquimmir.cat/mboughima/javascript/A05/eje4/eje4.html");  
    });
}else{
    escullirColor = document.querySelector("#escullirC");
    escullirColor.addEventListener("click", (event) => { 
    window.location.replace("http://dawjavi.insjoaquimmir.cat/mboughima/javascript/A05/eje3/eje3.html");  
    });
    escullirColor = document.querySelector("#escullirL");
    escullirColor.addEventListener("click", (event) => { 
        window.location.replace("http://dawjavi.insjoaquimmir.cat/mboughima/javascript/A05/eje4/eje4.html");  
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