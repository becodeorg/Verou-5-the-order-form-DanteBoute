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
    ['name' => 'Slice of cheesecake', 'price' => 5.5],
    ['name' => 'Slice of carrotcake', 'price' => 5.5],
    ['name' => 'Slice of chocolatecake', 'price' => 6.5],
    ['name' => 'Slice of blueberrycake', 'price' => 6],
    ['name' => 'Chocolate muffin', 'price' => 4.5]
];

$totalValue = 0;

function validate()
{
    // TODO: This function will send a list of invalid fields back
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
           
        // GRAB DATA FROM INPUTS
        $street = htmlspecialchars($_POST["street"]);
        $streetnumber = htmlspecialchars($_POST["streetnumber"]);
        $city = htmlspecialchars($_POST["city"]);
        $zipcode = htmlspecialchars($_POST["zipcode"]);

        $invalidFields = [];

        if (empty($street) || empty($streetnumber) || empty($city) || empty($zipcode)) {
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
    // TODO: form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
}

// TODO: replace this if by an actual check for the form to be submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    handleForm();
}

require 'form-view.php';

// Perform validation
$invalidFields = validate(); // Ensure the 'validate()' function is included in your-validation-file.php

// Display errors if they exist
if (!empty($invalidFields)) {
    echo '<div class="alert alert-danger">'; // Display errors in a Bootstrap alert
    echo '<p>Please correct the following errors:</p>';
    echo '<ul>';
    foreach ($invalidFields as $error) {
        echo "<li>$error</li>";
    }
    echo '</ul>';
    echo '</div>';
}