var sel = "";
var icons = [".user",".doc",".admin",".vol",".work"];
function popup(cName){
    cName = "."+cName;
    $(cName).css("width","5em");
    $(cName).css("height","5em");
    $(cName).css("backgroundSize","4em");
    $(cName).css("backgroundColor","rgba(49,110,164,0.5)");
    $(cName).css("opacity","1");
}
function popDown(){
    for(var i = 0; i < icons.length; i++){
        $(icons[i]).css("width","3em");
        $(icons[i]).css("height","3em");
        $(icons[i]).css("backgroundSize","2em");
        $(icons[i]).css("backgroundColor","white");
        $(icons[i]).css("opacity","0.25");
    }
}
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
function myFunction(x) {
    var text;
    
    if(validateEmail(x))
    {
        return 'email';
    }
    else{
        if(isNaN(x))
        {
            return 'error';
        }
        else{
            return 'contact';
        }
    }
  }
$(document).ready(function(){
    popup("user");
    $("#login-select").on("change",function(){
        sel = this.value;
        popDown();
        if(sel === "Doctor")popup("doc");
        else if(sel === "General User")popup("user");
        else if(sel === "Volunteer")popup("vol");
        else if(sel === "Admin")popup("admin");
        else popup("work");
    });
});