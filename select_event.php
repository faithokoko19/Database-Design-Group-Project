<?php
// Connect to the database
@$db = new mysqli('localhost', 'root', 'Faysudi@1', 'events');

if (mysqli_connect_errno()) {
    echo "<p>Error: Could not connect to database.<br/>
            Please try again later.</p>";
    exit;
}

// Fetch events from the events_list table
$query = "SELECT * FROM events_list";
$result = $db->query($query);

echo "<h1>Select an Event to Register</h1>";
echo "<form action='register_event.php' method='POST'>";
echo "<select name='event_id' required>";
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['event_id'] . "'>" . $row['name'] . "</option>";
}
echo "</select><br><br>";

echo "<input type='submit' value='Register'>";
echo "</form>";

$db->close();
?>
