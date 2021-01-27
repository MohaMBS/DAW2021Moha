$(document).ready(function(){
    celdas=$("td")
    $("td:eq("+Math.floor(Math.random() * 7)+")").css("background-color","red")
    $("td:eq("+Math.floor(Math.random() * 7)+")").css("background-color","green")

})