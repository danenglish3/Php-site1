<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Search Results</title>

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
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Database connection section-->
        <?php include 'sqlinfo.php' ?>
        <?php
            $conn = @mysqli_connect($sql_host,
            $sql_user,
            $sql_pass,
            $sql_db);       
            
            $search_term = $_GET['search'];

            if (!$conn) { // If connection fails
                echo "<p>Database connection failure</p>";
            } else {
                // If the connection is successfull, get the keyword to be searched for
                if ($search_term == NULL){
                    echo "<p>Searched for nothing</p>";
                } else {
                    //Create sql string using keyword
                    $sqlString = "Select * FROM post WHERE text LIKE '%$search_term%'
                    ORDER BY date;";

                    $queryResult = @mysqli_query($conn, $sqlString)
                    or die("<p>Unable to execute the query.</p>". "<p>Error code " . mysqli_errno($conn)
                    . ": " . mysqli_error($conn) . "</p>");
                    //Query for keyword
                    $returnedSqlResults = mysqli_fetch_assoc($queryResult);
                }
            }
            mysqli_close($con);            
        ?>
    
        <div class="row">

            <!-- Returned search column -->
            <div class="col-md-8">
                <h1 class="card-header">Status Information<br></h1>
                <div class="card-body">

                <!-- Loop through each returned post and create its own individual card
                     and post it to the page through html -->
                <?php while ($returnedSqlResults){?>

                   <!-- Returned Post card -->
                    <div class="card mb-4">
                    
                        <h2 class="card-header">Code: <?php echo $returnedSqlResults[code] ?></h2>
                        <div class="card-body">
                            <p class="card-text">Status: <?php echo $returnedSqlResults[text] ?></p><br>

                            <div class="radio-inline">
                                <label><p style="padding-right: 50px;">Sharing Options:</p></label>
                                <label class="radio-inline"><input type="radio" <?php echo $checked= 
                                    preg_match('/^Public/',$returnedSqlResults[share]) ? "checked" : "";?> disabled> Public</label>
                                <label class="radio-inline"><input type="radio" <?php echo $checked= 
                                    preg_match('/^Friends/',$returnedSqlResults[share]) ? "checked" : "";?> disabled> Friends</label>
                                <label class="radio-inline"><input type="radio" <?php echo $checked= 
                                    preg_match('/^Me/',$returnedSqlResults[share]) ? "checked" : "";?> disabled> Only me</label>
                            </div>

                            <div class="checkbox-inline">
                                <label><p style="padding-right: 28px;">Permission Options:</p></label>
                                <label><input type="checkbox" <?php echo $checked= preg_match('/like/',
                                    $returnedSqlResults[permissions]) ? "checked" : "";?> disabled> Allow Like</label>
                                <label><input type="checkbox" <?php echo $checked= preg_match('/comment/',
                                    $returnedSqlResults[permissions]) ? "checked" : "";?> disabled> Allow Comment</label>
                                <label><input type="checkbox" <?php echo $checked= preg_match('/share/',
                                    $returnedSqlResults[permissions]) ? "checked" : "";?> disabled > Allow Share</label>
                            </div>
                            </div>
                        <div class="card-footer text-muted">
                            Posted on <?php echo date("F j, Y", strtotime($returnedSqlResults[date])) ?>
                        </div>
                    </div>
                    <!-- /. Returned post card-->                    
                <?php $returnedSqlResults = mysqli_fetch_assoc($queryResult);}?>
                <!-- /. End of search results loop--> 
 

                    <div class="form-row">
                        <div class="form-col col-md-9">
                            <a href="searchstatusform.html"> Search for another status</a>
                        </div>
                        <div class="form-col">
                            <a href="index.html"> Return to homepage</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /. returned search column-->

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

                <!-- New Post Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Post a new Status</h5>
                    <div class="card-body">
                        <a href="poststatusform.php"><button class="btn btn-secondary" type="button">Post!</button></a>
                    </div>
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