divs = document.querySelectorAll("#cambio");

for (i=0; i< divs.length; i++){
    divs[i].addEventListener("mouseover", (event) => { 
        event.target.style.background='red'
        event.target.style.fontSize = '30px'
        event.target.style.color= 'white'  
    });
    divs[i].addEventListener("mouseout", (event) => {    
        event.target.style.background='white'
        event.target.style.fontSize = '30px'
        event.target.style.color= 'red'
    });
}
