$( document ).ready(function() {
    //jQuery.fx.speeds.fast = 1000;
    //jQuery.fx.speeds.blazing = 100;
    //jQuery.fx.speeds.excruciating = 60000;
    // NOTA: No tiene sentido hacerlo con fx speed si se puede hacer poniendo 200
    $("li").click(function(){
        $(this).hide(600);
    })
    $("#aparece").click(function(){
        $("li").show(200);
    })
    $("#desaparece").click(function(){
        $("li").hide(600);
    })
})