function slideUpAll(){
    $(".text").each(function(i){
        $(this).slideUp();
    });
}
var food = {
    rice : 0,
    wheat :0,
    vegetables: 0,
    water :0,
    snacks:0,
    otherfoods: 0,
    biscuits: 0
};
var clothing = {
    male: 0,
    female :0,
    children :0,
    infant :0
};
var hygiene = {
    facemask : 0,
    sanitizer : 0,
    sanitarypads :0
};
$(document).ready(function(){
   
    $("input[type=checkbox]").change(function(){
        slideUpAll();
        if($(this).prop("checked")){
            
            if(food[$(this).val()] == 0)
            {food[$(this).val()] = 1;

                
            }
            if(clothing[$(this).val()] ==0)
            {clothing[$(this).val()] = 1; }
            
                if(hygiene[$(this).val()] ==0)
                {hygiene[$(this).val()] = 1; }
              
            $(this).siblings(".expand").slideDown();
        }
        else {
            $(this).siblings(".expand").slideUp();
            if(food[$(this).val()])
            food[$(this).val()] = 0;
            if(clothing[$(this).val()])
            clothing[$(this).val()] = 0;
            if(hygiene[$(this).val()])
            hygiene[$(this).val()] = 0;
   
            }
    });
});

function onDonationItemsSubmit(){
    var food_str="",clothing_str="",hygiene_str="";
    for(var key in food){
       if(food[key]){
           food_str+=key+"="+document.getElementById(key+'value').value+";";

       }

   }
   for(var key in clothing){
    if(clothing[key]){
        clothing_str+=key+"="+document.getElementById(key+'value').value+";";

    }
}
for(var key in hygiene){
    if(hygiene[key]){
        hygiene_str+=key+"="+document.getElementById(key+'value').value+";";

    }
}

$.post("reportAction.php?donateItems=true",{
    food : food_str,
    cloth : clothing_str,
    hygiene : hygiene_str,
    name : document.getElementById('name').value,
    address : document.getElementById('address').value,
    contact : document.getElementById('name').value

},function(response){
    alertBox(response,'',2);
    $("#donationform").trigger("reset");
});

}
function onRequestItemsSubmit(){

   var food_str="",clothing_str="";
    for(var key in food){
       if(food[key]){
           food_str+=key+"="+document.getElementById(key+'value').value+";";

       }

   }
   for(var key in clothing){
    if(clothing[key]){
        clothing_str+=key+"="+document.getElementById(key+'value').value+";";

    }
}

    var org_type = $("#typeoforg").find(":selected").text();
    food_str=food_str.substring(0,food_str.length-1);
    clothing_str=clothing_str.substring(0,clothing_str.length-1);
    console.log(transportation);
    $.post("reportAction.php?requestItems=true",{
        food : food_str,
        cloth : clothing_str,
        org_type : org_type,
        transportation : transportation,
        num : document.getElementById("num").value,
        name : document.getElementById("name").value,
        org_name : document.getElementById("orgname").value,
        contact : document.getElementById("contact").value,
        address : document.getElementById("address").value
    },function(data){
        alertBox(data,'',2);
        $("#requestform").trigger("reset");
    });
    
}
var x=2;
function appendRow(){
    var d = document.getElementById('otherfoodinputs');
    d.innerHTML += "<input type='text' placeholder='Enter type of food and quantity' id='otherfoods"+ x++ +"'><br >";
}