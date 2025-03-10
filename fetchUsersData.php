<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "payslipproject"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set pagination variables
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure page number is at least 1
$offset = ($page - 1) * $limit;

// Search functionality
$searchQuery = "";
if (isset($_POST['search'])) {
    $searchQuery = $conn->real_escape_string($_POST['search']);
}

// Query to fetch data with pagination and search
$sql = "SELECT id, ippsNumber, firstName, lastName, unit, makerereEmail, personalEmail 
        FROM users 
        WHERE firstName LIKE '%$searchQuery%' OR lastName LIKE '%$searchQuery%'
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

// Display fetched data
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ippsNumber']) . "</td>";
        echo "<td>" . htmlspecialchars($row['firstName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['lastName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['unit']) . "</td>";
        echo "<td>" . htmlspecialchars($row['makerereEmail']) . "</td>";
        echo "<td>" . htmlspecialchars($row['personalEmail']) . "</td>";
        echo "<td><a href='editUser.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning'>Edit</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No records found</td></tr>";
}

// Pagination logic
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM users WHERE firstName LIKE '%$searchQuery%' OR lastName LIKE '%$searchQuery%'";
$totalResult = $conn->query($totalRecordsQuery);
$totalRow = $totalResult->fetch_assoc();
$totalPages = ceil($totalRow['total'] / $limit);

echo '<nav><ul class="pagination">';
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<li class='page-item'><a class='page-link' href='viewUsers.php?page=$i'>$i</a></li>";
}
echo '</ul></nav>';

$conn->close();
?>
