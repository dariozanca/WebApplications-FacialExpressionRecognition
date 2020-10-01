<?php

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $subject_name = trim($_POST['name_report']);
    $subject_surname = trim($_POST['surname_report']);
    $subject_birthdate = trim($_POST['birthdate_report']);
    $subject_answers = $_POST['answers_report'];
    
    // Create the file
    $fileId = time();
    $fileName = "Reports/" . $fileId . ".csv";
    
    file_put_contents($fileName, "Name:," . $subject_name . "\n", FILE_APPEND );
    file_put_contents($fileName, "Surname:," . $subject_surname . "\n", FILE_APPEND );
    file_put_contents($fileName, "Birthdate:," . $subject_birthdate . "\n", FILE_APPEND );
    file_put_contents($fileName, "\n\n\n", FILE_APPEND );
    file_put_contents($fileName, $subject_answers, FILE_APPEND );
        
}

else {
    
    // Redirect if it's not coming from a complete test
    echo "<script>window.location.href='index.php';</script>";
    exit;
}

?>