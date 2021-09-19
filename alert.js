/*
    How to use alert box:
    Call function alertBox with 3 parameters in it!
    1)main = The Main string you wish to display in the alert box
    2)sub  = The sub string which provides detailed info 
    3)mode = [0 - warning, 1 - error, 2 - success]
    4)link = The page-url where you want to redirect after clicking on Okay button

    Eg: alertBox("Alert!","This is an alert box",0); //Displays warning box

    ----------------------------------------------

    How to use confirm box:
    Call function confirmBox with 4 parameters in it!
    1)main          = The Main string you wish to display in the confirm box
    2)sub           = The sub string which provides detailed info
    3)trueCallback  = The action you want to take if user clicked Okay 
    4)falseCallback = The action you want to take if user clicked Cancel

    Eg: confirmBox("Are you sure?","This action cannot be redone!",
            function(){
                window.location.href = "userDashboard.html";
            },
            function(){
                window.location.href = "userStatus.html";
            }
        );
*/
$(document).ready(function(){
    $("body").prepend('<div class="alert-wrap"><div class="alert-box"><div class="wrap"><span class="icon-show alert"></span></div><p id="alert-msg"><b></b><span id="sub-msg"></span></p><div class="button-alert"><button id="alert-cancel">Cancel</button><button id="alert-ok">Okay</button></div></div></div>');
});
function addBlurEffect(){
    $("body").addClass("restrict");
    $("body").children().not(".alert-wrap").addClass("blur-background");
}
function removeBlurEffect(){
    $("body").removeClass("restrict");
    $("body").children().removeClass("blur-background");
}
function showAlert(main,sub,mode){
    $("#alert-msg b").html(main);
    $("#sub-msg").html(sub);
    
    if(mode == 0) $(".alert").css("backgroundImage","url('Images/warning.png')");
    else if(mode == 1) $(".alert").css("backgroundImage","url('Images/wrong.png')");
    else if(mode == 2) $(".alert").css("backgroundImage","url('Images/success.png')");
    else $(".alert").css("backgroundImage","url(Images/alert.png)");

    addBlurEffect();
    $(".alert-wrap").css("display","flex");
}
function hideAlert(){
    $(".alert-wrap").css("display","none");
    $("#alert-cancel").hide();
    removeBlurEffect();
    $("#alert-ok").unbind("click");
    $("#alert-cancel").unbind("click");
}
function alertBox(main,sub,mode,link=null){
    showAlert(main,sub,mode);
    $("#alert-ok").click(function(){
        hideAlert();
        if(link !== null)window.location.href = link;
    });
}
function confirmBox(main,sub,trueCallback,falseCallback){
    $("#alert-cancel").show();
    
    showAlert(main,sub,3);
    
    $("#alert-ok").click(function(){
        hideAlert();
        trueCallback();
    });

    $("#alert-cancel").click(function(){
        hideAlert();
        falseCallback();
    });
}