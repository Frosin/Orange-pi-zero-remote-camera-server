<?php
$require = file_get_contents('require.txt');
if (isset($_GET['key']) && md5($_GET['key']) == $require) {
    //
} else {
    file_put_contents(__DIR__ . "/log-bad-access.log", date("d.m.Y H:i:s") . " : " . $_SERVER['REMOTE_ADDR'] . "\n", FILE_APPEND);
    header("HTTP/1.0 404 Not Found");
    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript" > 
    num = 1;

    start();

    function start() {
        var timerId = setInterval(function() {
            getImage();
            console.log('getting...');
        }, 10000);
    }
        
    function getImage() {
        $(document).ready( function() { 
        $.ajax({
        type: "POST",
        url:'getphoto.php',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: "getphotocommand=1",
        success: function(data){
            if (data == "none") {
                return false;
            }
            $('.romb').html('<img src="data:image/jpg;base64,' + data + '" />'); 
        }
        } );});
    }

    function getAllImages() {
        $(document).ready( function() { 
        $.ajax({
        type: "POST",
        url:'getphoto.php',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: "getphotocommand=2",
        success: function(data){
            if (data == "none") {
                return false;
            }
            runAllImages(data);
        }
        } );});
    }

    function runAllImages(data) {
        clearInterval(timerId);
        images = JSON.parse(data);
        runInterval = setInterval(function () {
            if (images.length > 0) {
                image = images.shift();
                $('.romb').html('<img src="data:image/jpg;base64,' + image + '" />'); 
            } else {
                clearInterval(runInterval);
                start();
            }
        }, 1000);
    }

</script>  
<body>
    <div class='romb'></div>
    <input type="submit" value="Play" onclick="getAllImages()">
</body>
</html>