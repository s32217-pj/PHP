<!--Form submit script-->
<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") //only post request are supported
    return;

//save form to cookie
foreach ($_POST as $key => $value) {
    if (is_array($value))
        setcookie($key, json_encode($value), time() + 60*60*24, "hotel.php"); // 30 dni
     else
        setcookie($key, $value, time() + 60*60*24, "hotel.php");
}

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

for ($i = 0; $i < count($people_names); $i++)
    $people[] = ['name' => $people_names[$i], 'surname' => $people_surnames[$i]];


//STORE DATA IN SESSION
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


//SAVE DATA INTO FILE
// Prepare the data for CSV
$csvFields = ['People Count', 'Name', 'Surname', 'City', 'Province', 'Street', 'Postal Code', 'Credit Card', 'Child Bed', 'Add-ons'];
$csvData = [];
$csvSeparator = ';';

//Add each person's data
foreach ($people as $person) {
    $csvData[] = [
        $peopleCount,
        $person['name'],
        $person['surname'],
        $addressCity,
        $addressProvince,
        $addressStreet,
        $postalCode,
        $creditCard,
        $childBed ? 'Yes' : 'No',
        implode(', ', $addons)
    ];
}

$file = fopen("reservations.csv", "a+");

if (filesize("reservations.csv") == 0)//if file was just created put csv fields into it
    fputcsv($file, $csvFields, separator: $csvSeparator);

if (!$file)//if file could not be opened just go to summary and don't thnik about it
    header("Location: summary.php");

foreach ($csvData as $data)
    fputcsv($file, $data, separator: $csvSeparator);

fclose($file);

// Redirect to the summary page
header("Location: summary.php");
?>