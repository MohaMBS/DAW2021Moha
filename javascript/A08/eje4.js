document.getElementById("bt").addEventListener("click",()=>{
    cartasn=[];
    cartas= ["assets/cartes/2C.png","assets/cartes/2D.png","assets/cartes/2H.png","assets/cartes/2S.png","assets/cartes/3C.png","assets/cartes/3D.png","assets/cartes/3H.png","assets/cartes/3S.png",
    "assets/cartes/4C.png","assets/cartes/4D.png","assets/cartes/4H.png","assets/cartes/4S.png","assets/cartes/4C.png","assets/cartes/4D.png","assets/cartes/4H.png","assets/cartes/4S.png",
    "assets/cartes/5C.png","assets/cartes/5D.png","assets/cartes/5H.png","assets/cartes/5S.png","assets/cartes/6C.png","assets/cartes/6D.png","assets/cartes/6H.png","assets/cartes/6S.png"
    ,"assets/cartes/7C.png","assets/cartes/7D.png","assets/cartes/7H.png","assets/cartes/7S.png","assets/cartes/8C.png","assets/cartes/8D.png","assets/cartes/8H.png","assets/cartes/8S.png"
    ,"assets/cartes/9C.png","assets/cartes/9D.png","assets/cartes/9H.png","assets/cartes/9S.png","assets/cartes/10C.png","assets/cartes/10D.png","assets/cartes/10H.png","assets/cartes/10S.png"
    ,"assets/cartes/JC.png","assets/cartes/JD.png","assets/cartes/JH.png","assets/cartes/JS.png","assets/cartes/KC.png","assets/cartes/KD.png","assets/cartes/KH.png","assets/cartes/KS.png"
    ,"assets/cartes/QC.png","assets/cartes/QD.png","assets/cartes/QH.png","assets/cartes/QS.png"]
    cartas.sort( (a, b) => 0.5 - Math.random());
    for(i=0;i<5;i++){
        x=cartas[Math.floor(Math.random() *cartas.length)]
        if(cartasn.indexOf(x)==-1){
            cartasn.push(x);
        }
    }
    cartasn.forEach((carta) => {  
        console.log(carta)     
    })
    document.getElementById("numero").innerHTML=cartasn.join(" ||| ");
    console.log(cartasn);
})