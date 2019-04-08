<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="A social media platform">
  <meta name="author" content="Daniel English - 14850842">

  <title>Home</title>

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

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <?php include 'sqlinfo.php' ?>
        
            <?php 
            $conn = @mysqli_connect($sql_host,
                                        $sql_user,
                                        $sql_pass,
                                        $sql_db
            );
            
            if (!$conn) {
                // Displays an error message, avoid using die() or exit() as this terminates the execution
                // of the PHP script
                echo "<p>Database connection failure</p>";
            } else {
                //Upon successfull completion
                // Get data from the form

                $form_post_code = $_POST["statusCode"];
              $form_post_text = $_POST["statusText"];
              $form_post_share = $_POST["share"];
              $form_post_sqlDate = date('Y-m-d', strtotime($_POST["post-date"]));
              $form_post_formatedDate = date("d-m-Y", strtotime($_POST["post-date"]));
              $form_post_like = $_POST['allowLike'];
              $form_post_comment = $_POST['allowComment'];
              $form_post_allowShare = $_POST['allowShare'];

              $error_list = array();

              //Begin checking for input data legitimacy
              //If nothing has been entered in the code or text field
              if(($form_post_code == null) || ($form_post_text == null)){
                // echo "<p>enter something</p>";
                array_push($error_list, 'Null fields');
              }  else {

                //Check if code portion is valid according to rules set out
                if (strlen($form_post_code) != 5){ //Length of 5
                  array_push($error_list, 'Code length invalid');
                } if ($form_post_code[0] != 'S'){ //First element is a S
                  array_push($error_list, 'First letter of code must be S');
                } if (!(is_numeric(substr($form_post_code,1,4)))){ //The remaining 4 are all numbers
                  array_push($error_list, 'S must be followed with 4 numbers');
                }

                //Check if Status portion is correct
                //Pattern for checking that correct characters have been added to the text
                $pattern = "/^[\w\s\!\?\.\,]+$/";
                if (!preg_match($pattern, $form_post_text)) {
                  array_push($error_list, 'Invalid characters in status text');
                }
              }
              
              //If there have been no errors then contine on to sql queries
              if (empty($error_list)){

                $sqlString = "Insert into post (code,text,date,permissions,share) 
                              Values ('$form_post_code','$form_post_text','$form_post_sqlDate','$form_post_like,$form_post_comment,$form_post_allowShare','$form_post_share');";

                $queryResult = @mysqli_query($conn, $sqlString);

                //Check if the resulting query contains anything (true if it does, false if it doesnt)
                if($queryResult){
                  echo "<p>Successfully updated " . mysqli_affected_rows($conn) . " record(s).</p>";
                } else { //Create the table as its not created
                  echo "<p>Database Table needed to be created, click back to go back to the form.</p>";
                  $createTableString = "CREATE TABLE `post` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `code` VARCHAR(5) NOT NULL,
                    `text` VARCHAR(255) NOT NULL,
                    `date` DATE NOT NULL,
                    `permissions` VARCHAR(255) NULL DEFAULT NULL,
                    `share` VARCHAR(255) NULL DEFAULT NULL,
                    PRIMARY KEY (`code`),
                    UNIQUE INDEX `id` (`id`)
                  )
                  COMMENT='A social media post'
                  COLLATE='utf8_general_ci'
                  ENGINE=InnoDB
                  AUTO_INCREMENT=1;";
                  $createTableQuery = @mysqli_query($conn,$createTableString);
                  ?>
                  <p><a href="javascript:history.go(-1)">Back</a></p>
                  <?php
                }

              } else { //Display error list
                var_dump($error_list);
              }
            }
        ?>
        <a href="index.html">Return home</a>
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
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <a href="searchstatusform.html"><button class="btn btn-secondary" type="button">Go!</button></a>
              </span>
            </div>
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