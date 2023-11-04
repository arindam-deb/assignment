<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "bussiness_project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT O.order_id, P.name AS product_name, OI.quantity, OI.unit_price * OI.quantity AS total_amount
          FROM Order_Items AS OI
          JOIN Products AS P ON OI.product_id = P.product_id
          JOIN Orders AS O ON OI.order_id = O.order_id
          ORDER BY O.order_id ASC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Order ID</th><th>Product Name</th><th>Quantity</th><th>Total Amount</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["order_id"] . "</td>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["total_amount"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}

$conn->close();
?>
