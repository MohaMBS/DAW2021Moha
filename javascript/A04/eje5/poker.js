var imgs = document.querySelectorAll("img");
const borrar= () =>{
    for (i=0; i< imgs.length; i++){
        clearInterval(bucle)
        imgs[i].src="revers.png";
        document.getElementById("ini").value="ini"
        document.getElementById("ini").innerHTML="Iniciar"
    }
} 
const iniciar= () =>{
    var tipo = ["cors","diamants","picas","trevol"];
    if (document.getElementById("ini").value  == "ini"){
        document.getElementById("ini").value="Parar"
        document.getElementById("ini").innerHTML="Parar"
        bucle=setInterval(function(){
            for (i=0; i< imgs.length; i++){
                var numerossalidos=[]
                var xnumero=Math.floor((Math.random() * 14) + 0)
                while  (xnumero in numerossalidos){
                    var xnumero=Math.floor((Math.random() * 14) + 0)
                }
                imgs[i].src=xnumero+tipo[Math.floor((Math.random() * 3) + 0)]+".png"
            }
        }, 1000);
    }
    else if (document.getElementById("ini").value  == "Parar"){
        clearInterval(bucle)
        document.getElementById("ini").value="ini"
        document.getElementById("ini").innerHTML="Iniciar"
    }
}
document.getElementById("ini").addEventListener("click",()=>(iniciar()))
document.getElementById("borrar").addEventListener("click",()=>(borrar()))