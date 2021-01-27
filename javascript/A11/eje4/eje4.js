$(document).ready(function(){
    $("button").click(function(){
        $("p").animate({
            right: '250px',
            opacity: '0.2',
            width: '50%'
        });
        $("div").animate({
            borderWidth: "5px"
        })
    })
})
