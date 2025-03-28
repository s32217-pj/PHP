<!--Form submit script-->
<?php

if($_SERVER["REQUEST_METHOD"]!="POST") //only post request are supported
    return;

$peopleCount = $_POST['people-count'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$addressCity = $_POST['address-city'];
$addressProvince = $_POST['address-province'];
$addressStreet = $_POST['address-address'];
$postalCode = $_POST['address-postal-code'];
$creditCard = $_POST['credit-card'];
$childBed = isset($_POST['child-bed']) ? true : false;
$addons = isset($_POST['addons']) ? $_POST['addons'] : [];


//i couldn't achieve saving names and surnames to one array, so instead they are stored in different arrays, and then merged into one
$people_names = isset($_POST['people-names']) ? $_POST['people-names'] : [];
$people_surnames = isset($_POST['people-surnames']) ? $_POST['people-surnames'] : [];
$people = [];

for($i=0;$i<count($people_names);$i++)
    $people[] = ['name' => $people_names[$i], 'surname' => $people_surnames[$i]];

//store data in session
session_start();
$_SESSION['reservation'] = [
    'people-count' => $peopleCount,
    'name' => $name,
    'surname' => $surname,
    'address' => [
        'city' => $addressCity,
        'province' => $addressProvince,
        'street' => $addressStreet,
        'postal-code' => $postalCode
    ],
    'credit-card' => $creditCard,
    'child-bed' => $childBed,
    'addons' => $addons,
    'people' => $people
];

// Redirect to the summary page
header("Location: summary.php");
?>
