$(document).ready(function(){
    $("ul:first li").each(function(x){
        $(this).text(+" "+x);
    });
    $("ul:last li").each(function(x){
        $(this).text(+" "+Math.floor(Math.random() * 20));
    });
    $("button").click(function(){
        alert("Hay un total de "+$("li").length)
    })
})