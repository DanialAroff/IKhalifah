<?php
    require_once("../config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $birthdate = $age = $gender = $birthcertno = $nationality = "";
        $address1 = $address2 = $postcode = $city = "";
        $parentFullname = $parentIc = $parentAge = $relationship = $parentNationality = $parentOccupation = $parentPhone = "";
        
        if (isset($_POST['submit'])) {

            $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
            $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
            $age = mysqli_real_escape_string($conn, $_POST['age']); // Consider validation for age
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            $birthcertno = mysqli_real_escape_string($conn, $_POST['birthcertno']);
            $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
            $address1 = mysqli_real_escape_string($conn, $_POST['address1']);
            $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
            $postcode = mysqli_real_escape_string($conn, $_POST['address3']);
            $city = mysqli_real_escape_string($conn, $_POST['address4']);
            $parentFullname = mysqli_real_escape_string($conn, $_POST['parentFullname']);
            $parentIc = mysqli_real_escape_string($conn, $_POST['parentIc']);
            $parentAge = mysqli_real_escape_string($conn, $_POST['parentAge']); // Consider validation for age
            $relationship = mysqli_real_escape_string($conn, $_POST['relationship']);
            $parentNationality = mysqli_real_escape_string($conn, $_POST['parentNationality']);
            $parentOccupation = mysqli_real_escape_string($conn, $_POST['parentOccupation']);
            $parentPhone = mysqli_real_escape_string($conn, $_POST['parentPhone']);
            $userId = mysqli_real_escape_string($conn, $_SESSION['userId']);

            $sql_student = "INSERT INTO students (fullname, birthdate, age, gender, birthcertno, nationality, address1, address2, postcode, city, is_approved) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";
            $sql_parent = "INSERT INTO parents (fullname, ic_no, age, relationship, nationality, occupation, phone_number, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt_student = mysqli_prepare($conn, $sql_student);
            $stmt_parent = mysqli_prepare($conn, $sql_parent);

            mysqli_stmt_bind_param($stmt_student, "ssssssssss", $fullname, $birthdate, $age, $gender, $birthcertno, $nationality, $address1, $address2, $postcode, $city);
            mysqli_stmt_bind_param($stmt_parent, "ssssssss", $parentFullname, $parentIc, $parentAge, $relationship, $parentNationality, $parentOccupation, $parentPhone, $userId);

            if (mysqli_stmt_execute($stmt_student) && mysqli_stmt_execute($stmt_parent)) {
                echo "Student and parent information saved successfully!";
                header('location:' . base_url . '/registerstudent.php?=applied');
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt_student);
            mysqli_stmt_close($stmt_parent);
            mysqli_close($conn);
            exit();
        } else {
            echo 'Not submit';
            exit();
        }
    } else {
        echo "Submission failed";
        sleep(3);
        header('location: ' . base_url . '/registerstudent.php?=failed');
    }
?>