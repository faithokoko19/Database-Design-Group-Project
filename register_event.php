<?php
if (!isset($_POST['event_id'])) {
    echo "<p>Error: No event selected.</p>";
    exit;
}

$event_id = $_POST['event_id'];

// Connect to the database
@$db = new mysqli('localhost', 'root', 'Faysudi@1', 'events');

if (mysqli_connect_errno()) {
    echo "<p>Error: Could not connect to database.<br/>
            Please try again later.</p>";
    exit;
}

// Fetches event details from the events_list table
$query = "SELECT * FROM events_list WHERE event_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

// Display event details for confirmation
echo "<h1>Register for Event: " . $event['name'] . "</h1>";
echo "<p>Description: " . $event['description'] . "</p>";
echo "<p>Date: " . $event['event_date'] . "</p>";
echo "<p>Venue: " . $event['venue'] . "</p>";
echo "<p>Total Seats: " . $event['total_seats'] . "</p>";

echo "<h2>Enter Your Details</h2>";
?>

<form action="process_registration.php" method="POST">
    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
    <label for="name">Your Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Your Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <h3>Make Payment</h3>
    <p>Payment amount: $100</p> 

    <label for="payment_method">Payment Method:</label><br>
    <select id="payment_method" name="payment_method" required>
        <option value="credit_card">Credit Card</option>
        <option value="paypal">PayPal</option>
    </select><br><br>

    <input type="submit" value="Register and Pay">
</form>

<?php
$db->close();
?>