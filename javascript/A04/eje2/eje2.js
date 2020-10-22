talb = document.querySelectorAll("td");

for (i=0; i< talb.length; i++){
    let colors = ["green","black","#E52B50","cyan","indigo","coral","red","blue","teal","yellow"]
    talb[i].addEventListener("mouseover", (event) => { 
        let x = Math.floor((Math.random() * 9) + 0);
        event.target.style.background=(colors[x])
        console.log(colors[x])
    });
    talb[i].addEventListener("mouseout", (event) => {    
        event.target.style.background='white'
    });
}
