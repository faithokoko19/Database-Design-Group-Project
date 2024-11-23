<?php
if (!isset($_POST['event_id'], $_POST['name'], $_POST['email'], $_POST['payment_method'])) {
    echo "<p>Error: Missing required fields.</p>";
    exit;
}

$event_id = $_POST['event_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$payment_method = $_POST['payment_method'];

// Simulate payment processing 
$payment_status = 'Pending'; // All of our payments will be successful because we do not have real credit cards

// If payments are successful:
if ($payment_method == 'credit_card' || $payment_method == 'paypal') {
    $payment_status = 'Completed';
}

// Connect to the database
@$db = new mysqli('localhost', 'root', 'Faysudi@1', 'events');

if (mysqli_connect_errno()) {
    echo "<p>Error: Could not connect to database.<br/>
            Please try again later.</p>";
    exit;
}

// Insert the registration data into the registrations table
$query = "INSERT INTO registrations (user_name, user_email, event_id, payment_status) VALUES (?, ?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param('ssis', $name, $email, $event_id, $payment_status);
$stmt->execute();

// Check if the insertion was successful
if ($stmt->affected_rows > 0) {
    echo "<p>Registration successful! Your payment status is: " . $payment_status . "</p>";
} else {
    echo "<p>An error occurred. Registration failed.</p>";
}

$db->close();
?>
