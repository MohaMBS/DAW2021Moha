/* PRACTICA A07 DE UF1 CALSES DE BUSCAMINAS */

botonIniciar=document.querySelector("#start");
botonParar=document.querySelector("#stop");
botonReiniciar=document.querySelector("#restart");
botonParar.disabled=true;
botonReiniciar.disabled=true;

var Taulell  = function(){
    
    this.numfilas=10;
    this.numColumnes=10;
    this.numBombes=10;
    this.numerosS=[];
    this.dibujo=[];

    this.crear = function(){
        console.log("Creando tablero.");
        totalCasillas=this.numfilas*this.numColumnes;
        for (i=0; i<totalCasillas; i++){
            this.dibujo.push(new Casella(i));
        }
        for(var i = 0; i < 10; i++){
            for(var j = 0; j < 10; j++){			           
               var div = document.createElement("div");
                if(i!=0){
                    div.id = i + "" + j;	 
                }else{
                    div.id = j ;
                }          
                tablerominas.appendChild(div);
            }
        }
    }

    this.omplir = function(){
        console.log("Generando posiciones de bombas.");
        while (this.numBombes > 0){
            x=Math.floor(Math.random() * this.dibujo.length);
            while((this.numerosS.indexOf(x))!=-1){
                x=Math.floor((Math.random() * this.dibujo.length) + 0);
            }
            this.numerosS.push(x);
            this.dibujo[x].contenido(-1);
            this.numBombes--;
        }
    }

    this.reset = function(){
        this.dibujo=[];
        this.omplir();
        console.log("llamado a reset.")
    }

    this.dibujar = function(){
        return this.dibujo;
    }
    
}

var ContadorTemps = function (){

    this.temps=0;
    
    this.activar= function(){
        if(this.temps == 0){
            document.querySelector("#tiempo").innerHTML=0;
            this.temps=parseInt(document.querySelector("#tiempo").innerHTML)+1;
            document.querySelector("#tiempo").innerHTML=this.temps;
        }
        tmp = setInterval(function(){
            this.temps=parseInt(document.querySelector("#tiempo").innerHTML)+1;
            document.querySelector("#tiempo").innerHTML=this.temps;
        },1000)
    }

    this.parar= function(){
        clearInterval(tmp);
    }

    this.reinicar= function(){
        this.temps=0;
        document.querySelector("#tiempo").innerHTML=0;
    }
}

var Casella = function(posi){

    this.localitzacio=posi;
    this.contingut=0;
    this.marcada=false;

    this.descobrir= function(){
        return this.contingut;
    }

    this.marcar= function(){
        this.marcada=!this.marcada;
    }

    this.contenido = function(content){
        this.contingut=content;
    }
    this.localizador=function(){
        return this.localitzacio;
    }
}

var ComptadorBanderes = function(){
    
    this.numBanderes=0;

    this.incrementar = function(){
        this.numBanderes++
    }

    this.decrementar = function(){
        this.numBanderes++
    }
}

var GestorPartides = function (partida){
    
    var partides=partida;

    this.desarPartida = function(){
        localStorage("partidaG",JSON.stringify(partides));
    }
    
    this.recuperarPartides = function(){
        return localStorage.getItem("partidaG");
    }
}

class Joc{
    tablero
    contador
    casillas
    contadorbanderas
    gestorpardita
    iniciado=false;
    espia
    flag=false
    
    constructor (){
        console.log("Se inicia el juego.");
        this.tablero = new Taulell();
        this.contador = new ContadorTemps();
        this.casillas = new Casella();
        this.contadorbanderas = new ComptadorBanderes();
        this.gestorpardita = new GestorPartides();
        
    }
    
    iniciarJuego (){
        this.contenido=document.querySelectorAll("td")
        console.log(this.contenido.length);
        this.contador.activar();
        if(this.flag==false){
            this.tablero.omplir();
            this.flag=true;
        }
        console.log("Creando el espia para ver donde haces click.");
        this.iniciado=true;
        console.log(this.tablero);
        botonIniciar.disabled=true;
        botonReiniciar.disabled=true;
        botonParar.disabled=false;
        return this.espia;
    }
    pararJuego(){
        botonIniciar.innerHTML="Seguir"
        botonIniciar.disabled=false;
        botonReiniciar.disabled=false;
        botonParar.disabled=true;
        this.contador.parar();
        this.iniciado=false;
    }
    reiniciarJuego(){
        botonIniciar.innerHTML="Iniciar";
        this.contador.reinicar();
        this.tablero.reset();
        this.flag=false; 
        location.reload();
    }
    espiaJuego(){
        this.espia=document.querySelectorAll("div");
        return this.espia;
    }
    empezadoJuego(){
        return this.iniciado;
    }
    calcularNumeros(){
        for (i = 0; i < this.tablero.dibujar().length;i++){
            this.x=this.tablero.dibujar()[i].descobrir();
            this.n=this.tablero.dibujar()[i].localizador();
            if(this.x == -1){
                if(i > 9){
                    this.tablero.dibujar()[i-10].contenido(+1)
                }
                if( i < 90){
                    this.tablero.dibujar()[i+10].contenido(+1)
                }

                if (i > 9 && i+1%10!=0){
                    if(this.tablero.dibujar()[i-9].descobrir()!=-1){
                        this.tablero.dibujar()[i-9].contenido(+1)
                    }
                }
                if (i+1%10!=0){
                    if(this.tablero.dibujar()[i+1].descobrir()!=-1){
                        this.tablero.dibujar()[i+1].contenido(+1)
                    }
                }
                if (i < 90 && i+1%10!=0){
                    if(this.tablero.dibujar()[i+11].descobrir()!=-1){
                        this.tablero.dibujar()[i+11].contenido(+1)
                    }
                }

                if (i > 9 && i%10!=0){
                    if(this.tablero.dibujar()[i-11].descobrir()!=-1){
                        this.tablero.dibujar()[i-11].contenido(+1)
                    }
                }
                if (i%10!=0){
                    if(this.tablero.dibujar()[i-1].descobrir()!=-1){
                        this.tablero.dibujar()[i-1].contenido(+1)
                    }
                }
                if (i < 90 && i%10!=0){
                    if(this.tablero.dibujar()[i+9].descobrir()!=-1){
                        this.tablero.dibujar()[i+9].contenido(+1)
                    }
                }
            }
        }
    }
}

partida = new Joc();
document.onload=partida.tablero.crear()
botonIniciar.addEventListener("click",function(){partida.iniciarJuego()
    console.log(partida.calcularNumeros())})
botonParar.addEventListener("click",function(){partida.pararJuego()})
botonReiniciar.addEventListener("click",function(){partida.reiniciarJuego();})
espia=partida.espiaJuego()
partida.empezadoJuego()
for (i=0; i< espia.length; i++){
    espia[i].addEventListener("click",function(event){
        if(partida.empezadoJuego()){
            console.log("estoy vigilando");
            if(Number.isInteger(parseInt(event.currentTarget.id,10))){
                if(partida.tablero.dibujar()[event.currentTarget.id].descobrir() == -1){
                    console.log(espia[parseInt(event.currentTarget.id)+2].id)
                    console.log("BOMBA")
                    alert("Has perdido le has dado a la bomba")
                    console.log(partida.tablero.dibujar())
                    espia[parseInt(event.currentTarget.id)+2].style.backgroundColor="transparent"
                    espia[parseInt(event.currentTarget.id)+2].style.backgroundImage="url('./mina.gif.')"
                    botonReiniciar.disabled=false;
                }else{
                    espia[parseInt(event.currentTarget.id)+2].style.backgroundColor="transparent"
                    console.log(espia[parseInt(event.currentTarget.id)+2].id)
                    console.log(partida.tablero.dibujar())
                    espia[parseInt(event.currentTarget.id)+2].innerHTML=partida.tablero.dibujar()[event.currentTarget.id].descobrir()
                    console.log("valor del contenido "+partida.tablero.dibujar()[event.currentTarget.id].descobrir())
                }
            }
        }
    })
}
