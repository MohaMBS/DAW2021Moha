zeldas = document.querySelectorAll("img ");
casilla = document.querySelectorAll("td");
let cantidadMinas=10;
var posicionesMinas=[];
while(cantidadMinas >0){
    let x=Math.floor((Math.random() * 100) + 0);
    while((posicionesMinas.indexOf(x))!=-1){
        x=Math.floor((Math.random() * 100) + 0);
    }
    posicionesMinas.push(x);
    console.log(posicionesMinas);
    cantidadMinas--;
}
console.log(cantidadMinas)
let c=0;
let x=0;
cont=0;
while(cantidadMinas<100){
    cantidadMinas+=1;
    if(cont%10==0 ){
        c=1-c
    }
    if(c==0){
        zeldas[x].src ="./claro.png";
        zeldas[x].height="50";
        zeldas[x].width="50";
        zeldas[x].style.className="eye";
        c=1;
    }
    else if(c==1){
        zeldas[x].src ="./oscuro.png";
        zeldas[x].height="50";
        zeldas[x].width="50";
        zeldas[x].style.className="eye";
        c=0;
    }
    x++;
    cont++;
    console.log(x)
}
for (i=0; i< casilla.length; i++){
    casilla[i].id=i;
}
for (i=0; i< zeldas.length; i++){
    casilla[i].addEventListener("click", (event) => { 
        if(posicionesMinas.indexOf(event.target.id)!=0){
            zeldas[event.target.id].src ="./mina.png";
            zeldas[event.target.id].height="50";
            zeldas[event.target.id].width="50";
        }console.log(event.target.id)
        zeldas[event.target.id].src ="./nada.png";
        zeldas[event.target.id].height="50";
        zeldas[event.target.id].width="50";  
    });
}
