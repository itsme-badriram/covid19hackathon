$(window).on('load',function(){
    $("#loader").fadeOut("slow");
});
$(document).ready(function(){
    $("body").prepend('<div id="loader"><span></span></div>');
    $("#loader").css("display","flex");
    if(document.readyState === "complete"){
        $("#loader").hide();
    }
});