$(document).ready(function(){
    /* PRACTICA A12 DE UF2 AMBD CALSES BUSCAMINAS */
    botonIniciar=$("#start");
    botonParar=$("#stop");
    botonReiniciar=$("#restart");
    $(botonReiniciar).prop('disabled', true);
    $(botonParar).prop('disabled', true);
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
                    if(i!=0){
                        $('<div id="'+i+''+j+'"></div>').appendTo("#tablerominas")
                        console.log("intenta crear el div")
                    }else{
                        console.log("intenta crear el div")
                        $("#tablerominas").append('<div id="'+j+'"></div>')
                    }          
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
        this.saberPsoiBombas= function(){
            return this.numerosS;
        }
        
    }

    var ContadorTemps = function (){

        this.temps=0;
        
        this.activar= function(){
            if(this.temps == 0){
                this.temps+=1;
                $("#tiempo").html(this.temps);
            }
            tmp = setInterval(function(){
                this.temps=parseInt($("#tiempo").text())+1;
                $("#tiempo").html(this.temps);
            },1000)
        }

        this.parar= function(){
            clearInterval(tmp);
        }

        this.reinicar= function(){
            this.temps=0;
            $("#tiempo").html(0);
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
            this.contingut+=content;
        }
        this.localizador=function(){
            return this.localitzacio;
        }
    }

    var ComptadorBanderes = function(){
        
        this.numBanderes=10;

        this.incrementar = function(){
            this.numBanderes++;
        }

        this.decrementar = function(){
            console.log("decrement");
            this.numBanderes--;
        }
        this.sNumBanderes = function (){
            console.log("hay un total de --->"+this.numBanderes+" banderas");
            return this.numBanderes;
        }
        this.cNumBanderes = function (num){
            this.numBanderes=num;
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
            this.contenido=$("td")
            console.log(this.contenido.length);
            this.contador.activar();
            $("#cbanderas").html(this.contadorbanderas.sNumBanderes());
            if(this.flag==false){
                this.tablero.omplir();
                this.flag=true;
            }
            console.log("Creando el espia para ver donde haces click.");
            this.iniciado=true;
            console.log(this.tablero);
            $(botonIniciar).prop('disabled',true);
            $(botonReiniciar).prop('disabled', true);
            $(botonParar).prop('disabled',false);
            return this.espia;
        }
        pararJuego(){
            $(botonIniciar).html("Seguir");
            $(botonIniciar).prop('disabled',false);
            $(botonReiniciar).prop('disabled',false);
            $(botonParar).prop('disabled',true);
            this.contador.parar();
            this.iniciado=false;
        }
        reiniciarJuego(){
            $(botonIniciar).html("Iniciar");
            this.contador.reinicar();
            this.tablero.reset();
            this.flag=false; 
            this.contadorbanderas.cNumBanderes(10);
            location.reload();
        }
        espiaJuego(){
            this.espia=$("div");
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
                        this.tablero.dibujar()[i-10].contenido(1)
                    }
                    if( i < 90){
                        this.tablero.dibujar()[i+10].contenido(1)
                    }

                    if (i > 9 && (i+1)%10!=0){
                        if(this.tablero.dibujar()[i-9].descobrir()!=-1){
                            this.tablero.dibujar()[i-9].contenido(1)
                        }
                    }
                    if ((i+1)%10!=0){
                        if(this.tablero.dibujar()[i+1].descobrir()!=-1){
                            this.tablero.dibujar()[i+1].contenido(1)
                        }
                    }
                    if (i < 90 && (i+1)%10!=0){
                        if(this.tablero.dibujar()[i+11].descobrir()!=-1){
                            this.tablero.dibujar()[i+11].contenido(1)
                        }
                    }

                    if (i > 9 && i%10!=0){
                        if(this.tablero.dibujar()[i-11].descobrir()!=-1){
                            this.tablero.dibujar()[i-11].contenido(1)
                        }
                    }
                    if (i%10!=0){
                        if(this.tablero.dibujar()[i-1].descobrir()!=-1){
                            this.tablero.dibujar()[i-1].contenido(1)
                        }
                    }
                    if (i < 90 && i%10!=0){
                        if(this.tablero.dibujar()[i+9].descobrir()!=-1){
                            this.tablero.dibujar()[i+9].contenido(1)
                        }
                    } 
                }
            }
        }
    }

    partida = new Joc();
    document.onload=partida.tablero.crear()
    $(botonIniciar).click(function(){partida.iniciarJuego()
    console.log(partida.calcularNumeros())})
    $(botonParar).click(function(){partida.pararJuego()})
    $(botonReiniciar).click(function(){partida.reiniciarJuego();})
    espia=partida.espiaJuego()
    partida.empezadoJuego()
    for (i=0; i< espia.length; i++){
        $(espia[i]).click(function(event){
            if(partida.empezadoJuego()){
                console.log("estoy vigilando");
                if(Number.isInteger(parseInt(this.id,10))){
                    if(partida.tablero.dibujar()[this.id].descobrir() == -1){
                        console.log(espia[parseInt(this.id)+2].id)
                        console.log("BOMBA")
                        alert("Has perdido le has dado a la bomba")
                        console.log(partida.tablero.dibujar())
                        //espia[parseInt(event.currentTarget.id)+2].style.backgroundColor="transparent"
                        $(espia[parseInt(this.id)+2]).css("background","transparent");
                        //espia[parseInt(event.currentTarget.id)+2].style.backgroundImage="url('./mina.gif.')"
                        $(espia[parseInt(this.id)+2]).css("background-image","url(mina.gif)");
                        $(botonReiniciar).prop('disabled',false);
                    }else{
                        espia[parseInt(this.id)+2].style.backgroundColor="transparent"
                        console.log(espia[parseInt(this.id)+2].id)
                        console.log(partida.tablero.dibujar())
                        espia[parseInt(this.id)+2].innerHTML=partida.tablero.dibujar()[event.currentTarget.id].descobrir()
                        console.log("valor del contenido "+partida.tablero.dibujar()[event.currentTarget.id].descobrir())
                    }
                }
            }
        })
        $(espia[i]).contextmenu(function(event){
            event.preventDefault();
            if(partida.empezadoJuego()){
                console.log("estoy vigilando");
                if(partida.contadorbanderas.sNumBanderes()>=1){
                    partida.contadorbanderascc.decrementar();
                    $("#cbanderas").html(partida.contadorbanderas.sNumBanderes());
                    $(espia[parseInt(this.id)+2]).css("background","transparent");
                    $(espia[parseInt(this.id)+2]).css("background-image","url(flag.png)");
                }//Number.isInteger(parseInt(this.id,10)) && estaba en el if
            }
        })
    }//


});