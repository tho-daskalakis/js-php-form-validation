<?php
$errors = array("firstName" => [], "lastName" => [], "birthday" => []);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize input
    $firstName = isset($_POST["firstName"]) ? processString($_POST["firstName"]) : "";
    $lastName = isset($_POST["lastName"]) ? processString($_POST["lastName"]) : "";
    $birthday = isset($_POST["birthday"]) ? $_POST["birthday"] : "";

    // Validate fields
    $errors["firstName"] = getFirstNameErrors($firstName);
    $errors["lastName"] = getLastNameErrors($lastName);
    $errors["birthday"] = getBirthdayErrors($birthday);

    // Check if there are no errors
    $hasErrors = !empty($errors["firstName"]) || !empty($errors["lastName"]) || !empty($errors["birthday"]);

    if ($hasErrors) {
        echo json_encode(["success" => false, "errors" => $errors]);
    } else {
        echo json_encode([
            "success" => true,
            "message" => "Form submitted successfully!",
            "data" => [
                "firstName" => $firstName,
                "lastName" => $lastName,
                "birthday" => $birthday
            ]
        ]);
    }
    exit;
}

function getFirstNameErrors($name)
{
    $errors = [];
    if ($name === "") $errors[] = "First name is required.";
    if (!preg_match("/^[a-zA-Z'-]+$/", $name)) $errors[] = "First name must contain only letters, hyphens, or apostrophes.";
    return $errors;
}

function getLastNameErrors($name)
{
    $errors = [];
    if ($name === "") $errors[] = "Last name is required.";
    if (!preg_match("/^[a-zA-Z'-]+$/", $name)) $errors[] = "Last name must contain only letters, hyphens, or apostrophes.";
    return $errors;
}

function getBirthdayErrors($date)
{
    $errors = [];
    if ($date === "") {
        $errors[] = "Birthday is required.";
        return $errors;
    }

    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
        $errors[] = "Birthday format must be YYYY-MM-DD.";
        return $errors;
    }

    list($year, $month, $day) = explode("-", $date);
    if (!checkdate((int)$month, (int)$day, (int)$year)) {
        $errors[] = "Date is invalid.";
    }

    return $errors;
}

function processString($string) {
    return htmlspecialchars(trim(stripslashes($string)), ENT_QUOTES, 'UTF-8');
}
