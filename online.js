var sCount = 0, cCount = 0, nCount = 0;
$(document).ready(function(){
    $("#other-amt").click(function(){
        if(sCount %2 == 0){
            $("#otherA").slideDown();
        }
        else{
            $("#otherA").slideUp();
        }
        sCount += 1;
    });
    $(".amt-val").click(function(){
        $("#amt").val("Amount : " + $(this).html());
    });
    $(".other").keyup(function(){
        $("#amt").val("Amount : " + $(this).val());
    });
    $(".one").click(function(){
        if(cCount %2 == 0){
            $(".credit-show").slideDown();
        }
        else{
            $(".credit-show").slideUp();
        }
        cCount += 1;
    });
    $(".two").click(function(){
        if(nCount %2 == 0){
            $(".net-show").slideDown();
        }
        else{
            $(".net-show").slideUp();
        }
        nCount += 1;
    });
});
function optionAdd(){
    for(var i = 2018; i <= 2030; i++){
        $("#year").append(new Option(i,i));
    }
    for(var i = 1; i <= 12; i++){
        $("#month").append(new Option(i,i));
    }
}
var banks = ['ALLAHABAD BANK','ANDHRA BANK','AXIS BANK','BANDHAN BANK LIMITED','BANK OF BARODA','BANK OF INDIA','BANK OF MAHARASHTRA','BHARATIYA MAHILA BANK LIMITED','CANARA BANK','CENTRAL BANK OF INDIA','CORPORATION BANK','DENA BANK','HDFC BANK','ICICI BANK LIMITED','IDBI BANK','INDIAN BANK'
,'INDIAN OVERSEAS BANK','INDUSIND BANK','KOTAK MAHINDRA BANK LIMITED','ORIENTAL BANK OF COMMERCE','PUNJAB AND SIND BANK','PUNJAB NATIONAL BANK','SOUTH INDIAN BANK','STATE BANK OF INDIA','SYNDICATE BANK','UCO BANK','UNION BANK OF INDIA','UNITED BANK OF INDIA','VIJAYA BANK','YES BANK'];
function addBanks(){
    for(var i = 0; i < banks.length; i++){
        $("#bank-opt").append(new Option(banks[i],banks[i]));
    }
}