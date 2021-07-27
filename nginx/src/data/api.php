<?php

include "../auth-module.php";
//API VERIFICATION
if ($_GET['func'] == 'verif')
{
    if ($auth_version != 1)
       $info = true;
    else
       $info = false;
    
    echo json_encode(buildVerif($info, $value));
}

function buildVerif($error, $value)
{
    if ($error)
    {
        $newtime = time() - 5;
        $data = array (
            "hostname"  => "my-web-server",
            "level" => "error",
            "message"   => "Image: not Canary Captain America",
            "@timestamp" => $newtime
        );
    }
    else
    {
        $data = array (
            "hostname"  => "my-web-server",
            "level" => "ok",
            "message"   => "No issue detected",
            "@timestamp" => time()
        );
    }

/*
    $error_message = get_string_between($value, 'id="error_message">', "</div>");
    if (strlen($error_message) > 1)
    {
        $newtime = time() - 5;
        $data[] = array (
            "hostname"  => "my-web-server",
            "level" => "error",
            "message"   => $error_message,
            "@timestamp" => $newtime
        );

    }
*/
//if ($error)
  //  array_push($data, $dataerror);

return $data;

}


function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

?>