<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bussiness_project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT C.name AS category_name, SUM(OI.unit_price * OI.quantity) AS total_revenue
          FROM Categories AS C
          JOIN Products AS P ON C.category_id = P.category_id
          JOIN Order_Items AS OI ON P.product_id = OI.product_id
          GROUP BY C.name
          ORDER BY total_revenue DESC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Category Name</th><th>Total Revenue</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["category_name"] . "</td>";
        echo "<td>" . $row["total_revenue"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}

$conn->close();
?>
