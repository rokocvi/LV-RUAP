<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style type="text/css">
        body {
            background-color: #fff;
            border-top: solid 10px #000;
            color: #333;
            font-size: .85em;
            margin: 20px;
            padding: 20px;
            font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
        }
        h1, h2, h3 {
            color: #000;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        h1 { font-size: 2em; }
        h2 { font-size: 1.75em; }
        h3 { font-size: 1.2em; }
        table {
            margin-top: 0.75em;
            border-collapse: collapse;
        }
        th {
            font-size: 1.2em;
            text-align: left;
            padding-right: 20px;
        }
        td {
            padding: 5px 20px 5px 0;
        }
    </style>
</head>

<body>

<h1>Regggfnbghister here!</h1>
<p>Fill in your name and email address, then click <strong>Submit</strong> to register.</p>

<form method="post" action="">
    Name:<br>
    <input type="text" name="name" id="name" required><br><br>

    Email:<br>
    <input type="email" name="email" id="email" required><br><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php
// ===============================
// DB CONNECTION INFO (TODO DONE)
// ===============================
$host = "ruapdbserver.mysql.database.azure.com";
$user = "ruapUser@ruapdbserver";
$pwd  = "Ruap1234";
$db   = "ruapdb";

// Connect to database
$conn = mysqli_connect($host, $user, $pwd, $db);

// Check connection
if (!$conn) {
    die("<h3>Failed to connect to MySQL:</h3> " . mysqli_connect_error());
}

// ===============================
// INSERT DATA
// ===============================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $date  = date("Y-m-d");

    $sql_insert = "INSERT INTO registration_tbl (name, email, date)
                   VALUES ('$name', '$email', '$date')";

    if (mysqli_query($conn, $sql_insert)) {
        echo "<h3>You're registered!</h3>";
    } else {
        echo "<h3>Error:</h3> " . mysqli_error($conn);
    }
}

// ===============================
// SELECT & DISPLAY DATA
// ===============================
$sql_select = "SELECT * FROM registration_tbl";
$result = mysqli_query($conn, $sql_select);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>People who are registered:</h2>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Email</th><th>Date</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<h3>No one is currently registered.</h3>";
}

// Close connection
mysqli_close($conn);
?>

</body>
</html>

