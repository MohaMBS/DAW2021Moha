$(document).ready(function(){
    $("#pa").click(function(){
        $("tr:even").css("background-color", "green")
    })
    $("#impa").click(function(){
        $("tr:odd").css("background-color", "red")
    })
})