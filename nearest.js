function initMap(){
    var map;
    map = new google.maps.Map(document.getElementById('googleMap'), {
        center: {lat:13,
            lng:80
        },
        zoom: 13
    });
}
function hideIcon(){
    $(".form-wrap").slideUp();
    $(".search").show();
   

}
$(document).ready(function(){
    $(".search").click(function(){
        $(".form-wrap").slideDown();
        $(".search").hide();
    });
});