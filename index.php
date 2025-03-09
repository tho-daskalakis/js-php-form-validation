<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form values.
    $firstName = processNameData($_POST["firstName"]);
    // ...and the rest fields

    // Validate inputs.

    // Return appropriate response.
}

function processNameData($data) {
    // Trim, format etc.

    return $data;
}

function processBirthdate($data)
{
    // ...process/format

    return $data;
}
