<?php
  //connection to database
  include('connect.php');
  $query="SELECT CONCAT(title,' ','(',year,')') AS MovieName, id FROM Movie;";
  $rsmovie = $db->query($query);
  //Basic error handling
  if(!$rsmovie){
    $errmsg = $db->error;
    print "Query failed: $errmsg <br />";
    exit(1);
  }
  //close connection
  $db->close();
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
    margin: 0;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 25%;
    background-color: #f1f1f1;
    position: fixed;
    height: 100%;
    overflow: auto;
}

ul b {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}

li a.active {
    background-color: #4CAF50;
    color: white;
}

li a:hover:not(.active) {
    background-color: #555;
    color: white;
}
</style>
<body>

  <ul>
    <li><a class="active" href="addAnActor.php">Main Page</a></li>
    <li><a href="addAnActor.php">Add New Actor/Director</a></li>
    <li><a href="addAMovie.php">Add Movie </a></li>
    <li><a href="addMARelation.php">Add Movie/Actor Relation </a></li>
    <li><a href="addMDRelation.php">Add Movie/Director Relation </a></li>
    <li><a href="addComments.php">Add Comment</a></li>
    <li><a href="searchActor.php">Search Actor</a></li>
    <li><a href="searchMovie.php">Search Movie</a></li>
  </ul>

<div style="margin-left:25%;padding:1px 16px;height:1000px;">
<h1>Add a comment to a movie</h1>
<br>Give a Movie's name and a comment in the following boxes:
<br>
<br> <br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <div class="form-group">
                <label for="movieName">Movie Title:</label>
                <select class="form-control" name="movieName">
                    <option value=""> </option>
                    <?php
                      if($rsmovie->num_rows>0){
                        while($row = $rsmovie->fetch_assoc()){
                    ?>
                    <option value = <?php echo $row["id"] ?>> <?php echo $row["MovieName"] ?></option>
                    <?php   }
                      }else{
                    ?>
                      <option>None</option>
                    <?php
                      }
                    ?>
                </select>
                <br>
                <label for="rating">Rating:</label>
                <select name='rating'>
     <option value=1>1</option>
     <option value=2>2</option>
     <option value=3>3</option>
     <option value=3>4</option>
     <option value=3>5</option>
     </select>
     </div>
Comment:<br>
<textarea name="comment" cols="60" rows="8" style="margin: 0px; width: 590px; height: 269px;"></textarea>
<br>
Reviwer Name: <input type="text" name="name"> <br>
<br><input type="submit">
</form>


<?php
/*
  )
  {
    $title = $_REQUEST['title'];
    $comment = $_REQUEST['comment'];

    //Connect PHP code with SQL
    $db = new mysqli('localhost', 'cs143', '', 'TEST');
    if($db->connect_errno > 0)
    {
      die('Unable to connect to database [' . $db->connect_error . ']');
    }


    if(mysqli_query($db,"INSERT INTO Director (id,last, first, dob, dod) VALUES ($MaxDirectorID+1,'$firstName', '$lastName', '$dob', '$dod');"))
    {
      mysqli_query($db,"INSERT INTO MaxPersonID(id) VALUES ($MaxDirectorID+1);");
       echo "Successfully added!";
    }else{
      echo "No insert happened!";c
    }

  }
*/

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    $movieId = $_REQUEST['movieName'];
                    $rating = $_REQUEST['rating'];
                    $comment = $_REQUEST['comment'];
                    $name = $_REQUEST['name'];
                    //connection to database
                    $db = new mysqli('localhost', 'cs143', '', 'CS143');
                    if($db->connect_errno > 0){
                      die('Unable to connect to database [' . $db->connect_error . ']');
                    }
                    //echo $movieName;
                    //echo $comment;
                    //echo "ACCC";
                    //echo $movieName;
                    echo "<br>";
                    //$name = 'AlexTest';

                    $query= "INSERT INTO Review(name, mid, rating, comment) VALUES ('$name', $movieId, $rating, '$comment');";
                    $rs = $db->query($query);
                    //Basic error handling
                    if(!$rs){
                        $errmsg = $db->error;
                        print "No enough information <br/>";
                        exit(3);
                    }else{
                        echo "Succefully Inserted 1 comment!<br>";
                        echo " <a href=' MovieInfo.php?mid=$movie '>Click this to go back to see the movie</a>";
                    }
                }
?>
</div>

</body>
</html>
