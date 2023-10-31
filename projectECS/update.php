<?php
include 'connect.php';

$uid = $_GET['updateid'];

$sql = "SELECT * from projectecs where uid=$uid";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$faculty = $row['faculty'];
$title = $row['title'];
$author = $row['author'];
$publisher = $row['publisher'];
$ledition = $row['ledition'];
$lyear = $row['lyear'];
$link = $row['link'];

if (isset($_POST['submit'])) {
    $faculty = $_POST['faculty'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $ledition = $_POST['ledition'];
    $lyear = $_POST['lyear'];
    $link = $_POST['link'];

    $sql = "UPDATE projectecs set uid=$uid, faculty='$faculty', title='$title', author='$author', publisher='$publisher', ledition='$ledition', lyear='$lyear', link='$link' where uid=$uid";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:display.php');
    } else {
        die(mysqli_error($con));
    }

}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Published Papers Portal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="display.php">Home<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="allDisplay.php">View All Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user.php">Admin</a>
                </li>
                <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>-->
            </ul>
        </div>
    </nav>
    <div class="container my-5">
        <form method="post">
            <div class="mb-3">
                <label>Faculty</label>
                <input type="text" class="form-control" placeholder="Enter faculty:" name="faculty" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Title</label>
                <input type="text" class="form-control" placeholder="Enter Title:" name="title" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Author</label>
                <input type="text" class="form-control" placeholder="Enter Author:" name="author" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Publisher</label>
                <input type="text" class="form-control" placeholder="Enter Publisher:" name="publisher"
                    autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Edition</label>
                <input type="text" class="form-control" placeholder="Enter edition:" name="ledition" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Year</label>
                <input type="text" class="form-control" placeholder="Enter publishing year:" name="lyear"
                    autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Link</label>
                <input type="text" class="form-control" placeholder="Enter link:" name="link" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>

</html>