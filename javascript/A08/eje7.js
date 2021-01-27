document.getElementById("bt").addEventListener("click",()=>{
    texto=[]=cadena=(document.querySelector("#textA").value).split(" ")
    console.log(texto)
    console.log("1e valor: "+texto[0]+" Ultim valor: "+texto[texto.length-1])
    console.log("Al reves: "+texto.reverse())
    console.log("A-Z: "+texto.sort())
    console.log("Z-A: "+texto.sort().reverse())
})
