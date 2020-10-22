const generadaor=()=>{
    let numeroAle = Math.floor((Math.random() * 7) + 0);
    document.getElementById("imgpr").src="./numeors/"+numeroAle+".jpg"
    switch(numeroAle){
        case 1:
            let n1= parseInt(document.getElementById("n1").innerHTML)+1
            document.getElementById("n1").innerHTML=n1
            break;
        case 2:
            let n2= parseInt(document.getElementById("n2").innerHTML)+1
            document.getElementById("n2").innerHTML=n2
            break;
        case 3:
            let n3= parseInt(document.getElementById("n3").innerHTML)+1
            document.getElementById("n3").innerHTML=n3
            break;
        case 4:
            let n4= parseInt(document.getElementById("n4").innerHTML)+1
            document.getElementById("n4").innerHTML=n4
            break;
        case 5:
            let n5= parseInt(document.getElementById("n5").innerHTML)+1
            document.getElementById("n5").innerHTML=n5
            break;
        case 6:
            let n6= parseInt(document.getElementById("n6").innerHTML)+1
            document.getElementById("n6").innerHTML=n6
            break;
    }
}
document.getElementById("generar").addEventListener("click",()=>(generadaor()))
