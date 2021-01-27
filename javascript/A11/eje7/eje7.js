$(document).ready(function(){
   $("button").click(function(){
       event.preventDefault();
       console.log($(this).parent().children().children(1).first().val())
       if($(this).parent().children().children(1).first().val().length == 0){
        x=Math.floor(Math.random() * 3);
        if(x==0){
            $(this).parent().children().children(1).first().effect( "bounce", "slow" );
        }
        if(x==1){
            $(this).parent().children().children(1).first().effect( "clip", "slow" );
        }
        if(x==2){
            $(this).parent().children().children(1).first().effect( "drop", "slow" );
        }
       }
       //console.log($(this).parent().children().first().html());
   })
})