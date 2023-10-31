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
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">SI no.</th>
                        <th scope="col">Faculty</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Edition</th>
                        <th scope="col">Year</th>
                        <th scope="col">Link</th>
                        <th scope="col">BibTeX Citation</th>
                        <th scope="col">Actions</th>
                        <th scope="col">Harvard Citation</th>
                        <th scope="col">APA Citation</th>
                        <th scope="col">IEEE Citation</th> <!-- Add IEEE column -->
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT * FROM `projectecs`";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $uid = $row['uid'];
                            $faculty = $row['faculty'];
                            $title = $row['title'];
                            $author = $row['author'];
                            $publisher = $row['publisher'];
                            $ledition = $row['ledition'];
                            $lyear = $row['lyear'];
                            $link = $row['link'];

                            // Generate BibTeX citation
                            $bibtexCitation = "@book{" . $uid . ",
                                title={" . $title . "},
                                author={" . $author . "},
                                publisher={" . $publisher . "},
                                edition={" . $ledition . "},
                                year={" . $lyear . "},
                                link={" . $link . "}
                            }";

                            // Generate Harvard citation
                            $harvardCitation = $author . ' ' . substr($lyear, 2) . ', ‘' . $title . '’, <i>' . $publisher . '</i>, vol. ' . $ledition;

                            // Generate APA citation
                            $apaCitation = $author . ' (' . $lyear . '). ' . $title . '. ' . $publisher . '.';

                            // Generate IEEE citation
                            $ieeeCitation = $author . '. ' . $title . ',” in, ' . $ledition .  ', Ed. ' . $publisher . ', ' . $lyear;

                            // Display the data in the table
                            echo '
                            <tr>
                                <th scope="row">' . $uid . '</th>
                                <td>' . $faculty . '</td>
                                <td>' . $title . '</td>
                                <td>' . $author . '</td>
                                <td>' . $publisher . '</td>
                                <td>' . $ledition . '</td>
                                <td>' . $lyear . '</td>
                                <td><a href="' . $link . '" target="_blank">' . $link . '</a></td>
                                <td><div id="bibtex-' . $uid . '" style="display: none;">' . $bibtexCitation . '</div></td>
                                <td>
                                    <button class="btn btn-outline-primary" onclick="toggleBibtex(' . $uid . ')">BibTeX</button>
                                    <button class="btn btn-outline-primary" onclick="toggleHarvard(' . $uid . ')">Harvard</button>
                                    <button class="btn btn-outline-primary" onclick="toggleAPA(' . $uid . ')">APA</button>
                                    <a href="update.php?updateid=' . $uid . '" class="btn btn-outline-primary">Admin Update</a>
                                    <button class="btn btn-outline-primary" onclick="toggleIEEE(' . $uid . ')">IEEE</button> <!-- Add IEEE button -->
                                </td>
                                <td><div id="harvard-' . $uid . '" style="display: none;">' . $harvardCitation . '</div></td>
                                <td><div id="apa-' . $uid . '" style="display: none;">' . $apaCitation . '</div></td>
                                <td><div id="ieee-' . $uid . '" style="display: none;">' . $ieeeCitation . '</div></td> <!-- Add IEEE div -->
                            </tr>';
                        }
                    }

                    ?>

                </tbody>
            </table>
        </div>
    </div>
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
        function toggleIEEE(uid) {
            var ieeeDiv = document.getElementById('ieee-' + uid);
            if (ieeeDiv.style.display === 'none') {
                ieeeDiv.style.display = 'block';
            } else {
                ieeeDiv.style.display = 'none';
            }
        }
    </script>
</body>

</html>
