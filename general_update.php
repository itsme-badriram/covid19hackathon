<?php require_once 'dbConnect.php';
require_once 'functions.php';
if(!checkLogin()){
  header("Location: login"); 
}
$table_name = $_SESSION['table_name'];
$email = $_SESSION['uname'];
$sql = "SELECT * FROM $table_name WHERE email ='".$email."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="general_update.css">
    <script src="jquery.js"></script>
    <script src="osFinder.js"></script>
    <script src="menu.js"></script>
    <script src="request_service.js"></script>
    <script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <title>Update User Profile</title>
</head>
<body>
    
    <?php require_once('menubar.php'); ?>
    <div class="form-wrap" id="main-box" spellcheck="false">
        <h2 class="head">
        <?php if($table_name == 'doctor') $user = 'Doctor'; else if($table_name == 'essentialworker') $user = 'Essential Worker'; else if($table_name == 'volunteer') $user = 'Volunteer'; else $user = 'General User' ?>
            <span>Profile</span>
            <span class="user-type"><?php echo $user ?></span>
        </h2><hr>
        <div class="box">
            <h3 class="heading">
                <span>Personal Info</span>
            </h3>
            <div class="input-box">
                <label for="name">
                    <div>
                        <b>NAME</b>
                        <input type="text" id="name" class="input-details" value="<?php  echo $row['name'] ?> " disabled>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                <label for="email">
                    <div>
                        <b>EMAIL ADDRESS</b>
                        <input type="text" id="email" class="input-details" value="<?php  echo $row['email'] ?>" disabled>
                        <h5>The email-address cannot be changed!</h5>
                    </div>
                </label><hr>
                <label for="contact">
                    <div>
                        <b>CONTACT NUMBER</b>
                        <input type="number" id="contact" class="input-details" value="<?php  echo $row['contact'] ?>" disabled>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                <?php  

                if($table_name != 'generaluser'){
                    $temp = $row['aadhar_no'];
                   

                    echo '
                    
                    <label for="aadhar_no">
                    <div>
                        <b>AADHAR CARD NUMBER</b>
                        <input type="number" id="aadhar_no" class="input-details" value="'. $temp .'" disabled>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                    
                    
                    ';
                }


                if($table_name == 'doctor'){
                    $temp = $row['qualification'];
                    $temp1 = $row['specialization'];
                    echo '
                    <label for="qualification">
                    <div>
                        <b>COMPLETED DEGREES</b>
                        <input type="text" id="qualification" class="input-details" value="'.$temp.'" disabled>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                <label for="specialization">
                    <div>
                        <b>SPECIALIST</b>
                        <input type="text" id="specialization" class="input-details" value="'.$temp1.'" disabled>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                <label class="consult">
                    <div>
                        <b>CONSULTING HOURS</b>
                        ';
                        $workinghours = $row['working_hours'];
                        $hours = explode(';',$workinghours); 

                        foreach($hours as $hour)
                        {$time = explode('-',$hour);

                            echo'
                            <span class="time-slot">
                            <input type="text" name="" class="input-details start-time" value="'.$time[0].'" disabled>
                            <input type="text" name="" class="input-details end-time" value="'.$time[1].'" disabled>
                            <span class="removeSlot"></span>
                        </span>


                            ';
                        



                        }

                        echo'
                       
                        <span class="button-wrap consult-button">
                            <span class="addSlot">Add Slot</span>
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                    
                    ';


                }

                if($table_name == 'volunteer'){
                    $field = $row['field'];
                    echo '
                    <label for="field">
                    <div>
                        <b>FIELD OF VOLUNTEERING</b>
                        <select id="field" class="input-details" disabled>
                            <option value="Health"';if($field == "Health") echo 'selected';echo'>Health</option>
                    <option value="Communication" ';if($field == "Communication") echo 'selected';echo'>Communication</option>
                    <option value="Entrepreneurial" ';if($field == "Entrepreneurial") echo 'selected';echo'>Entrepreneurial</option>
                        </select>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                    ';
                }


            ?>
               
               
                
              <!--  <label for="type">
                    <div>
                        <b>TYPE OF WORK</b>
                        <select id="type" class="input-details" disabled>
                            <option value="Assisting District administration">Assisting District administration</option>
                            <option value="Disinfection and cleaning services">Disinfection and cleaning services</option>
                            <option value="Door to door Info and Service Mgmt.">Door to door Info and Service Mgmt.</option>
                            <option value="Food and Grocery Services">Food and Grocery Services</option>
                        </select>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr> -->
                
                <label for="pass">
                    <div>
                        <b>PASSWORD</b>
                        <input type="password" id="pass" class="input-details" value="something" placeholder="Password" disabled>
                        <input type="password" id="re-pass" class="input-details password" placeholder="Retype Password" disabled>
                        <span class="button-wrap pass-check">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label>
            </div>
        </div>
        <div class="box">
            <h3 class="heading">
                <span>Location Details</span>
            </h3>
            <?php if($table_name == 'doctor') $flat = 'hospital_name'; else if($table_name == 'essentialworker') $flat = 'shop_name'; else $flat = 'apartment';  ?>
            <div class="input-box">
                <label for="<?php  echo $flat;  ?>">
                    <div>
                      <?php  if($table_name == 'doctor') echo '<b>PLACE OF WORK NAME</b>'; else echo '<b>FLAT NO/APT NAME</b>'; ?>
                        <input type="text" id="<?php  echo $flat;  ?>" class="input-details" value="<?php  echo $row[$flat]; ?>" disabled>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                <label for="street">
                    <div>
                        <b>STREET NAME</b>
                        <input type="text" id="street" class="input-details" value="<?php  echo $row['street']; ?>" disabled>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                <label for="area">
                    <div>
                        <b>TOWN/AREA</b>
                        <input type="text" id="area" class="input-details" value="<?php  echo $row['area']; ?>" disabled>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                <label for="city">
                    <div>
                        <b>CITY</b>
                        <input type="text" id="city" class="input-details" value="<?php  echo $row['city']; ?>" disabled>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                <label for="state">
                    <div>
                        <b>STATE</b>
                        <input type="text" id="state" class="input-details" value="<?php  echo $row['state']; ?>" disabled>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label><hr>
                <label for="pincode">
                    <div>
                        <b>PIN CODE</b>
                        <input type="text" id="pincode" class="input-details" value="<?php  echo $row['pincode']; ?>" disabled>
                        <span class="button-wrap">
                            <span class="save-button">Update</span>
                            <span class="cancel-button">Cancel</span>
                        </span>
                    </div>
                    <span class="edit"></span>
                </label>
            </div><br>
            <div id="map-all">
                <span id="mapShow" name="get_loc" onclick="ongetLocation()"></span>
                <div id="googleMap">
                </div>
            </div><br>
            <span><b>Note: </b>Click on the map icon and drop the marker in your location.</span>
        </div>    
    </div>
    <script>
        var slot_count = 2; //Give the original time-slots count of the doctor 
        function closeInput(){
            $("label").each(function(i){
                $(".password").hide();
                $("#pass").val("newpassword");
                $(this).children("div").children(".input-details").prop("disabled",true);
                $(this).children("div").children(".input-details").removeClass("editing");
                $(this).children("div").children(".button-wrap").hide();
            });
        }
        function closeConsult(){
            $(".start-time, .end-time").removeClass("editing");
            $(".start-time, .end-time").removeClass("time-edit");
            $(".start-time, .end-time").prop("disabled",true);
            $(".consult-button").hide();
            $(".removeSlot").hide();
        }
        $("label:not('.consult')").click(function(event){
            if(!$(event.target).closest(".button-wrap, #pass, #re-pass").length){
                if($(this).children("div").children(".button-wrap").css("display") === "none"){
                    closeConsult();
                    closeInput();
                }
                $(this).children("div").children(".button-wrap").css("display","flex");
                var edit_input = $(this).children("div").children(".input-details");
                edit_input.not("#email").addClass("editing");
                edit_input.not("#email").prop("disabled",false);
                if(edit_input.attr('id') === "pass"){ 
                    edit_input.val("");
                    $(".password").show();
                }
            }
        });
        $(".consult").click(function(){
            if(!$(event.target).closest(".button-wrap").length){
                closeInput();
                $(".start-time, .end-time").addClass("editing");
                $(".start-time, .end-time").addClass("time-edit");
                $(".start-time, .end-time").prop("disabled",false);
                $(".consult-button").css("display","flex");
                $(".removeSlot").css("display","flex");
            }
        });
        $(".addSlot").click(function(){
            if(slot_count >= 3){
                alertBox("Maximum TimeSlots Reached!","You cannot add more then three time slots",0,null);
            }
            else{
                $(".time-slot:last").after('<span class="time-slot"><input type="text" name="" class="input-details start-time" placeholder="-- : --" disabled><input type="text" name="" class="input-details end-time" placeholder="-- : --" disabled><span class="removeSlot"></span></span>');
                slot_count++;
            }
        });
        $(document).on('click',".removeSlot", function(){
            if(slot_count == 1){
                alertBox("Cannot remove time slot!","You must have atleast one consulting time slot!",1,null);
            }
            else{
                $(this).parent().remove();
                slot_count--;
            }
        });
        $(".cancel-button").click(function(){
            closeInput();
            closeConsult();
            $(this).parent(".button-wrap").siblings(".input-details").prop("disabled",true);
        });
        $(".save-button").click(function(){
            if($(this).parent().hasClass("consult-button")){
                var start_end = "";
                var slot_times = $(this).parent().siblings(".time-slot");
                slot_times.each(function(i){
                    var start = $(this).children(".start-time").val();
                    var end = $(this).children(".end-time").val();
                    if(start !== "" && end != ""){
                        start_end += start + "-" +end + ";";
                        
                    }
                    else{
                        alertBox("Please fill in all the fields!","Provide both start and end times!",1,null);
                        start_end = "";
                    }
                });
                if(start_end !== ""){
                    start_end = start_end.substring(0,start_end.length -1);
                    console.log(start_end); 
                    //Perform Ajax Call for updation
                    $.ajax({
                        type: 'post',
                        url: "accountUpdateAction.php?changeValue=true",
                        dataType: 'html',
                        data: {
                        key : 'working_hours',
                        value : start_end
                        },
                        beforeSend: function(){
                            $(document).ajaxStart(function(){
                                $("#loader").fadeIn("fast");
                            });
                        },
                        success: function(response){
                            alertBox(response,'Changes Updated',2,'general_update');
                        },
                        error: function(response){

                        },
                        complete: function(){
                            $(document).ajaxComplete(function(){
                            $("#loader").fadeOut("slow");
                            });

                        },});
                }
            }
            else if($(this).parent().hasClass("pass-check")){
                if($("#pass").val() !== "" && $("#re-pass").val() !== ""){
                    if($("#pass").val() === $("#re-pass").val()){
                        //Perform Ajax Call for updation
                        $.ajax({
                        type: 'post',
                        url: "accountUpdateAction.php?changeValue=true",
                        dataType: 'html',
                        data: {
                        key : 'password',
                        value : $("#pass").val()
                        },
                        beforeSend: function(){
                            $(document).ajaxStart(function(){
                                $("#loader").fadeIn("fast");
                            });
                        },
                        success: function(response){
                            alertBox(response,'Changes Updated',2,'general_update');
                        },
                        error: function(response){

                        },
                        complete: function(){
                            $(document).ajaxComplete(function(){
                            $("#loader").fadeOut("slow");
                            });

                        },});
                        console.log($("#pass").val());
                    }
                    else{
                        alertBox("Retype password mismatch!","Type the password correctly!",1,null);
                    }
                }
                else{
                    alertBox("Please fill in all the fields","Enter password and re-type password too!",1,null);
                }
            }
            else {
                var key = $(this).parent().siblings(".input-details").attr('id');
                var update_val = $(this).parent().siblings(".input-details").val();
                console.log(key,update_val);
                if(update_val === ""){
                    alertBox("Please fill in all the fields","Empty Values are not allowed!",1,null);
                }
                else {

                                
                    $.ajax({
                        type: 'post',
                        url: "accountUpdateAction.php?changeValue=true",
                        dataType: 'html',
                        data: {
                        key : key,
                        value : update_val
                        },
                        beforeSend: function(){
                            $(document).ajaxStart(function(){
                                $("#loader").fadeIn("fast");
                            });
                        },
                        success: function(response){
                            alertBox(response,'Changes Updated',2,'general_update');
                        },
                        error: function(response){

                        },
                        complete: function(){
                            $(document).ajaxComplete(function(){
                            $("#loader").fadeOut("slow");
                            });

                        },});
                    //Perform Ajax Call for updation
                } 
            }
        });
        $("html").click(function(event){
            if(!$(event.target).closest(".box").length){
                closeInput();
                closeConsult();
            }
        });
        function ongetLocation(){
            var location = document.getElementById("street").value+" "+document.getElementById("area").value+" "+document.getElementById("city").value;
            getLocation(location);
        }
    </script>
    <br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=geometry,places"
    async defer></script>
</body>
</html>