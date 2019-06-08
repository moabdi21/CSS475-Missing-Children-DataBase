<?php
/**
 * Created by PhpStorm.
 * User: moabdi21@uw.edu
 * Date: 6/8/2019
 * Time: 2:30 PM
*/
require_once 'config.inc.php';

?>
<html>
<head>
    <link rel="stylesheet" href="base.css">
</head>
<body>
<?php
require_once 'header.inc.php';
?>
<div>
    <h2>Missing Children List</h2>
    <?php
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $port);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	// Prepare SQL Statement
    $sql = "SELECT missingChildNo, firstName, lastName FROM MissingChild ORDER BY lastName";
    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        echo "failed to prepare";
    }
    else {
		
		// Execute the Statement
        $stmt->execute();
		
		// Loop Through Result
        $stmt->bind_result($missingChildNo,$firstName,$lastName);
        echo "<ul>";
        while ($stmt->fetch()) {
            echo '<li><a href="show_missing_child.php?id='  . $missingChildNo . '">' . $firstName . " ". $lastName . '</a></li>';
        }
        echo "</ul>";
    }
    
	// Close Connection
    $conn->close();
    
    ?>
</div>
</body>
</html>
