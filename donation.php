<?php include 'include/header.php'; ?>
<?php
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $amount = htmlspecialchars($_POST['amount']);
    $recurring = isset($_POST['recurring']) ? "Yes" : "No";

    if (empty($name) || empty($email) || empty($phone) || empty($amount)) {
        $error = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif (!preg_match("/^\+?[0-9]{7,20}$/", $phone)) {
        $error = "Invalid phone number.";
    } elseif ($amount < 1 || $amount > 10000000000) {
        $error = "Donation amount must be greater than $1 .";
    } else {
        $host = "localhost";
        $dbname = "ngarw_spes";
        $user = "ngarw_spes";
        $pass = "ngarw_spes";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("INSERT INTO donations (name, email, phone, amount, recurring) VALUES (:name, :email, :phone, :amount, :recurring)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':amount' => $amount,
                ':recurring' => $recurring
            ]);

            // After saving to DB, send emails
$to = "faustin.niyitegeka@gmail.com";
$subject = "New Donation Received";
$message = "
A new donation has been received:

Name: $name
Email: $email
Phone: $phone
Amount: $$amount
Recurring: $recurring
";

$headers = "From: info@nga.ac.rw\r\n";
$headers .= "Reply-To: $email\r\n";

mail($to, $subject, $message, $headers);

// Send confirmation email to donor
$donor_subject = "Thank you for your donation!";
$donor_message = "
Dear $name,

Thank you for your generous donation of $$amount.

Best regards,
NGA Rwanda
";

$donor_headers = "From: info@nga.ac.rw\r\n";
mail($email, $donor_subject, $donor_message, $donor_headers);

$success = "Thank you, $name! Your donation of $$amount has been recorded successfully.";

        } catch(PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Donate to Our NGO</title>
<style>
body { font-family: Arial, sans-serif; margin:0; background:#f0f4f8; }
.donation-container {
    max-width: 700px;
    margin: 50px auto;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
h1 { text-align:center; color:#222; margin-bottom:8px; font-size:1.6rem; }
p { text-align:center; color:#555; margin-bottom:20px; font-size:0.95rem; }
.success, .error { text-align:center; padding:10px 15px; border-radius:6px; margin-bottom:15px; font-weight:600; font-size:0.9rem; }
.success { background:#d4edda; color:#155724; }
.error { background:#f8d7da; color:#721c24; }

form .form-group { margin-bottom:15px; }
form label { display:block; margin-bottom:4px; color:#333; font-weight:600; font-size:0.9rem; }
form input[type="text"], input[type="email"], input[type="number"], input[type="tel"] {
    width:100%; padding:8px; border:1px solid #ccc; border-radius:6px; font-size:0.9rem; box-sizing:border-box; transition:border 0.3s;
}
form input:focus { border-color:#007bff; outline:none; }

.form-row { display:flex; gap:15px; flex-wrap:wrap; margin-bottom:15px; }
.form-row .form-group { flex:1; min-width:150px; }

.amount-options { display:flex; flex-wrap:wrap; margin-bottom:10px; }
.amount-options button {
    margin-right:8px; margin-bottom:8px; padding:8px 15px; border:none; border-radius:6px; background-color:#28a745; color:#fff;
    cursor:pointer; font-size:0.85rem; transition: background 0.3s, transform 0.2s;
}
.amount-options button:hover { background-color:#218838; transform:translateY(-1px); }

input[type="checkbox"] { margin-right:6px; }

.btn-submit {
    background-color:#FFA63A; color:#fff; border:none; padding:12px 20px; border-radius:40px; font-size:0.95rem; font-weight:600;
    width:100%; cursor:pointer; transition:background 0.3s, transform 0.2s;
}
.btn-submit:hover { background-color:#FF6B35; transform:translateY(-1px); }

@media (max-width:768px) { 
    .donation-container { margin:40px 15px; padding:20px; } 
}
</style>
</head>
<body>

<div class="donation-container">
<h1>Donate to Make a Difference</h1>
<p>Your support helps us change lives every day.</p>

<?php if($success): ?><div class="success"><?php echo $success; ?></div><?php endif; ?>
<?php if($error): ?><div class="error"><?php echo $error; ?></div><?php endif; ?>

<form method="post" action="">
<div class="form-row">
    <div class="form-group">
        <label for="name">Full Name *</label>
        <input type="text" id="name" name="name" placeholder="Your Name" required>
    </div>

    <div class="form-group">
        <label for="email">Email Address *</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" required>
    </div>

    <div class="form-group">
        <label for="phone">Phone Number *</label>
        <input type="tel" id="phone" name="phone" placeholder="+1234567890" required>
    </div>
</div>

<div class="form-group">
    <label>Donation Amount *</label>
    <div class="amount-options" id="amount-options"></div>
    <input type="number" id="amount" name="amount" placeholder="Enter custom amount" min="1" max="1000" required>
</div>

<div class="form-group">
    <label>
        <input type="checkbox" name="recurring"> Make this a monthly donation
    </label>
</div>

<button type="submit" class="btn-submit">Donate Now</button>
</form>
</div>

<script>
// Generate clickable donation buttons
const amountOptionsContainer = document.getElementById('amount-options');
const amounts = [10,25,50,100,500,1000];
amounts.forEach(amount => {
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.textContent = `$${amount}`;
    btn.onclick = () => document.getElementById('amount').value = amount;
    amountOptionsContainer.appendChild(btn);
});
</script>

<?php include 'include/footer.php'; ?>
</body>
</html>