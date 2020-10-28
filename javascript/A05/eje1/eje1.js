var cookie= getCookie("eje1cookie");
if (cookie == ""){
    setCookie("eje1cookie",0,30);
}else{
    let contador=parseInt(cookie);
    contador+=1;
    setCookie("eje1cookie",contador,30)
}

cookie= getCookie("eje1cookie");
document.querySelector("#contador").innerHTML=cookie;


function setCookie(camp, valor, dies) {
    var d = new Date();
    d.setTime(d.getTime() + (dies*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = camp + "=" + valor + ";" + expires; } 


function getCookie(nom) {
    var name = nom + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }           return "";       }
