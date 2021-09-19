var radVal = "";
function disableAll(){
    $("[id^= 'rad']").children(".rad-button").css("border","1px solid grey");
    $("[id^= 'rad']").children(".rad-button").css("backgroundColor","rgba(0,0,0,0.2)");
}
$(document).ready(function(){
    $(document).on('click','#rad1, #rad2, #rad3, #rad4',function(){
        var id = $(this).attr("id");
       
        disableAll();
        radVal = $(this).children(".rad-text").html();
        console.log(radVal);
        $(this).children(".rad-button").css("border","5px solid rgb(49,110,164)");
        $(this).children(".rad-button").css("backgroundColor","white");
    });
});
/*
    function findValue usage---
    -> It returns the currently selected value in the radio box
    -> It actually returns the innerHTML of the selected box(ie. rad-text)
    -> Check if it doesn't return null!!
*/
function findValue(){
if(radVal != ""){
    return radVal;
}
else return "undefined";
}
$(document).on('click','#work',function(){
    $(".cont-form").hide();
    $(".workAvail").css("display","block");
    $("#workHead").show();
});
$(document).on('click','#goBack',function(){
    location.reload();
    $(".cont-form").show();
    $(".workAvail").css("display","none");
    $("#workHead").hide();
});