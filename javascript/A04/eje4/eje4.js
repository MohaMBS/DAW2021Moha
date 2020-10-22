var cont = 0;
document.getElementById("start").addEventListener("click",()=>(alea()))
const alea= () => {
    let imagenes = ["planta1.jpg","planta2.jpg","planta3.jpg","zombie1.jpg","zombie2.jpg","zombie3.jpg"];
    let img1 = Math.floor((Math.random() * 6) + 0);
    let img2 = Math.floor((Math.random() * 6) + 0);
    let img3 = Math.floor((Math.random() * 6) + 0);
    let img4 = Math.floor((Math.random() * 6) + 0);
    console.log(imagenes[img1])
    document.getElementById("iuno").src=imagenes[img1]
    document.getElementById("idos").src=imagenes[img2]
    document.getElementById("itres").src=imagenes[img3]
    document.getElementById("icuatro").src=imagenes[img4]
    if (img1 == img2 || img1 == img3 || img1 == img4 || img2 == img3 || img2 == img4 || img3 == img4){
        cont+=1;
        document.getElementById("resultat").innerHTML= "N'hi ha "+cont;
    }
} 
