<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

$host = "localhost";
$user = "ngarw_spes";
$pass = "ngarw_spes";
$db   = "ngarw_spes";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=Applied_students.csv');

$output = fopen('php://output', 'w');

// Add all column headers
fputcsv($output, [
    'ID', 'First Name', 'Last Name', 'Father Name', 'Mother Name', 
    'Gender', 'Date of Birth', 'Marital Status', 'Phone Number', 'Email Address',
    'Reference Person Phone', 'National ID Number', 'Nationality', 'Country of Residence',
    'Sponsor', 'Province', 'District', 'Sector', 'Residence District', 'Disability',
     'Created At'
]);

$sql = "SELECT * FROM personal_info";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        fputcsv($output, [
            $row['id'],
            $row['first_name'],
            $row['last_name'],
            $row['father_name'],
            $row['mother_name'],
            $row['gender'],
            $row['date_of_birth'],
            $row['marital_status'],
            $row['phone_number'],
            $row['email_address'],
            $row['reference_person_phone'],
            $row['national_id_number'],
            $row['nationality'],
            $row['country_of_residence'],
            $row['sponsor'],
            $row['province'],
            $row['district'],
            $row['sector'],
            $row['residence_district'],
            $row['disability'],
           
            $row['created_at']
        ]);
    }
}

fclose($output);
$conn->close();
exit;
?>