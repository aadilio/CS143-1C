<<?php
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
<<<<<<< HEAD
  <li><a href="addMDRelation.php">Add Movie/Director Relationt</a></li>
=======
  <li><a href="addMDRelation.php">Add Movie/Director Relation </a></li>
>>>>>>> 3e036920861da8fc909e29592aaea59bf1d8812c
  <li><a href="addComments.php">Add Comment</a></li>
</ul>

<div style="margin-left:25%;padding:1px 16px;height:1000px;">
<h1>Add a comment to a movie</h1>
<br>Give a Movie's name and a comment in the following boxes:
<br>
<br> <br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<<<<<<< HEAD
<div class="form-group">
                <label for="movie">Movie Title:</label>
                <span class="error">* <?php echo "$movieErr";?></span>
                <select class="form-control" name="movie">
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
                </div>
</form>
Comment: 
=======
Your Name: <input type="text" name="name"> <br>
Movie Title: <input type="text" name="title"> <br>
Rating: <input type="text" name="title"> <br>

</form>
//Should make this a drop down menu
Comment:
>>>>>>> 3e036920861da8fc909e29592aaea59bf1d8812c
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<textarea name="query" cols="60" rows="8" style="margin: 0px; width: 590px; height: 269px;"></textarea>
<br><input type="submit">
</form>

<?php
/*
  )
  {
    $title = $_REQUEST['title'];
    $name = $_REQUEST['name'];
    $comment = $_REQUEST['comment'];
    $rating = $_REQUEST['rating'];
    //Need to get the current time

    //Connect PHP code with SQL
    $db = new mysqli('localhost', 'cs143', '', 'TEST');
    if($db->connect_errno > 0)
    {
      die('Unable to connect to database [' . $db->connect_error . ']');
    }

<<<<<<< HEAD
    
    if(mysqli_query($db,"INSERT INTO Director (id,last, first, dob, dod) VALUES ($MaxDirectorID+1,'$firstName', '$lastName', '$dob', '$dod');"))
    {
      mysqli_query($db,"INSERT INTO MaxPersonID(id) VALUES ($MaxDirectorID+1);");
       echo "Successfully added!";
    }else{
      echo "No insert happened!";c
=======
    //Creating a drop down menu of all of the movies
    /*$query = ("SELECT * FROM Movie");
    $sql = $db->query($query);
    if(mysql_num_rows($sql))
    {
      $select= '<SELECT NAME="select">';
      while($rs=mysql_fetch_array($sql))
      {
        $select.='<option value="'.$rs['title'].'">'.'</option>';
      }
    }
    $select.='</SELECT>'; */
    $rs = mysqli_query($db, "SELECT CURRENT_TIMESTAMP");
    foreach($rs as $key => $var){
        foreach($var as $col => $val) {
            $theTime = $val;
            //echo $MaxID1;
        }
>>>>>>> 3e036920861da8fc909e29592aaea59bf1d8812c
    }
    $rs = mysqli_query($db, "SELECT mid FROM Movie WHERE title = $title;");
    foreach($rs as $key => $var){
        foreach($var as $col => $val) {
            $mID = $val;
            //echo $MaxID1;
        }
    }

    mysqli_query($db, "INSERT INTO Review (name, time, mid, rating, comment) VALUES ('$name', $theTime, $mID, $rating, '$comment');");


  }
*/

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    //connection to database
                    $db = new mysqli('localhost', 'cs143', '', 'CS143');
                    if($db->connect_errno > 0){
                      die('Unable to connect to database [' . $db->connect_error . ']');
                    }
                    echo $movie;
                    echo 'ACCC\n';
                    $query= "INSERT INTO Review() VALUES ('$name', CURRENT_TIMESTAMP(), $movie, $rating, '$comment');";
                    $rs = $db->query($query);
                    //Basic error handling 
                    if(!$rs){
                        $errmsg = $db->error;
                        print "Query failed: $errmsg <br />";
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
