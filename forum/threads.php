<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Forums</title>
  </head>
  <body>
  <?php include'partials/_dbconnect.php' ?>
  <?php include'partials/_header.php' ?>

  <?php
  $id = $_GET['catid'];
  $sql = "SELECT * FROM `categories` WHERE `category_id` =$id";
  $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($result)){
    $cat_name = $row['category_name'];
    $cat_description = $row['category_description'];
  }  
  ?>
<!-- $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `timestamp`)
VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp());"; -->

  <?php
  $showAlert = false;
  $method = $_SERVER['REQUEST_METHOD'];
  if($method == 'POST'){
      // insert into thread into db
      $th_title = $_POST['title'];
      $th_title = str_replace("<",  "&lt;" , $th_title );
      $th_title = str_replace(">", "&gt;", $th_title);

      $th_desc = $_POST['description'];
      $th_desc = str_replace("<",  "&lt;" , $th_desc );
      $th_desc = str_replace(">", "&gt;", $th_desc);

      $thread_id = $_POST['id'];

      
      
      $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `thread_time`) VALUES 
                                      (NULL, '$th_title', '$th_desc', '$id', '$thread_id', current_timestamp())";
      $result = mysqli_query($conn,$sql);
      $showAlert = true;
      if ($showAlert){
          echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Succes!</strong> Your is added.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
      }
  }
  
  ?>

<!-- Category Container Start here -->
  <div class="container my-3">
    <div class="jumbotron">
        <h1 class="display-4">Welcome to <?php echo  $cat_name ; ?> Forum</h1>
        <p class="lead"><?php  echo $cat_description; ?> </p>
        <hr class="my-4">
        <p> No Spam / Advertising / Self-promote in the forums.Do not post copyright-infringing material. Do not post “offensive” posts, links or images. 
            Do not cross post questions. Do not PM users asking for help. Remain respectful of other members at all times.
        </p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </p>
    </div>
  </div>
<?php
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo' <div class="container">
            <h1 class="py-2">Ask a Qusetions</h1>
            <form action="'. $_SERVER["REQUEST_URI"]  .'" method="POST">
                <div class="mb-3">
                    <label for="problem" class="form-label">Problem title</label>
                    <input type="text" class="form-control" name = "title" id="title" aria-describedby="emailHelp">
                </div>
                
                <div class="form-group">
                    <label for="textarea" > Ellaborate Your Concern</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <input type="hidden" name="id" value="'. $_SESSION['id'] .'">
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>';
  }
  else{
    echo'
    <div class="container">
      <h1 class="py-2">Ask a Qusetions</h1>
      <p class="lead"> log-in to start </p>
    </div>';
  }
?>
  <div class="container">
        <h1 class="py-2">Browse Qusetions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id =$id";
        $result =mysqli_query($conn,$sql);
        $noResult = true; 
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false; 
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $description = $row['thread_description'];
            $time = $row['thread_time'];
            $thread_user_id = $row['thread_user_id'];

            $sql2 = "SELECT user_name FROM `users218` WHERE id='$thread_user_id'";
            $result2 =mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            

            
            echo '<div class="media my-3">
                    <img class="mr-3" src="img/user.png" width="54px" alt="Generic placeholder image">
                    <div class="media-body">'.
                        '<h5 class="mt-0"><a href="thread.php?threadid='. $id .'">'. $title .' </a></h5>
                        '. $description .'.                         
                    </div>'. '<p class="font-weight-bold my-0"> Asked by ' . $row2['user_name'] . ' at '. $time .' </p>'.'
                </div>';
        } 
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-6">No Result Found</h1>
              <p class="lead">Be the First Person to Ask.</p>
            </div>
          </div>';
        } 
        ?>
  </div>
  
  <!-- https://source.unsplash.com/500x400/?ride,water -->
  <?php include'partials/_footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>