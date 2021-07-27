<?php
function readable_random_string($length = 6)
{  
    $string     = '';
    $vowels     = array("a","e","i","o","u");  
    $consonants = array(
        'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 
        'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
    );  

    // Seed it
    srand((double) microtime() * 1000000);

    $max = $length/2;
    for ($i = 1; $i <= $max; $i++)
    {
        $string .= $consonants[rand(0,19)];
        $string .= $vowels[rand(0,4)];
    }

    return $string;
}

//URLS GENERATOR
function CreateUrls($customers = 10)
{
    for ( $i = 0; $i < $customers; $i++) 
    {
        //SEND MONEY
        $data .= "http://localhost:8000/api-signalfx.php?metric=".$_ENV["BUYMETRIC"].".sold&value=10&customer=".readable_random_string()."\n";
        $data .= "http://localhost:8000/api-signalfx.php?metric=".$_ENV["BUYMETRIC"].".cart&value=1&customer=".readable_random_string()."\n";
        //GET MONEY
        $data .= "http://localhost:8000/api-signalfx.php?metric=".$_ENV["BUYMETRIC"].".cart&value=1&customer=".readable_random_string()."\n";
    }

    return $data;
}

//END
//SIMULATION PART
//ecointet@signalfx.com
echo "Simulation:";
//CREATE THE FILE WITH URLS
$content = CreateUrls();
$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/urls.txt","wb");
fwrite($fp,$content);
fclose($fp);
//END
echo exec('./http_load -parallel 10 -seconds 600 ./urls.txt');
//echo $content;
?>