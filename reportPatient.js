var gender = "";
function disableAll(){
    $(".gender").each(function(i){
        $(this).css("backgroundColor","white");
    });
    gender = "";
}
function slideUpAll(){
    $(".severe").each(function(i){
        $(this).slideUp();
    });
}
function getCheckBoxValue(){
    var valHolder = [];
    $(".severeVal").each(function(i){
        valHolder.push($(this).html());
    });
    return valHolder; 
}
function getGender(){
    return gender;
}
$(document).ready(function(){
    
    $(".gender").click(function(){
        disableAll();
        $(this).css("backgroundColor","rgba(49,110,164,0.25)");
        gender = $(this).children().attr('class');
    });
    $("input[type=checkbox]").click(function(){
        if(!$(this).prop("checked")){
            $(this).parents("div").children(".severe").slideUp();
            $(this).parents("div").children(".severeVal").html("");
            $(this).parents("div").children(".severeVal").css("display","none");
        }
        else {
            slideUpAll();
            $(this).parents("div").children(".severe").slideDown();
        }
    });
    $(".level").click(function(){
        var sev = $(this).parents("div").children(".severeVal");
        sev.html($(this).html());
        sev.css("display","inline-flex");
       
    });
    $(".backicon").click(function(){
        $(this).parents(".severe").slideUp();
    });
    $(".baricon").click(function(){
        $(".symtable").slideDown();
    });
    $("#symback").click(function(){
        $(".symtable").slideUp();
        
    });
    $("#reportSub").click(function(){
        
        var severity = getCheckBoxValue();
        var gender = getGender();
        var name = document.getElementById('name').value;
        var age = document.getElementById('age').value;
        var k =0;
        var query = {
            fever : "None",
            tiredness : "None", 
            drycough : "None",
            aches_and_pains : "None",
            nasal_congestion : "None" ,
            running_nose : "None",
            sore_throat : "None",
            diarrhoea : "None"
        };
        for(var key in query) {
            if(severity[k])
            query[key] = severity[k];
            k=k+1;
        }
        var marker = returnMarker();
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();
        query['gender'] = gender;
        query['period'] = displayRadioValue();
        query['age'] = age;
        query['name'] = name;
        var medication = "None";
        if($("#medication").val())
        medication = $("#medication").val();
        var condition = "None";
        if($("#condition").val())
        condition = $("#condition").val();
        query['medication']= medication;
        query['condition']= condition;
        query['location'] = document.getElementById('job_location').value;
        query['lat'] = lat;
        query['lng'] = lng;
        console.log(query);
        console.log(JSON.stringify(query));
        $.ajax({
            url: 'reportAction.php?patient=true',
            type: 'post',
            data : JSON.stringify(query),
            dataType: 'json',
            success: function (data) {
                $.ajax({
                    url: 'pdf.php',
                    type: "post",
                    data: {
                        id: data[0],
                        username: data[1]
                    },
                    success: function(data){
                        alertBox("Reported Successfully",'',2);
                        
                    },
                    error: function(data){
                        alert("Failed Try Again");
                    }
                });
                
              }
              
        });
        $("#myform").trigger('reset');
        
    });
});
  