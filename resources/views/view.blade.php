<!DOCTYPE html>
<html>
<head>
    <style>img{ height: 100px; float: left; }</style>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>
<body>
<div id="images">
    <h1> view page </h1>
</div>
<?php
//    $name = "";
    $s = 'http://localhost/academy/public/api/view?';
    $json = file_get_contents($s);
    $obj[] = json_decode($json)->user;
    $data = $obj;
//    dd($obj);
    foreach($data as $info)
    {
        foreach($info as $infos)
        {
            $result = $infos->name;
            echo "<div style = 'background : pink;text-align:center; color : blue; font-size:60px'>";
            echo $result;
            echo "</div>";
//            foreach($infos as $my_info)
//            {
//                print_r($my_info);
//            }
                dd($infos);
        }
    }
echo "<div style = 'background : pink;text-align:center; color : blue; font-size:60px'>";
echo $result;
echo "</div>";
//    dd($infos);
//    print_r( $data);
// dd($obj);
?>

</body>
</html>
