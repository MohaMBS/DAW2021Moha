$( document ).ready(function() {
    celdas = $("th")
    $('#c1').click(function(){
        $(celdas[0]).toggle(1000);
    })

    $('#c2').click(function(){
        $(celdas[1]).fadeToggle(600);
    })

    $('#c3').click(function(){
        $(celdas[2]).slideToggle(350);
    })

    $('#c4').click(function(){
        $(celdas).toggle(5000)
    })
});