<?php
session_start(); // Start the session to store message

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $ippsNumber = $_POST['ippsNumber'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $unit = $_POST['unit'];
    $makerereEmail = $_POST['makerereEmail'];
    $personalEmail = $_POST['personalEmail'];

    // Update query that does not touch the role column
    $sql = "UPDATE users 
            SET ippsNumber='$ippsNumber', firstName='$firstName', lastName='$lastName', unit='$unit', 
                makerereEmail='$makerereEmail', personalEmail='$personalEmail' 
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "User updated successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to update user.";
        $_SESSION['message_type'] = "error";
    }

    header("Location: viewUsers.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$conn->close();
?>

<html>
<head>
  <title>View Users</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: black;
}

a,
a:hover,
a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar {
    padding: 15px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    background-color: #000000;
}

.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px solid black;
    margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

.wrapper {
    display: flex;
    width: 100%;
    align-items: stretch;
}

#sidebar {
    min-width: 250px;
    max-width: 250px;
    background: #006400;
    color: #fff;
    transition: all 0.3s;
}

#sidebar.active {
    margin-left: -250px;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #006400;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #006400;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}

#sidebar ul li a:hover {
    color: #006400;
    background: #fff;
}

#sidebar ul li.active>a,
a[aria-expanded="true"] {
    color: #fff;
    background: #006400;
}

a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #006400;
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

.download {
    background: #006400;
    color: #ffffff;
}

a.article,
a.article:hover {
    background: #006400 !important;
    color: #fff !important;
}

/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */

#content {
    width: 100%;
    padding: 20px;
    min-height: 100vh;
    transition: all 0.3s;
}

/* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */

@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
    #sidebarCollapse span {
        display: none;
    }
}
.container-fluid{
  background-color: #000000;
}
  </style>

</head>
<body>
  <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
          <img src="makerere_logo-removebg-preview.png" class="mx-auto d-block" style="width:80px">
          <hr>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="adminDashboard.php"> <i class="fas fa-box"> </i> Dashboard</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-user-cog"></i> Administration
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="viewUsers.php"><i class="fas fa-user-edit"></i> View Users</a>
                    </li>
                    <li>
                        <a href="addAdmin.php"><i class="fas fa-users"></i> Add Admin</a>
                    </li>
                    <li>
                        <a href="uploadPayroll.php"><i class="fas fa-paper-plane"></i>Upload payroll</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="viewAdminSalaryDeductions.php"><i class="fas fa-money-bill-wave"></i> View Your Deductions</a>
            </li>
            <li>
                <form action="logout.php" method="POST">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i>Logout</button>
                </form>
                   <!-- <button class="btn btn-danger btn-rounded" onclick="confirmSignOut()">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </button>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Log out</a>-->
            </li>
        </ul>


    </nav>
        <!-- Page Content  -->
        <div id="content">

<nav class="navbar navbar-expand-lg navbar-light bg-black">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span></span>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <p style="text-align: left; font-size: 60px; padding-left: 30px; color: white;">Edit User</p>
        </div>
    </div>
</nav>
        <!-- Display Success or Failure Messages -->
        <?php
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            $message_type = $_SESSION['message_type'];

            if ($message_type == "success") {
                echo "<div class='alert alert-success'>$message</div>";
            } else {
                echo "<div class='alert alert-danger'>$message</div>";
            }

            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <h2>Edit User</h2>
        <form method="POST" action="editUser.php">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="form-group">
                <label for="ippsNumber">IPPS Number</label>
                <input type="text" class="form-control" id="ippsNumber" name="ippsNumber" value="<?php echo $user['ippsNumber']; ?>" required>
            </div>
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $user['firstName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $user['lastName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="unit">Unit</label>
                <input type="text" class="form-control" id="unit" name="unit" value="<?php echo $user['unit']; ?>" required>
            </div>
            <div class="form-group">
                <label for="makerereEmail">Makerere Email</label>
                <input type="email" class="form-control" id="makerereEmail" name="makerereEmail" value="<?php echo $user['makerereEmail']; ?>" required>
            </div>
            <div class="form-group">
                <label for="personalEmail">Personal Email</label>
                <input type="email" class="form-control" id="personalEmail" name="personalEmail" value="<?php echo $user['personalEmail']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script>
                  $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
</script>
</body>
</html>
