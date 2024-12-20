<!DOCTYPE html>
<html>
    <head>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    </head>
    <body>   
    <?php
    require("tool/connect.php");
    ?>
    <script>
        var queryString = window.location.search;
        var searchParams = new URLSearchParams(queryString);
        var id =searchParams.get("id");
        var lat,lng;
    $.ajax({
        type:"post",
        url:"tool/findlatlngtothunkable.php",
        data:{id:id},
        success:function(data){
            data = JSON.parse(data);
            lat = data.lat;
            lng = data.lng;
        }
    });
    </script>
        <?php 
        // session_start();
        // if(isset($_GET['id'])){
        //     $id = $_GET['id'];
        // }
        // $sql = "SELECT * FROM userdata WHERE `userID` LIKE '{$id}';";
        // $result = mysqli_query($connection,$sql);
        // $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
        // echo "<script>var lat = {$rows[0]["lat"]},lng = {$rows[0]["lng"]},id = {$id};</script>";
        ?>
    <p id = "time"></p>
    <script>
    var x,y;
    function loadmaps() {
    $.getJSON("https://api.thingspeak.com/channels/2093164/fields/1/last.json?api_key=",function(result){
        x = result.field1;
    });
    $.getJSON("https://api.thingspeak.com/channels/2093164/fields/2/last.json?api_key=",function(result){
        y = result.field2;
    }).done(function(){
        if (x == undefined || y == undefined) {
            loadmaps();
        }
        else{
        lat = parseFloat(lat);
        lng = parseFloat(lng);
        id = parseInt(id);
        var directionService = new google.maps.DirectionsService;
        directionService.route({
            origin: new google.maps.LatLng(x, y),
            destination: new google.maps.LatLng(lat, lng),
            travelMode: 'DRIVING',
        },function(response, status){
            let Hours = (parseInt(response.routes[0].legs[0].duration.value / 3600));
            let Minutes = (parseInt((response.routes[0].legs[0].duration.value % 3600) / 60));
            $.ajax({
                type:"post",
                url:"tool/updatetimetodb.php",
                data:{hours:Hours,minutes:Minutes,id:id},
                success:function(data){
                    // alert(data);
                }
            });
        });
    }
    });
    }
    loadmaps();
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>    
    </body>
</html>