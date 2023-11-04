<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bussiness_project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT C.name AS customer_name, SUM(OI.unit_price * OI.quantity) AS total_purchase_amount
          FROM Customers AS C
          JOIN Orders AS O ON C.customer_id = O.customer_id
          JOIN Order_Items AS OI ON O.order_id = OI.order_id
          GROUP BY C.customer_id, C.name
          ORDER BY total_purchase_amount DESC
          LIMIT 5";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Customer Name</th><th>Total Purchase Amount</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["customer_name"] . "</td>";
        echo "<td>" . $row["total_purchase_amount"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}

$conn->close();
?>
