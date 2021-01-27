document.getElementById("bt").addEventListener("click",()=>{
    numeros=[];
    for(i=0;i<30;i++){
        x=Math.floor(Math.random() *10)
        numeros.push(x);
    }
    console.log(numeros)
    document.getElementById("numero").innerHTML=""
    document.getElementById("numero").innerHTML+=c=numeros.filter((i) => {
        if(i%2==0 ){
            return i;
        }
    })
    console.log(c)
})