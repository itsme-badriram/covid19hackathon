<?php
require_once('dbConnect.php');
require_once('functions.php');
if(!checkLogin()){
    header("Location: login"); }

    if(isset($_GET['logout'])){
        removeAll();
        header("Location: doctor");
    }
    if(isset($_SESSION['homepage']) && $_SESSION['homepage'] != 'doctor'){
        $homepage = $_SESSION['homepage'];
        header("Location: $homepage");
    
      } 
      ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab Results | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="docLab.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
   
    <script src="menu.js"></script>
    
    <script src="dropzone.js"></script>
    <link rel="stylesheet" href="dropzone.css">
  
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>    
<body>
         
    <?php  require_once('menubar.php'); ?>
    <div class="main">
        <h2>Send Lab Results</h2>
        <br>
        <form action="" id="formid">
            <label for="from">From <br>
                <input type="text" name="" id="from" value="<?php echo $_SESSION['uname']; ?>" disabled>
            </label><br><br>
            <label for="to">To <br>
                <input type="text" name="" id="to" placeholder="Email">
            </label><br><br>
            <label for="sub">Subject <br>
                <input type="text" name="" id="sub" placeholder="Eg: Covid Test Results">
            </label><br><br>
            <label for="remark">Remarks <br>
                <input type="text" name="" id="remark" placeholder="Eg: Meet after 2days, etc.">
            </label><br><br>
            <label for="">Upload Files</label><br>
        </form>
        <form id="upload"
      class="dropzone"
      id="mydropzone"></form>

        <div class="send">
            <input type="button" id="submit-all" value="Send Report">
        </div><br>
    </div><br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>    
    <script>
     Dropzone.autoDiscover = false;
$(document).ready(function() {
    var myDropzone = new Dropzone('form#upload',{
        url: 'labResultAction',
        autoProcessQueue: false,
        maxFiles:1,
        acceptedFiles: '.pdf',
        
        dictInvalidFileType: 'This form only accepts images.',
        init: function(){
     
   var submitButton = document.querySelector('#submit-all');
   myDropzone = this;
   submitButton.addEventListener("click", function(){
    myDropzone.processQueue();
   });
   this.on("maxfilesexceeded", function(file){
        alert("No more files please!");
    });
    this.on("sending", function(file, xhr, formData) {
      formData.append("to", document.getElementById('to').value);
      formData.append("subject", document.getElementById('sub').value);
      formData.append("remarks", document.getElementById('remark').value);
     
    });
   this.on("complete", function(){
    alertBox('Report Uploaded Successfully','',3);
    if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
    {
     var _this = this;
     _this.removeAllFiles();
    
        $("#formid").trigger('reset');
    }
   });
  }
    });
});
</script>
</body>
</html>