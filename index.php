<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
        <title>Crawler</title>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <!-- Custom CSS -->
        <link href="css/helper.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body class="fix-header fix-sidebar">
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <div id="main-wrapper">
            <div class="header">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <!-- Logo -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.html">
                            <b><img src="" alt="Test Crawler" class="" /></b>
                        </a>
                    </div>

                </nav>
            </div>
            <!-- End header header -->
            <div>
                <!-- Container fluid  -->
                <div class="container-fluid">
                    <!-- Start Page Content -->

                    <div class="row">
                        <!-- /# column -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h5>Enter URL Here</h5>
                                </div>
                                <form method="post" action="index.php">
                                    <div class="card-body">
                                        <div class="input-group input-group-rounded">
                                            <input type="text" placeholder="Start Crawl" name="target" class="form-control">
                                            <span class="input-group-btn"><button type="submit" class="btn btn-primary btn-group-right" name="crawl" value="Submit"><i class="fas fa-search"></i></button></span>
                                        </div>                                    
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h5>Tags </h5>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Keyword</th>
                                                    <th>Meta Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include_once('simple_html_dom.php');
                                                $html = new simple_html_dom();
                                                if (isset($_POST['crawl'])) {
                                                    $crawl = $_POST['target'];
                                                    $find = "https://";
                                                    if (strpos($crawl, $find) !== false) {
                                                        $html->load_file($crawl);
                                                        foreach ($html->find('title') as $title) {
                                                            foreach ($html->find('meta[name="keywords"]') as $keywords) {
                                                                foreach ($html->find('meta[property="og:description"]') as $description) {
                                                                    echo "</tr>";
                                                                    if ((strpos($title, "$crawl") !== false) || (strpos($keywords, "$crawl") !== false) || (strpos($description, "$crawl") !== false)) {
                                                                        echo "<td>";
                                                                        echo $title->plaintext;
                                                                        echo "</td>";
                                                                        echo "<td>";
                                                                        echo $keywords->content;
                                                                        echo "</td>";
                                                                        echo "<td>";
                                                                        echo $description->content;
                                                                        echo "</td>";
                                                                    } else if ((strpos($title, "http://") !== false) || (strpos($keywords, "https://") !== false) || (strpos($description, "https://") !== false)) {
                                                                        echo "<td>";
                                                                        echo $title->plaintext;
                                                                        echo "</td>";
                                                                        echo "<td>";
                                                                        echo $keywords->content;
                                                                        echo "</td>";
                                                                        echo "<td>";
                                                                        echo $description->content;
                                                                        echo "</td>";
                                                                    } else {
                                                                        echo "<td>";
                                                                        echo $title->plaintext;
                                                                        echo "</td>";
                                                                        echo "<td>";
                                                                        echo $keywords->content;
                                                                        echo "</td>";
                                                                        echo "<td>";
                                                                        echo $description->content;
                                                                        echo "</td>";
                                                                    }
                                                                    echo "</tr>";
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        echo '<div class="alert alert-warning alert-dismissable" id="flash-msg"><h4><i class="fas fa-exclamation-triangle"></i></i> Invalid URL! Enter HTTPS instead of HTTP...</h4></div>';
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /# card |<span class="badge badge-primary">Sale</span> | class="color-primary"-->
                        </div>
                        <!-- /# column -->

                        <!-- /# column -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h5>Crawled Urls </h5>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <th>Url</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include_once('simple_html_dom.php');
                                                $html = new simple_html_dom();
                                                if (isset($_POST['crawl'])) {
                                                    $crawl = $_POST['target'];
                                                    $find = "https://";
                                                    if (strpos($crawl, $find) !== false) {
                                                        $html->load_file($crawl);
                                                        foreach ($html->find('a') as $link) {
                                                            echo "</tr>";
                                                            if (strpos($link, "$crawl") !== false) {
                                                                echo "<td>";
                                                                echo "<p class='links'>" . $link->href . "</p>";
                                                                echo "</td>";
                                                            } else if (strpos($link, "http://") !== false || strpos($link, "https://") !== false) {
                                                                echo "<td>";
                                                                echo "<p class='links'>" . $link->href . "</p>";
                                                                echo "</td>";
                                                            } else {
                                                                echo "<td>";
                                                                echo "<p class='links'>" . "$crawl/" . $link->href . "</p>";
                                                                echo "</td>";
                                                            }
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "Invalid URL!";
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer"> © 2019 All rights reserved. <a href="">Crawler</a></footer>
            </div>
            <!-- End Page wrapper  -->
        </div>
        <!-- End Wrapper -->
        <!-- All Jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script src="js/jquery/jquery.min.js"></script>
        <script src="js/custom.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#flash-msg").delay(3000).fadeOut("slow");
            });
        </script>
    </body>

</html>




