<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it's not already started
}

// Set session timeout (in seconds)
$timeout_duration = 600; // 10 minutes

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration)) {
    session_unset(); // Unset session variables
    session_destroy(); // Destroy session
    header("Location: index.php"); // Redirect to login page
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it's not already started
}

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect non-admins to login
    exit();
}
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it's not already started
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Admin</title>
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
                <a href="dashboard.php"> <i class="fas fa-box"> </i> Dashboard</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-user-cog"></i> Administration
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="editUserProfile.php"><i class="fas fa-user-edit"></i> View Users</a>
                    </li>
                    <li>
                        <a href="viewUsers.php"><i class="fas fa-users"></i> Add Admin</a>
                    </li>
                    <li>
                        <a href="sendToAll.php"><i class="fas fa-paper-plane"></i>Upload payroll</a>
                    </li>
                </ul>
            </li>
            <li class="active">
                <a href="viewSalaryDeductions.php"><i class="fas fa-money-bill-wave"></i> View Your Deductions</a>
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
                  <p style="text-align: left; font-size: 60px; padding-left: 30px; color: white;"><span id="firstName">Loading...</span></p>
                    <ul class="nav navbar-nav ml-auto">

                        <ul class="list-unstyled CTAs">
                          <li>
                              <button class="btn btn-success btn-rounded">Edit Profile</button>
                          </li>
                      </ul>
                    </ul>
                </div>
            </div>
        </nav>
        <p><strong><b>IPPS NO: </b></strong> <span id="ippsNo">Loading...</span></p>
        <p><strong><b>Unit: </b></strong> <span id="unit">Loading...</span></p>
        <p><strong><b>Makerere Email: </b></strong> <span id="makerereEmail">Loading...</span></p>
        <p><strong><b>Personal Email: </b></strong> <span id="personalEmail">Loading...</span></p>

        <div class="line"></div>

        <h2>Request for PaySlip:</h2>
        <div class="form-group">
            <label for="monthSelect">Select Month</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Month
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="selectMonth('January')">January</a>
                        <a class="dropdown-item" href="#" onclick="selectMonth('February')">February</a>
                        <a class="dropdown-item" href="#" onclick="selectMonth('March')">March</a>
                        <a class="dropdown-item" href="#" onclick="selectMonth('April')">April</a>
                        <a class="dropdown-item" href="#" onclick="selectMonth('May')">May</a>
                        <a class="dropdown-item" href="#" onclick="selectMonth('June')">June</a>
                        <a class="dropdown-item" href="#" onclick="selectMonth('July')">July</a>
                        <a class="dropdown-item" href="#" onclick="selectMonth('August')">August</a>
                        <a class="dropdown-item" href="#" onclick="selectMonth('September')">September</a>
                        <a class="dropdown-item" href="#" onclick="selectMonth('October')">October</a>
                        <a class="dropdown-item" href="#" onclick="selectMonth('November')">November</a>
                        <a class="dropdown-item" href="#" onclick="selectMonth('December')">December</a>
                    </div>
                </div>
                <input type="text" class="form-control" id="monthSelect" placeholder="Select a month" readonly>
            </div>
            <label for="yearSelect">Select Year</label>
        <div class="input-group">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Select Year
            </button>
            <div class="dropdown-menu" id="yearDropdown">
                <!-- Years will be generated here dynamically -->
            </div>
        </div>
        <input type="text" class="form-control" id="yearSelect" placeholder="Select a year" readonly>
    </div>
        </div>
        <div class="d-flex justify-content-between">
    <ul class="list-unstyled CTAs m-0">
        <li>
            <form action="#" method="POST">
                <button type="submit" class="btn btn-success"></i>Send to Email</button>
            </form>
        </li>
    </ul>
    <ul class="list-unstyled CTAs m-0">
        <li>
            <button class="btn btn-success btn-rounded">Download</button>
        </li>
    </ul>
</div>
    </div>
</div>
<script>
     $(document).ready(function () {
        // Send to email functionality
        $(".btn.btn-success").click(function() {
            // Get the email address from the page (assumed to be loaded from the backend)
            let userEmail = $("#makerereEmail").text();

            // Send an AJAX POST request to send the email
            $.ajax({
                url: "sendEmail.php",
                method: "POST",
                data: { email: userEmail },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        alert("Email sent successfully!");
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error sending email:", error);
                    alert("An error occurred while sending the email.");
                }
            });
        });
    });
    function selectMonth(month) {
    document.getElementById("monthSelect").value = month;
    }
  $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
          // Get the dropdown container
    let yearDropdown = document.getElementById("yearDropdown");
    
    // Generate years from 2000 to 2050 dynamically
    for (let year = 2013; year <= 2050; year++) {
        let yearItem = document.createElement("a");
        yearItem.classList.add("dropdown-item");
        yearItem.href = "#";
        yearItem.textContent = year;
        yearItem.onclick = function () {
            document.getElementById("yearSelect").value = year;
        };
        yearDropdown.appendChild(yearItem);
    }
    $(document).ready(function () {
    // Fetch dashboard data from the server
    $.ajax({
        url: "fetchDashboardData.php",
        method: "GET",
        dataType: "json",
        success: function (response) {
            if (response) {
                $("#ippsNo").text(response.ippsNumber);
                $("#unit").text(response.unit);
                $("#makerereEmail").text(response.makerereEmail);
                $("#personalEmail").text(response.personalEmail);
                $("#firstName").text(response.firstName);
            } else {
                console.log("No data received.");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching data:", error);
        }
    });
});
</script>
</body>
</html>