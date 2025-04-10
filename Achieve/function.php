<?php
require "dbconnect.php";

function signup($mail, $fname, $lname, $age, $gender, $pass, $country, $city)
{
    global $conn;

    // Default IDs to null
    $countryid = null;
    $cityid = null;

    if ($mail && $pass && $age && $fname && $lname && $gender) {
        // Get country ID
        if (!empty($country)) {
            $stmt = $conn->prepare("SELECT id FROM countries WHERE name = :country");
            $stmt->execute([':country' => $country]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $countryid = $result['id'];
            }
        }

        // Get city ID
        if (!empty($city)) {
            $stmt = $conn->prepare("SELECT id FROM city WHERE name = :city");
            $stmt->execute([':city' => $city]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $cityid = $result['id'];
            }
        }

        try {
            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user (firstname, lastname, mail, gender, password, countryid, cityid)
                    VALUES (:fname, :lname, :mail, :gender, :pass, :countryid, :cityid)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':fname'     => $fname,
                ':lname'     => $lname,
                ':mail'      => $mail,
                ':gender'    => $gender,
                ':pass'      => $hashedPass,
                ':countryid' => $countryid,
                ':cityid'    => $cityid
            ]);

            return true;
        } catch (PDOException $e) {
            error_log("Signup failed: " . $e->getMessage());
            return false;
        }
    }
    return false;
}

function signin($mail, $pass)
{
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT * FROM user WHERE mail = :mail");
        $stmt->execute([':mail' => $mail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pass, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Signin failed: " . $e->getMessage());
        return false;
    }
}
