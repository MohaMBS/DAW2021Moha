$(document).ready(function(){
    var estado = true;
    $("button").click(function(){
        if ( estado ) {
            $( "div" ).animate({
                backgroundColor: "#aa0000",
                color: "#F7E43A",
                width: "50%"
            },1000,function() {
                $( "div" ).animate({
                    backgroundColor: "#C7C7C7",
                    color: "#000000",
                    width: "100%"
                  
                },1000)
            });
          } else {
            $( "div" ).animate({
                
              backgroundColor: "#aa0000",
                    color: "#F7E43A",
                    width: "50%"
            },1000, function() {
                $( "div" ).animate({
                backgroundColor: "#C7C7C7",
                color: "#000000",
                width: "100%"
                },1000)
            });
          }
          estado = !estado;
    })
})