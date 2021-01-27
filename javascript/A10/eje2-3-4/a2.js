$(document).ready(function(){
  ref="table#ntable"
  if(localStorage.getItem("agenda")){
    agenda=JSON.parse(localStorage.getItem("agenda"))
    $(agenda).appendTo($(ref))
  }
  $(".anadir").click(function(){
      let contenido = "<tr class=\"nueva\"><td ><text>"+$(".fecha").val()+"</text></td><td colspan=\"3\"><text>"+$(".queHacer").val()+"</text></td><td class='X'>X</td></tr></table>";
      $(contenido).appendTo($(ref));
      $(".fecha").val("");
      $(".queHacer").val("");
  });

  $(ref).on("click",'.X' ,function() {
    $(this).parent().remove();
  });
  $("#botonBuscar").click(function(){
    $("tr.nueva").children().css("background-color","lightgrey")
    if ($("#infobuscar").val()==""){
      alert("Debes de escribir lo que quieres buscar.")
    }else{
      $("td:contains("+$("#infobuscar").val()+")").css("background-color","yellow")
      $("#infobuscar").val("");
    }
  });
})
window.onbeforeunload = function () {
  $agenda=$(ref)
  if ($agenda.length){
    localStorage.setItem("agenda", JSON.stringify($agenda.html())); 
  }
  
};