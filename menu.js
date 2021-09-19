var mCount = 0;
$(document).on('click','#mImg',function(){
    if(mCount %2 == 0) {
        if(window.matchMedia("(max-width: 900px)").matches){
            $("#menu-bar").css("width","80%");    
        }
        else {
            $("#menu-bar").css("width","35%");
        }
        $("#mImg").css("filter","none");
        $("#menu-bar").css("box-shadow","0px 0px 2px 1px gray");
    }
    mCount += 1; 
});    
function hideMenu(){
    $("#menu-bar").css("width","0%");
    $("#mImg").css("filter","invert(1)");
    $("#menu-bar").css("box-shadow","none");
    $(".sub-menu").slideUp();
    mCount = 0;
}
$(document).ready(function(){
    $("body,.mBack").click(function(event){
        if(!$(event.target).closest('#menu-bar').length) hideMenu();
        else if($(event.target).closest(".mBack").length) hideMenu();
    });
    $(".menu-drop").click(function(){
        var mParent = $(this).siblings(".sub-menu");
        mParent.slideToggle();
        $(this).children(".mDown").toggleClass("rotateDrop");
    }); 
});