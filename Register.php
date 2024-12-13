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

   
    $name = $_POST['Name'];
    $password = $_POST['Password'];
    $email = $_POST['Email'];
    
   
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    @$db = new mysqli('localhost', 'root', '', 'events');

   
    if (mysqli_connect_errno()) {
       echo "<p>Error: Could not connect to database.<br/>
             Please try again later.</p>";
       exit;
    }

    
    $query = "INSERT INTO Users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);

    
    $stmt->bind_param('sss', $name, $email, $hashed_password);

    
    $stmt->execute();

    
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
