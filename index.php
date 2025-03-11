<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form values.
    $firstName = processName($_POST["firstName"]);
    $lastName = processName($_POST["lastName"]);
    $birthday = processBirthdate($_POST["birthday"]);

    // Validate inputs.

    // Return appropriate response.
}

function processName($name) {
    // Trim, format etc.

    return $name;
}

function processBirthdate($date)
{
    // ...process/format

    return $date;
}
