// BlackJack
// El primer que arriba 21 guanya. Si passes de 21 perds
// 2C 2 de Clubs (trebols)   <--  Cartes les tenia en anglès
// 2D Diamants
// 2H  Hearts --> cors
// 2S   Spades (Espases)
$( document ).ready(function(){
    let deck = [];
    const tipus = ['C','D','H','S'];
    const especials = ['A','J','Q','K'];
    let comptadorh;  // comptador cartes humà
    let comptadorc;  // comptador cartes computadora
    let puntsh;
    let puntsc;
    let temps;
    let interval;
    // DOM 
    //const divcartesc  = document.querySelector("#ordinador-cartes");
    //const divcartesh  = document.querySelector("#jugador-cartes");
    //const btn_demanar = document.querySelector("#btn_demanar");
    //const btn_aturar = document.querySelector("#btn_aturar");
    //const btn_iniciar = document.querySelector("#btn_noujoc");
    //const subtitol = document.querySelector(".subtitol");  // primer element

    const reordena = (deckr) => {

        // fem un reordenament brut
        console.log(deck);
        console.log(deckr);

        let v;
        let temp;
        let longi=deckr.length;
        console.log(longi);

        for (i=0; i<longi;i++)
        {
            // Fem intercanvi a parelles de forma aleatòria
            v=Math.floor(Math.random()*longi);
            //console.log(v);
            temp = deckr[i]; 
            deckr[i] = deckr[v];
            deckr[v] = temp;

        }
        return deck;
        console.log(deckr);
    }
    // Inicialitza el joc
    const crearDeck = () => {

        // Anula el temporitzador
        clearInterval(interval);

        // Inicialitzo variables
        comptadorh=0;  // comptador cartes humà
        comptadorc=0;  // comptador cartes computadora
        puntsh = 0;
        puntsc = 0;
        temps = 0;

        // reactivo butons
        $("#btn_demanar").prop("disabled",false);
        $("#btn_aturar").prop("disabled",false);

        // Reprograma el temporitzador
        interval = setInterval(() => {
            
            $(".subtitol").html((temps++)+" segons");

        }, 1000);

        // Poso les cartes cara avall
        $(".cartac , .cartah").attr("src","assets/cartes/blanc.png")
        img_cartes = $("img");


        // Poso a zero els comptadors
        //$("small")[1].innerHTML="0";
        //$("small")[0].innerHTML="0";


        for (i=2;i<10;i++){
            for (tipu of tipus ) {
                deck.push(i+tipu);
                console.log(i+tipu);
            }
        }
        for (tipu of tipus) {
            for (esp of especials)
            {
                deck.push (esp + tipu);
            }
        }
        // aleatoritza l'ordre de l'array --> Barallar les cartes
        // reordena l'array amb el mètode sort
        //return reordena(deck);
        deck = deck.sort (function()  { return  Math.random() - 0.5 });
        
        //console.log(deck);
        return deck;

    }

    const demanarCarta = () => {

        if (deck.length == 0)
        {
            throw "No hi ha carta al deck" ;
        }
        const carta = deck.pop();
        
        console.log(deck);
        console.log(carta);

        return carta;
    }

    const valorCarta = (carta) => {

        const valor = carta.substring(0,carta.length-1);
        console.log({carta});
        //console.log({punts});
        return isNaN(valor) ? ((valor == 'A') ? 11 : 10) : valor*1;
        
        /*if (isNaN(valor)){
            // No és un valor numèric
            punts = (valor == 'A') ? 11 : 10;        
        }
        else{
            // És un valor numèric
            punts = valor * 1;  // *1 : convertim a enter
        }
        */
    }
    const tornComputer = ( puntsMinims) => {

        let img_cartes = $(".cartac");
        puntsc=0;

        do {

            let cart = demanarCarta();
            puntsc += valorCarta(cart);

            $("<img/>",{
                'class' : 'cartac',
                'src' : "./assets/cartes/"+cart+".png"
            }).appendTo('#ordinador-cartes');

            //$(img_cartes[comptadorc++]).attr("src","assets/cartes/"+cart+".png");
            
            $("small")[1].innerHTML=puntsc;
            /*if (puntsc > 21) { //alert("S'acabo ordenaor");  
            }
            else if (puntsh == 21) { //alert("Ha guanyat la màquina"); 
            }

            if (puntsMinims > 21)
            {   // Només una carta, si l'altre ha fet més de 21 guanya únicament
                // amb una carta
                break;
            }*/
            
        }while( (puntsc < puntsMinims) && puntsMinims <= 21);

        clearInterval(interval);

        // El settimeout garanteix que es mostraran les cartes abans de l'alert
        setTimeout( () => {
            if (puntsc == puntsMinims) {
                alert("Ningú guanya :-( ");
            }
            else if (puntsMinims > 21) {
                alert ("L'ordinador guanya");
            } else if (puntsc > 21) {
                alert ("Guanya la persona humana");
            } else if (puntsc > puntsMinims) {
                alert ("Guanya la màquina");
            } else {
                alert ("Guanya la persona ");
            }

        },100);
    }


    $("#btn_aturar").click(function(){

        $("#btn_demanar").prop("disabled",true);
        $("#btn_aturar").prop("disabled",true);
        
        tornComputer(puntsh);
        clearInterval(interval);
        
    });

    $("#btn_demanar").click(function(event){
        // Demanar Carta

        let img_cartes = $(".cartah");

        if (comptadorh < 11) {   // comencem per zero
            let cart = demanarCarta();
            puntsh += valorCarta(cart);
            $("<img/>",{
                'class' : 'cartah',
                'src' : "./assets/cartes/"+cart+".png"
            }).appendTo('#jugador-cartes');
            //$(img_cartes[comptadorh++]).attr("src","assets/cartes/"+cart+".png");
            
            $("small")[0].innerHTML=puntsh;
            if (puntsh > 21) { 
                //alert("S'acabo"); 
                $("#btn_demanar").prop("disabled",true);
                $("#btn_aturar").prop("disabled",true);
                tornComputer(puntsh);
            }
            else if (puntsh == 21) { 
                //alert("Has guanyat"); 
                $("#btn_demanar").prop("disabled",true);
                $("#btn_aturar").prop("disabled",true);
                tornComputer(puntsh);
            }

        }
        else{
            console.log("Aqui no hauriem de poder arribar");
        }
    
    });

    $("#btn_noujoc").click(function(){
        crearDeck();
    });

    

    //crearDeck();
    //console.log(valorCarta(demanarCarta()));

    //tornComputer(12);

})
