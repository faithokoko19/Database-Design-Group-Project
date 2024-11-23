<!DOCTYPE html>
<html>
<head>
  <title>Registered Page</title>
</head>
<body>
  <h1>Registered Page Entry Results</h1>
  <?php

    if (!isset($_POST['Name']) || !isset($_POST['Password'])
         || !isset($_POST['Email'])) {
       echo "<p>You have not entered all the required details.<br />
             Please go back and try again.</p>";
       exit;
    }

    // Create short variable names
    $name = $_POST['Name'];
    $password = $_POST['Password'];
    $email = $_POST['Email'];
    
    // Hash the password for security before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Establish database connection
    @$db = new mysqli('localhost', 'root', 'Faysudi@1', 'events');

    // Check if the connection was successful
    if (mysqli_connect_errno()) {
       echo "<p>Error: Could not connect to database.<br/>
             Please try again later.</p>";
       exit;
    }

    // Prepare the SQL query with column names
    // Assuming columns in Users table: id (auto-increment), name, email, password
    $query = "INSERT INTO Users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);

    // Bind parameters: 'sss' means all parameters are strings
    $stmt->bind_param('sss', $name, $email, $hashed_password);

    // Execute the query
    $stmt->execute();

    // Check if the row was inserted
    if ($stmt->affected_rows > 0) {
        echo  "<p>User Registered into the database.</p>";
    } else {
        echo "<p>An error has occurred.<br/>
              The User was not Registered.</p>";
    }

    // Close the database connection
    $db->close();
  ?>
</body>
</html>