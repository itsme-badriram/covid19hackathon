$(document).ready(function(){
    $(".today-list").click(function(){
        $(".status").html("Today's Appointments");
        $(".today-wrap").css("display","flex");
        $(".upcome-wrap").css("display","none");
    });
    $(".up-list").click(function(){
        $(".status").html("Upcoming Appointments");
        $(".today-wrap").css("display","none");
        $(".upcome-wrap").css("display","flex");
    });
});