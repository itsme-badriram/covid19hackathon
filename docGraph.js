window.onload = function () {
    var chart = new CanvasJS.Chart("graph", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: "Covid Suspects",
            fontFamily: "myFont",
            fontSize:20
        },
        axisX:{
            title: "Date",
            titleFontFamily: "myFont"
        },
        axisY:{
            title: "Number of suspects",
            titleFontFamily: "myFont",
            includeZero: false
        },
        data: [{        
            type: "line",
              indexLabelFontSize: 16,
            dataPoints: [
                { x: new Date(2020,04,02) , y: 450 },
                { x: new Date(2020,04,03), y: 414 },
                { x: new Date(2020,04,04), y: 520 },
                { x: new Date(2020,04,05), y: 460 },
                { x: new Date(2020,04,06), y: 450 },
                { x: new Date(2020,04,07), y: 500 },
                { x: new Date(2020,04,08), y: 480 },
                { x: new Date(2020,04,09), y: 480 },
                { x: new Date(2020,04,10), y: 410 },
                { x: new Date(2020,04,11), y: 500 }
            ]
        }]
    });
    chart.render();
}

function getProgressBar(){
    var color = "";
    $(".bar-value").each(function(i){
        var width = $(this).html();
        if(width < 50) color = "seagreen";
        else if(width < 80) color = "orange";
        else color = "rgb(150,0,0)"; 
        width = width + "%";
        $(this).parents(".progress").children(".bar").children(".value").css("width",width);
        $(this).parents(".progress").children(".bar").children(".value").css("background-color",color);
    });
}