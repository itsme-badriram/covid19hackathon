<div class="banner">
        <span class="logo"></span>
        <h1>Covid 19 Emergency Management</h1>
        <span id="mImg" class="menu-img"></span>
    </div>
<div id="menu-bar" class="menu">
        <h2>Menu</h2>
        <ul>
            
            
            <?php
            if(isset($_SESSION['homepage'])){
                $homepage = $_SESSION['homepage'];
                echo '<a href="'.$homepage.'"><li>Home</li></a>';

            }
            else 
            echo '<a href="login"><li>Home</li></a>';

            if(isset($_SESSION['homepage']) && $_SESSION['homepage'] == 'doctor')
            {
                echo'
                <div class="sub-menu-wrap">
                    <li class="menu-drop">
                        <span>Main Services</span>
                        <span class="mDown"></span>
                    </li>
                    <div class="sub-menu">
                    <a href="docSuspect"><li>View Covid-19 Patient Reports</li></a>
                    <a href="patient_records"><li>View Patient Records</li></a>
                    <a href="docLab"><li>Lab Results</li></a>
                    
                       
                    </div>
                </div>
               ';
            
            
            }
            if(isset($_SESSION['homepage']) && $_SESSION['homepage'] == 'essentialWorkerPage')
            {

                echo '<a href="essPass"><li>Essential Service Transport Pass</li></a>';


            }
            if(isset($_SESSION['homepage']) && $_SESSION['homepage'] == 'volunteerPage')
            {
            echo'
            <div class="sub-menu-wrap">
                <li class="menu-drop">
                    <span>Main Services</span>
                    <span class="mDown"></span>
                </li>
                <div class="sub-menu">
                <a href="volPass"><li>Volunteer Pass</li></a>
                <a href="volunteer_works"><li>View Available Jobs</li></a>
                <a href="volStatus"><li>View Job Status</li></a>
                   
                </div>
            </div>
            
            
            
            <div class="sub-menu-wrap">
                <li class="menu-drop">
                    <span>Migrant Labour Services</span>
                    <span class="mDown"></span>
                </li>
                <div class="sub-menu">
                    <a href="migrant"><li>Report Migrant Labour </li></a>
                    <a href="migrantMapDisplay"><li>Labour Tracking and Mapping</li></a>
                   
                </div>
            </div>
           ';
            }
?>
            <?php
            if(!isset($_SESSION['userLoggedIn']))
            {
                echo '<a href="signup"><li>Sign Up</li></a>';
            }
            ?>
            
            <?php if(isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn'] == 1)
            
            {  
                echo '
                <div class="sub-menu-wrap">
                <li class="menu-drop">
                    <span>Volunteer Services</span>
                    <span class="mDown"></span>
                </li>
                <div class="sub-menu">
                <a href="request_service"><li>Request Volunteer Services</li></a>
                <a href="userStatus"><li>View Volunteer Request Status</li></a>
                   
                </div>
            </div>


            <div class="sub-menu-wrap">
                <li class="menu-drop">
                    <span>Essential Services</span>
                    <span class="mDown"></span>
                </li>
                <div class="sub-menu">
                <a href="conEssential"><li>Contact an Essential Workers</li></a>
                <a href="products"><li>MSME Covid19 Products</li></a>
                <a href="request_items"><li>Request Emergency Supply</li></a>
                   
                </div>
            </div>

            <div class="sub-menu-wrap">
                <li class="menu-drop">
                    <span>Doctor Services</span>
                    <span class="mDown"></span>
                </li>
                <div class="sub-menu">
                <a href="hosApp"><li>Online Doctor Appointment</li></a>
                <a href="userdoc"><li>View Appointment Status</li></a>
                
                   
                </div>
            </div>


            <div class="sub-menu-wrap">
                <li class="menu-drop">
                    <span>General Services</span>
                    <span class="mDown"></span>
                </li>
                <div class="sub-menu">
                <a href="report_patient"><li>Report Covid Symptoms</li></a>
                <a href="report_hospital"><li>Report Hospital/Medical store</li></a>
                <a href="nearest"><li>Nearest Hospital/Medical store</li></a>
            <a href="geofencing"><li>View GeoFences</li></a>
                
                   
                </div>
            </div>
            ';
            

            }?>
            
       
            <?php
            if(isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn'] == 1)
            {
                $homepage = $_SESSION['homepage']; 
                echo '<a href="general_update"><li>Account Settings</li></a>'; 
                echo '<li id="logoutAction">Logout</li>
                <script>    
                $("#logoutAction").click(function(){

                    confirmBox("Logout From Account...","Are you sure?",function(){
                        window.location="'.$homepage.'?logout=true";
                        
                        
                    },function(){
                        
                        console.log("No Logout");
                    });


                });


                </script>
                
                ';
                
               
                
            }
            ?>
            <?php
    echo '
    <div class="sub-menu-wrap">
                <li class="menu-drop">
                    <span>Donation</span>
                    <span class="mDown"></span>
                </li>
                <div class="sub-menu">
                <a href="collection"><li>Donate Relief Material</li></a>
                <a href="onlineDonate"><li>Donate Funds</li></a>
                   
                </div>
            </div>
            
    
    ';


?>
            <a href="trainingvideo"><li>Online Courses</li></a>
            <a href="chatbot"><li>Counselling for patients and family</li></a>
            <?php
    echo '
    <div class="sub-menu-wrap">
                <li class="menu-drop">
                    <span>Government Services</span>
                    <span class="mDown"></span>
                </li>
                <div class="sub-menu">
                <a href="helpline"><li>Helpline Numbers</li></a>
                <a href="govt"><li>Government Services Linkages</li></a>
                   
                </div>
            </div>
            
    
    ';


?>
            
        </ul>
    </div>