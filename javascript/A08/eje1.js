document.getElementById("bg").addEventListener("click",()=>{
    numeros=[];
    numerosR=[];
    for (i = 0;i<10;i++){
        x=Math.floor(Math.random() *10)
        numeros.push(x);
    }
    for (i = 0;i<numeros.length;i++){
        if(numeros.indexOf(numeros[i])!= numeros.lastIndexOf(numeros[i])){
            if(numerosR.indexOf(numeros[i])==-1){
                numerosR.push(numeros[i]);
            }
        }
    }
    console.log("Lista original: "+numeros);
    console.log("Has reptido los siguentes numeros: "+numerosR);
    document.getElementById("numero").innerHTML=numeros;
})
