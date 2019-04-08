<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>New Post</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Assignment 1 - Daniel English - 14850842</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="searchstatusform.html">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- New Post Column -->
            <div class="col-md-8">
                <br>
                <!-- New post form -->
                <div class="card mb-4">
                    <h1 class="card-header">Status Posting System<br></h1>
                    <div class="card-body">
                        <div class="form-group">
                            <form action="processpoststatuspage.php" method="POST">

                                <!-- Status Code row -->
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label>Status Code (required): </label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="statusCode">
                                    </div>
                                </div>

                                <!-- Status text row -->
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label>Status (required):</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="statusText" style="width: 400px;">
                                    </div>
                                </div>

                                <!-- Who to share it with row -->
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label>Share: </label>
                                    </div>
                                    <div class="form-col-md-4">
                                        <label class="radio-inline"><input type="radio" name="share" value="Public"> Public</label>
                                        <label class="radio-inline"><input type="radio" name="share" value="Friends"> Friends</label>
                                        <label class="radio-inline"><input type="radio" name="share" value="Me"> Only me</label>
                                    </div>
                                </div>

                                <!-- Date row -->
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label>Date (dd/mm/yyyy)</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" id="post-date" name="post-date" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>

                                <!-- Permissions row -->
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label>Permission Type: </label>
                                    </div>
                                    <div class="checkbox-inline">
                                        <label><input type="checkbox" name="allowLike" value="like"> Allow Like</label>
                                        <label><input type="checkbox" name="allowComment" value="comment"> Allow
                                            Comment</label>
                                        <label><input type="checkbox" name="allowShare" value="share"> Allow
                                            Share</label>
                                    </div>
                                </div>

                                <!-- Final buttons row-->
                                <div class="form-row">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <input type="submit" class="btn btn-secondary" value="Post!">
                                            <a href="poststatusform.html"><button class="btn btn-secondary"
                                                    type="button">Reset!</button></a>
                                        </span>
                                        <br></br><br></br>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="form-row">
                            <a href="index.html">Return to homepage</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">My Information</h5>
                    <div class="card-body">
                        Name: Daniel English <br>
                        Student ID: 14850842 <br>
                        Email: mps0494@autuni.ac.nz
                    </div>
                </div>

                <!-- Search Widget -->
                <div class="card my-4">
                    <form action="searchstatusprocess.php" method="GET">
                        <h5 class="card-header">Search</h5>
                        <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for..." name="search">
                            <span class="input-group-btn">
                            <input type="submit" class="btn btn-secondary" value="search">
                            </span>
                        </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Daniel English - 14850842</p>
        </div>
        <!-- /.container -->
    </footer>

</body>

</html>