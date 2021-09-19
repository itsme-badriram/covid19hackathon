$(document).ready(function(){
    $(".form-wrap").slideToggle();
    $("#docSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".doc-box").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $(".filter").click(function(){
        $(".form-wrap").slideToggle();
    });
});