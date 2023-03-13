<html lang="en">

<head>

    <!-- INCLUDING JQUERY-->
    <script src=
            "https://code.jquery.com/jquery-3.5.1.js">
    </script>

    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }

        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans',
            'Gill Sans MT', ' Calibri',
            'Trebuchet MS', 'sans-serif';
        }

        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }

        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        td {
            font-weight: lighter;
        }
    </style>
</head>

<body>

<h1> test </h1>
<?php
//$json = file_get_contents('http://localhost/academy/public/api/sign-up');
//$obj[] = json_decode($json);
//$data = $obj;
//print_r( $data);
// dd($obj);

//$url = 'http://localhost/academy/public/api/sign-up';
//$obj = json_decode(file_get_contents($url), true);
//echo $obj['error'];
?>

<script>
    (function ($) {
        $.postJSON = function (url, data) {
            var o = {
                url: "http://localhost/academy/public/api/sign-up",
                type: "POST",
                dataType: "json",
                contentType: 'application/json; charset=utf-8'
            };
            if (data !== undefined) {
                o.data = JSON.stringify(data);
            }
            return $.ajax(o);
        };
    } (jQuery));

</script>
</body>

</html>
