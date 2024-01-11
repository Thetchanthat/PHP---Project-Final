<?php 
    include('function.php');
    // echo $_SESSION['user'];
    if(empty($_SESSION['user'])){
        header('location:login.php');
    }
    $id = $_SESSION['user'];

    $sql = "SELECT * FROM `tbl_user` WHERE `id` = '$id'";
    $rs = Connection()->query($sql);
    $row = mysqli_fetch_assoc($rs);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- @theme style -->
    <link rel="stylesheet" href="assets/style/theme.css">

    <!-- @Bootstrap -->
    <link rel="stylesheet" href="assets/style/bootstrap.css">

    <!-- @script -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <!-- @tinyACE -->
    <script src="https://cdn.tiny.cloud/1/5gqcgv8u6c8ejg1eg27ziagpv8d8uricc4gc9rhkbasi2nc4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<body>


    <main class="admin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <div class="content-left">
                        <div class="wrap-top">
                            <img src="assets/icon/admin-logo.png" alt="">
                            <h5>Jong Deng News</h5>
                        </div>
                        <div class="wrap-center">
                            <img src="./assets/Profile/<?php echo $row['profile']; ?>" width="30px" height="30px" alt="">
                            <h6>Welcome Admin <?php echo $row['username']; ?></h6>
                        </div>
                        <div class="wrap-bottom">
                            <ul>
                                <a class="parent" href="javascript:void(0)">
                                    <span​​ class="text-danger">MAIN MENU</span​​>
                                    <!-- <img src="assets/icon/arrow.png" alt=""> -->
                                </a>
                            <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>LOGO</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="view-logo.php">View Logo</a>
                                            <a href="add-logo.php">Add New</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>News</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="add-news.php">Add News</a>
                                            <a href="view-news.php">View News</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Feedback</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="view-feedback.php">View Feedback</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Follow US</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="add-follow-us.php">Add Follow Us </a>
                                            <a href="view-follow-us.php">View Follow Us</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>About US</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="add-about_us.php">Add About Us </a>
                                            <a href="view-about-us.php">View About Us</a>
                                        </li>
                                    </ul>
                                </li>
                               
                                <li class="parent">
                                    <a class="parent" href="logout.php">
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>