document.getElementById("bt").addEventListener("click",()=>{
    vecotr1=[];
    vector2=[];
    vector3=[];
    for (i = 0; i<10 ; i++){
        x=Math.floor(Math.random() *10);
        vecotr1.push(x);
        x=Math.floor(Math.random() *10);
        vector2.push(x);
    }
    vecotr1.forEach((valor) => {
        console.log(valor)
        if(vector2.indexOf(valor)>=0 && vector3.indexOf(valor)==-1){
            vector3.push(valor)
            console.log(valor)
        }
    });
    document.getElementById("numero").innerHTML=vector3;
    console.log(vector3);
})