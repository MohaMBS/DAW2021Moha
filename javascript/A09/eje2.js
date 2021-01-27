$(document).ready(function(){
    $("a").hover(function(){
        $(this).css({"background-color":"green"})
    },function(){
        $(this).css({"background-color":"white"})
    })
})