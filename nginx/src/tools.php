<?php
session_save_path('/data-ext/sessions');
ini_set('session.gc_probability', 1);
session_start();
require_once "data/src/Store.php";
$folder = __DIR__;
$folder = "/data-ext";
$databaseDirectory = $folder . "/demo-harness-database";
$store = new \SleekDB\Store("demo-harness", $databaseDirectory);

function getLogo()
{}

//ACTIONS
if ($_GET["action"] == "update-customer")
{
    $_SESSION["buyer"] = $_GET["value"];
    insertPref($store);
    die("New Session Name! customer: [".$_SESSION["buyer"]."]");
}

//ACTIONS
if ($_GET["action"] == "update-logo")
{
    $_SESSION["logo"] = $_GET["value"];
    insertPref($store);
    die("New Session Name! logo: [".$_SESSION["logo"]."]");
}

//ACTIONS
if ($_GET["action"] == "update-background")
{
    $_SESSION["background"] = $_GET["value"];
    insertPref($store);
    die("New Session Name! background: [".$_SESSION["background"]."]");
}

//ACTIONS
if ($_GET["action"] == "update-link")
{
    $_SESSION["link"] = $_GET["value"];
    insertPref($store);
    die("New Link ! link: [".$_SESSION["link"]."]");
}

//ACTIONS
if ($_GET["action"] == "debug")
{
    if ($_GET['name'])
     print_r($store->findOneBy(["name", "=", strtolower($_GET['name'])]));
    else
     print_r($store->findAll());
     
    die("done");
}



//NAME GENERATOR
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


function readApi($store, $name)
{
    //echo "DEBUG";
  //  echo "MY-DEBUG-READ".getenv("DB");
    $value = $store->findOneBy(["name", "=", strtolower($name)]);
   // echo $value;;
   // print_r($value);
    return $value;
}

function insertPref($store)
{
    $store->deleteBy(["name", "=", $_SESSION["buyer"]]);

    $data = [
        'name' => $_SESSION["buyer"],
        'logo' => $_SESSION["logo"],
        'background' => $_SESSION["background"],
        'link' => $_SESSION["link"]
    ];

    $results = $store->insert($data);
}
?>