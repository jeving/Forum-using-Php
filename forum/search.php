<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      #maincontainer{
        min-height:500px;
      }
    </style>
    <title>Forums</title>
  </head>
  <body>
  <?php include'partials/_dbconnect.php' ?>
  <?php include'partials/_header.php' ?>

 
<!-- Search Result-->
<div class="container my-2" id="maincontainer">

    <h2 class="my-2">Search result for <em> "<?php  echo $_GET['search'];  ?>" </em></h2>
    <?php
    $noResult = true;
      $query = $_GET["search"]; 
      $sql = "SELECT * FROM threads where MATCH (thread_title,thread_description) against('$query')";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
        $description = $row['thread_description'];
        $thread_id = $row['thread_id'];
        $url = "thread.php?threadid=" . $thread_id;
        $noResult = false;
        
        // Display Search Result
        echo '<div class="result">
                <h3><a href="'. $url .'" class="text-dark">'. $title   .'</a></h3>
                <p>'. $description .'</p>
                </div>';
        }  
      if($noResult){
        echo'<div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h1 class="display-6">No Result Found</h1>
                <p class="lead">Make sure you enter proper word or santence.</p>
              </div>
            </div>';
      }
      ?>
    
</div>

  <?php include'partials/_footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>