<!DOCTYPE html>
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
          <div class="line"></div>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="dashboard.html"> <i class="fas fa-box"> </i> Dashboard</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-user-cog"></i> Administration
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="viewUsers.html"><i class="fas fa-user-edit"></i> View Users</a>
                    </li>
                    <li>
                        <a href="addAdmin.html"><i class="fas fa-users"></i> Add Admin</a>
                    </li>
                    <li>
                        <a href="uploadPayroll.html"><i class="fas fa-paper-plane"></i>Upload payroll</a>
                    </li>
                </ul>
            </li>
            <li class="active">
                <a href="viewSalaryDeductions.html"><i class="fas fa-money-bill-wave"></i> View Your Deductions</a>
            </li>
            <li>
                <form action="logout.php" method="POST">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i>Logout</button>
                </form>
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
                  <p style="text-align: left; font-size: 60px; padding-left: 30px; color: white;">Payroll Users</p>
                </div>
            </div>
        </nav>
        <form method="POST" action="viewUsers.php">
    <div class="form-group">
        <input type="text" class="form-control" name="search" placeholder="Search by name..." required>
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </div>
    </form>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No</th>
                <th scope="col">IPPS Number</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Unit</th>
                <th scope="col">Makerere Email</th>
                <th scope="col">Personal Email</th>
                <th scope="col"><b>Actions</b></th>
              </tr>
            </thead>
            <tbody>
                <?php include 'fetchUsersData.php'; ?>
              </tbody>
          </table>
    </div>
</div>
</body>
</html>