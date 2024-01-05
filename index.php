<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);
// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => '1h of extra PHP lessons by Jonasi', 'price' => 65],
    ['name' => '1h of extra JS lessons by Jonasi', 'price' => 55],
    ['name' => '1 (unnoticed) day of absence at home', 'price' => 45],
    ['name' => '1 (unnoticed) day of absence on campus', 'price' => 85],
    ['name' => 'Sandwich Delivery', 'price' => 2.5],
    ['name' => 'Afternoon Snack', 'price' => 3.5],
    ['name' => 'Homemade B-Day cake', 'price' => 25],
    ['name' => '15 min head massage by Anaïs', 'price' => 20],
    ['name' => '10 min Motorcycle ride with Luis', 'price' => 30],
    ['name' => 'TechTalkTake-over', 'price' => 100],
    ['name' => 'Start fire alarm during TechTalk', 'price' => 30],
    ['name' => 'TechTalk feedback from Thibault', 'price' => 5],
    ['name' => '30 minute nap on campus', 'price' => 15]
];

$totalValue = 0;

function validate()
{
    // TODO: This function will send a list of invalid fields back
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
           
        // GRAB DATA FROM INPUTS
        $email = htmlspecialchars($_POST["email"]);
        $street = htmlspecialchars($_POST["street"]);
        $streetnumber = htmlspecialchars($_POST["streetnumber"]);
        $city = htmlspecialchars($_POST["city"]);
        $zipcode = htmlspecialchars($_POST["zipcode"]);

        $invalidFields = [];

        if (empty($street) || empty($streetnumber) || empty($city) || empty($zipcode) || empty($email)) {
            $invalidFields[] = "Please fill in all fields";
        }
        if (!is_numeric($streetnumber) || !is_numeric($zipcode)) {
            $invalidFields[] = "Only numbers allowed as streetnumber and zip-code!";
        }
        return $invalidFields;
    }
    return [];
}

function handleForm()
{
    global $products, $totalValue;
        $invalidFields = validate();
        if (empty($invalidFields)) {
            $selectedProducts = $_POST['products'] ?? [];
            echo "<h2>Order Confirmed!</h2>";
            echo "<h2>Your Order:</h2>";
            echo "<ul>";

            foreach ($selectedProducts as $key => $value) {
                echo "<li>" . $products[$key]['name'] . " - &euro;" . number_format($products[$key]['price'], 2) . "</li>";
                $totalValue += $products[$key]['price'];
            }
        } else {
            echo '<div class="alert alert-danger">';
            echo '<p>Please correct the following errors:</p>';
            echo '<ul>';
            foreach ($invalidFields as $error) {
                echo "<li>$error</li>";
            }
            echo '</ul>';
            echo '</div>';
        }
    }
// AUTOFILLING STREET AND NUMBER
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['street']) && isset($_POST['streetnumber'])) {
    $_SESSION['userStreet'] = $_POST['street'];
    $_SESSION['userStreetNumber'] = $_POST['streetnumber'];
}

// Retrieve session variables for autofilling
$userStreet = isset($_SESSION['userStreet']) ? $_SESSION['userStreet'] : '';
$userStreetNumber = isset($_SESSION['userStreetNumber']) ? $_SESSION['userStreetNumber'] : '';


// TODO: replace this if by an actual check for the form to be submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['street'], $_POST['streetnumber'], $_POST['city'], $_POST['zipcode'], $_POST['email'])) {
    // Call handleForm only if the form is submitted
    require 'form-view.php';

    // Clear POST data to prevent duplicate submissions on page reload
    unset($_POST);

    // Redirect to a different URL to prevent form resubmission on page refresh
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
} else {
    // If the form is not submitted, display the form
    require 'form-view.php';
}