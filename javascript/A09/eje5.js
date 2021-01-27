$(document).ready(function(){
    //A
    $("div.module").css({"font-size":"40px","text-align":"center"})
    //B C i D
    $("a:odd").attr("href", "informatica.iesjoaquimmir.cat")
    $("a:last").text("Ha cambiado");
    $("a:last").text("Ha cambiado");
    $("a:first").css("color","red"); 
    //E
    $('ul li').filter('.current').css('color','yellow');
    //F
    $("div.f > div").addClass("complet").css({"background-color":"gray","font-size":"30px"})
    //G
    $("div > div:not('[class]')").css({"font-size":"10","color":"blue","background-color":"yellow"})
})