let cartas= ["assets/cartes/2C.png","assets/cartes/2D.png","assets/cartes/2H.png","assets/cartes/2S.png","assets/cartes/3C.png","assets/cartes/3D.png","assets/cartes/3H.png","assets/cartes/3S.png",
    "assets/cartes/4C.png","assets/cartes/4D.png","assets/cartes/4H.png","assets/cartes/4S.png","assets/cartes/4C.png","assets/cartes/4D.png","assets/cartes/4H.png","assets/cartes/4S.png",
    "assets/cartes/5C.png","assets/cartes/5D.png","assets/cartes/5H.png","assets/cartes/5S.png","assets/cartes/6C.png","assets/cartes/6D.png","assets/cartes/6H.png","assets/cartes/6S.png"
    ,"assets/cartes/7C.png","assets/cartes/7D.png","assets/cartes/7H.png","assets/cartes/7S.png","assets/cartes/8C.png","assets/cartes/8D.png","assets/cartes/8H.png","assets/cartes/8S.png"
    ,"assets/cartes/9C.png","assets/cartes/9D.png","assets/cartes/9H.png","assets/cartes/9S.png","assets/cartes/10C.png","assets/cartes/10D.png","assets/cartes/10H.png","assets/cartes/10S.png"
    ,"assets/cartes/JC.png","assets/cartes/JD.png","assets/cartes/JH.png","assets/cartes/JS.png","assets/cartes/KC.png","assets/cartes/KD.png","assets/cartes/KH.png","assets/cartes/KS.png"
    ,"assets/cartes/QC.png","assets/cartes/QD.png","assets/cartes/QH.png","assets/cartes/QS.png"]//creamos una arry donde guardaremos todas las imagenes.

let btn_demanar=document.querySelector("#btn_demanar");
btn_demanar.addEventListener("click", ()=>(demanarCartes()))   
btn_demanar.disabled=true; 
let btn_aturar=document.querySelector("#btn_aturar");
btn_aturar.addEventListener("click", ()=>(tornComputador())) 
btn_aturar.disabled=true;
let btn_noujoc=document.querySelector("#btn_noujoc");
btn_noujoc.addEventListener("click", ()=>(inicialitza()))

let imgJugador=document.querySelectorAll("#jugador-cartes .cartah");
let imgIa=document.querySelectorAll("#ordinador-cartes .cartac");

let imahenes=document.querySelectorAll("img");

let cartasJugador=[]; //Para almacenar las cartas que le ha tocado al  jugador.
let cartasIa=[]; //Para almacenar las cartas que le ha tocado al la maquina.

let posiImg=0;
let posiImgI=0;
let puntosJ=0;
let puntosI=0;

let marcador=document.querySelectorAll("small");
function demanarCartes(){
    let carta = Math.floor((Math.random() * cartas.length) + 0);
    while (cartasJugador.indexOf(cartas)>-1){
        carta = Math.floor((Math.random() * cartas.length) + 0);
    }
    let cartaj=cartas[carta];
    cartasJugador.push(cartaj)
    console.log(cartasJugador);
    imgJugador[posiImg].src=cartaj;
    marcador[0].innerHTML=puntosJ+=valorCarta(cartaj);
    posiImg++;
    
    if(puntosJ>21){
        btn_demanar.disabled=true; 
        btn_aturar.disabled=true;
        btn_noujoc.disabled=false;
        setTimeout(()=>{
            alert("Has perdido...")},100)
        tornComputador();
    }
}

function tornComputador (){
    let maquinaPerdido=false
    if(puntosJ>21){
        maquinaPerdido=true;
        let carta = Math.floor((Math.random() * cartas.length) + 0);
        let cartai=cartas[carta];
        imgIa[posiImgI].src=cartai;
        marcador[1].innerHTML=puntosJ+=valorCarta(cartai);
    }else{
        setTimeout(()=>{
            while(maquinaPerdido==false){
                let carta = Math.floor((Math.random() * cartas.length) + 0);
                while (cartasIa.indexOf(cartas)>-1){
                    carta = Math.floor((Math.random() * cartas.length) + 0);
                }
                let cartai=cartas[carta];
                cartasIa.push(cartai)
                console.log(cartasIa);
                imgIa[posiImgI].src=cartai;
                marcador[1].innerHTML=puntosI+=valorCarta(cartai);
                posiImgI++;
                
                if(puntosI>21){
                    maquinaPerdido=true;
                    btn_demanar.disabled=true; 
                    btn_aturar.disabled=true;
                    btn_noujoc.disabled=false;
                    setTimeout(()=>{
                        alert("Has ganado humano...")},100)
                }
            }
        },1000)
    }
    
}

function valorCarta(carta){
    if(carta.indexOf("2")>-1){
        return 2;
    }else if (carta.indexOf("3")>-1){
        return 3;
    }else if (carta.indexOf("4")>-1){
        return 4;
    }else if (carta.indexOf("5")>-1){
        return 5;
    }else if (carta.indexOf("6")>-1){
        return 6;       
    }else if (carta.indexOf("7")>-1){
        return 7;
    }else if (carta.indexOf("8")>-1){
        return 8;
    }else if (carta.indexOf("9")>-1){
        return 9;
    }else if (carta.indexOf("10")>-1){
        return 10;
    }else if (carta.indexOf("A")>-1){
        return 11;
    }
    else if (carta.indexOf("Q")>-1){
        return 10;
    }
    else if (carta.indexOf("K")>-1){
        return 10;
    }else if (carta.indexOf("J")>-1){
        return 10;
    }
}

function inicialitza (){
    btn_demanar.disabled=false; 
    btn_aturar.disabled=false;
    btn_noujoc.disabled=true;
    posiImg=0;
    posiImgI=0;
    puntosJ=0;
    puntosI=0;
    marcador[0].innerHTML=0;
    marcador[1].innerHTML=0;
    for (i=0; i<imahenes.length;i++){
        imahenes[i].src="assets/cartes/blanc.png"
    }
}

    