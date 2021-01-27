$(document).ready(function(){
    text=""
    $("img[alt]").each(function(x){
        text+=$(this).attr("alt")+" ";
    })
    alert("Hi ha un total de "+$("img[alt]").length+" en el contenido de sus alts es lo siguieten "+text);
    $('img').css({'width' : '200%' , 'height' : '200%'});
    $("img[alt]").each(function(x){
        if($(this).has("[alt]")){
            console.log($(this).attr("alt"))
        }
    })
})