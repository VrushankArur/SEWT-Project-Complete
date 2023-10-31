<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Published Papers Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="jquery-3.7.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body style="background-image: url('background.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

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
                <li class="nav-item">
                    <a class="nav-link" href="login.php">login</a>
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
    <div class="container pt-5">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search..." id="live_search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>
    <div class="container pt-5" id="searchresult"></div>

    <script type="text/javascript">

        $(document).ready(function () {
            $("body").fadeIn("slow");

            $("#live_search").keyup(function () {

                var input = $(this).val();
                //alert(input);

                if (input != "") {
                    $.ajax({

                        url: "livesearch.php",
                        method: "POST",
                        data: { input: input },

                        success: function (data) {
                            $("#searchresult").html(data);
                        }
                    })
                }
            });
        });
    </script>

    <script>
        function toggleBibtex(uid) {
            var bibtexDiv = document.getElementById('bibtex-' + uid);
            if (bibtexDiv.style.display === 'none') {
                bibtexDiv.style.display = 'block';
            } else {
                bibtexDiv.style.display = 'none';
            }
        }

        function toggleHarvard(uid) {
            var harvardDiv = document.getElementById('harvard-' + uid);
            if (harvardDiv.style.display === 'none') {
                harvardDiv.style.display = 'block';
            } else {
                harvardDiv.style.display = 'none';
            }
        }

        function toggleAPA(uid) {
            var apaDiv = document.getElementById('apa-' + uid);
            if (apaDiv.style.display === 'none') {
                apaDiv.style.display = 'block';
            } else {
                apaDiv.style.display = 'none';
            }
        }
    </script>

</body>

</html>