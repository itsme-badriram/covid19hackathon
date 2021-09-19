function disableChecked(){
    $(".check").each(function(i){
        $(this).removeClass("checked");
    });
}
var field;
$(document).ready(function(){
     field='Health';
    $(".checkbox").click(function(){
        disableChecked();
        $(this).children(".check").addClass("checked");
        field=$(this).children('.check-title').text();
    });
   
});
$(document).on('click',".button:not('#request_service_click')",(function(){
    window.location.href = $(this).children("a").attr('href');
}));