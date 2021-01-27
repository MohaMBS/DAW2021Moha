document.getElementById("bt").addEventListener("click",()=>{
    document.getElementById("numero").innerHTML=mapa();
})

function mapa(){
    numeros=[];
    for(i=0;i<10;i++){
        x=Math.floor(Math.random() *10)
        numeros.push(x);
    }
    console.log("Numeros generados: "+numeros)
    numeros= numeros.map((i) => i+ Math.floor(Math.random() *10)); 
    console.log("Numeros con ya su suma : "+numeros)
    numeros= numeros.map((i) => {if(i%2==0){ return i/2}else{return i}});
    console.log("Numeros divididos: "+numeros)
    return numeros;
}