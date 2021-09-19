<?php
require_once('dbConnect.php');
require_once('functions.php');

if(checkLogin()){
    $homepage = $_SESSION['homepage'];
 
    header("Location: $homepage ");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login-New | Covid</title>
    <link rel="stylesheet" href="login.css">

    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="login.js"></script>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
         
   
</head>
<body>
    <div class="banner">
        <span class="logo"></span>
        <h1>Covid 19 Emergency Management</h1>
        <a href="signup"><button id="signup">Signup</button></a>
    </div>
    <h2 class="sub-heading">A step towards safety!</h2>
    <div class="main">
        <div class="box">
            <div class="slider">
                <span class="icon work"></span>
                <span class="icon vol"></span>
                <span class="icon user"></span>
                <span class="icon doc"></span>
                <span class="icon admin"></span>
            </div>
            <h3>Login</h3>
            <div class="form-wrap">
                <form method = "post" id="login-form" action="loginAction.php?login=true">
                    <select name="" id="login-select" title="Select type of user">
                        <option value="General User">General User</option>
                        <option value="Essential Worker">Essential worker</option>
                        <option value="Volunteer">Volunteer</option>
                        <option value="Doctor">Doctor</option>
                        <!--<option value="Admin">Admin</option> -->
                    </select>
                    <input type="text" name="uname" id="uname"  value='Press Login Directly' placeholder="User Name"><br>
                    <input type="password" name="pass" id="pass" value='Press Login Directly' placeholder="Password"><br>
                    <input type="submit" value="Login">
                    <a href="forgotpassword?getEmail=true" style="cursor: pointer;">Forgot Password</a>
                </form>
            </div>
        </div>
        <script>
        function onForgotPassword(){
            
            alertBox('Forgot Password?','',5);
        }
        </script>
        <div class="quick-bar">
                <div class="qbox geo">
                    <a href="geofencing">
                        <span class="img"></span>
                        <h3>View Geo Fences</h3>
                        <h5>Be aware of red zones!!</h5>
                    </a>
                </div>
            <div class="qbox near">
                <a href="nearest">
                    <span class="img health"></span>
                    <h3>View Nearby Health Centres</h3>
                    <h5>Know about your neighbourhood!</h5>
                </a>
            </div>
            <div class="qbox online">
                <a href="trainingvideo">
                    <span class="img video"></span>
                    <h3>Online Video Courses</h3>
                    <h5>Continue watching..!</h5>
                </a>
            </div>
            <div class="qbox helpline">
                <a href="helpline">
                    <span class="img help"></span>
                    <h3>Helpline Numbers</h3>
                    <h5>We care for your safety :)</h5>
                </a>
            </div>
            <div class="qbox don">
                <a href="donate">
                    <span class="img donate"></span>
                    <h3>Donate</h3>
                    <h5>People live when people give!</h5>
                </a>
            </div>
            <div class="qbox gov">
                <a href="govt">
                    <span class="img info"></span>
                    <h3>Government Services Linkage</h3>
                    <h5>Services at your doorstep.. :)</h5>
                </a>
            </div>
            
        </div>
    </div><br><br>
    <script>
        $(document).ready(function(e){
        var form = $('#login-form');
       
        $('#login-form').on('submit',function(e){

            var id=$('#login-select').find(":selected").text();
        var table_name;
            e.preventDefault();
            var formData = new FormData(this);
            var uname = document.getElementById('uname').value;
           // var uname = '9940056967';
            if(id == "General User")
                {table_name = "generaluser";
                    formData.append('uname','itsme.badriram@gmail.com');
                    formData.append('pass','12345');

                }
                else if(id == "Essential worker")
                {table_name = "essentialworker";
                    formData.append('uname','batman@gmail.com');
                    formData.append('pass','123');

                }
                else if(id == "Volunteer")
                {table_name = "volunteer";
                   formData.append('uname','loki@gmail.com');
                    formData.append('pass','1234');
                }
                else if(id=="Doctor"){
                   
                    table_name = "doctor";
                   formData.append('uname','badrirama@gmail.com');
                    formData.append('pass','123');
                }
                console.log(uname);
               //var username =  myFunction(uname);
               //console.log(username);
               var username='email';
            formData.append('username',username);   
            formData.append('table_name',table_name);
           
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                beforeSend : function(){
                    $(document).ajaxStart(function(){
                        $("#loader").fadeIn("fast");
                    });

                },
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    if(!data){
                        
                        alertBox("Incorrect Information",'Please Check Your Email/Contact And Password',1);
                    }
                    else
                    {   console.log(data);
                        alertBox("Login Successful",'',2,data);
                     }
                }, 
                complete: function(){
                $(document).ajaxComplete(function(){
                    $("#loader").fadeOut("slow");
                });
                },
                error: function (data) {
                    
                
                },
            });
            
    $("#login-form").trigger("reset");
            });
           
        }); 

        </script>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>