var add = 0;
var str="";
function getUrls(link) {

    var id = "", title = "";
      
        id = link.split('v=')[1];
       
        $.ajax({
            url: "https://www.googleapis.com/youtube/v3/videos?id=" + id + "&key=AIzaSyBW6vQqUve-ghoMsSpf3NK7PlwnDYXsNPY&part=snippet",
            crossDomain:true,
            dataType: "jsonp",
            success:  function (data) {
                var snippet =  data.items["0"].snippet.thumbnails.medium.url;
                
                title = data.items["0"].snippet.title;
              
                str+='<div class="video"><span id="video-url">'+link+'</span> <div class="thumb"><img src="'+snippet+'" alt=""></div><div id="video-title">'+title+'</div></div>';
                document.getElementById('mainvideo').innerHTML = str;
                
            }   
        });
    
}

function onAddVideo(){
    $.post('trainvideoAction.php?addvideo=true',{
        url: document.getElementById('url').value,
        category : document.getElementById('category').value
    },function(data){
        alertBox(data,'',2,'trainvideo');
    });
}
$(document).on('click','.video',function(){
    var go = $(this).children("#video-url").html();
    
    window.location.href = go;
});
$(document).ready(function(){
    $("#add").click(function(){
        if(add % 2 == 0) {
            $("#form-wrap").slideDown();
            $("#add").html("&#8617");
        }
        else {
            $("#add").html("+");
            $("#form-wrap").slideUp();
        }
        add++;
    });
});
$(document).ready(function(){
var str="";
$.post("trainvideoAction.php?getvideos=true",function(response){
   response = (JSON.parse(response));
   str="";
   for(var i=0;i<response.length;i++){
       getUrls(response[i]);
   }
    
});

});
$(document).on('click','.list',function(){
    // use $(this).html() for retrieving the category 
    // and use ajax for loading the videos of that category
});
function disableAll(){
    $(".list").each(function(i){
        $(this).css("backgroundColor","unset");
        $(this).css("color","black");
        $(this).css("font-weight","normal");
    });
}
$(document).ready(function(){
var category ;
    $("#selectcategory").on("change",function(){
        category = this.value;
        $.post('trainvideoAction.php?getvideos=true&category='+this.value,function(response){
            response = (JSON.parse(response));
            str="";
            for(var i=0;i<response.length;i++){
                getUrls(response[i]);
            }
        });

        
        $(".list").each(function(){
            if($(this).text() == category)
            {
                disableAll();
                $(this).css("backgroundColor","rgb(49,110,164)");
                $(this).css("color","white");
                $(this).css("font-weight","bold");
            }
        });

    });
    $(".list").click(function(){
        category = $(this).text();
        disableAll();
        $(this).css("backgroundColor","rgb(49,110,164)");
        $(this).css("color","white");
        $(this).css("font-weight","bold");
     
        $.post('trainvideoAction.php?getvideos=true&category='+category,function(response){
            response = (JSON.parse(response));
            str="";
            for(var i=0;i<response.length;i++){
                getUrls(response[i]);
            }
        });
        
        var $select = $('#selectcategory');
        $select.children().filter(function(){
            
            return $.trim(this.text) == category;
        }).prop('selected', true);
        
    });
    
});