<!DOCTYPE html>
<html>
<head>
    <style>img{ height: 100px; float: left; }</style>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>
<body>
<div id="images">

</div>
<script>$.getJSON("http://localhost/academy/public/api/sign-up",
        function(data){
            $.each(data, function(i,item){
                alert(data);
                // $("<img/>").attr("src", item.url).appendTo("#images");
            });
        });</script>

</body>
</html>
