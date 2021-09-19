$(document).ready(function(){
    $(".time-box").click(function(){
         time = $(this).html();
        $(".time-slot").html(time);

    });
});

function getTime(){
    return time;
}