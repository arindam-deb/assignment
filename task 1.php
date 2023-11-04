<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bussiness_project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT C.customer_id, C.name, C.email, C.location, COUNT(O.order_id) AS total_orders
          FROM Customers AS C
          LEFT JOIN Orders AS O ON C.customer_id = O.customer_id
          GROUP BY C.customer_id, C.name, C.email, C.location
          ORDER BY total_orders DESC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Customer ID</th><th>Name</th><th>Email</th><th>Location</th><th>Total Orders</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["customer_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["location"] . "</td>";
        echo "<td>" . $row["total_orders"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}

$conn->close();
?>
