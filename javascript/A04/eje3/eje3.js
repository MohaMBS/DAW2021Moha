incio = false
if (incio == false){
    cont=1
    document.getElementById("imgpr").src="./eje3img/"+cont+".jpg"
    console.log(document.getElementById("imgpr").src)
    incio=true
}
const mas=()=>{
    if (cont == 10){
        cont=0
    }
    cont+=1
    console.log({cont})
    document.getElementById("imgpr").src="./eje3img/"+cont+".jpg"   
} 
const menos=()=>{
    if (cont == 1){
        cont=12-cont
    }
    cont=cont-1
    document.getElementById("imgpr").src="./eje3img/"+cont+".jpg"
}
document.getElementById("menos").addEventListener("click",()=>(menos()))
document.getElementById("mas").addEventListener("click",()=>(mas()))