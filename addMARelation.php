<?php
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
  if($db->connect_errno > 0){
      die('Unable to connect to database [' . $db->connect_error . ']');
  }
    $query="SELECT CONCAT(title,' ','(',year,')') AS MovieName, id FROM Movie;";
    $rsMovie = $db->query($query);
    //Basic error handling
    if(!$rsMovie){
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    $query1="SELECT CONCAT(first, ' ', last,' ', '(', dob, ')')AS ActorName, id, dob FROM Actor ORDER BY last ASC;";
    $rsactor = $db->query($query1);
    //Basic error handling
    if(!$rsactor){
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(2);
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
    <li><a href="search.php">Search</a></li>

  </ul>


<div class='A' style="margin-left:25%;padding:1px 16px;height:1000px;">
<h1>Add an Movie/Actor Relation</h1>
<br>Pick an actor to relate with a movie:
<br> <br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Role: <input type="text" name="role"><br>
<label for="movie">Movie Title:</label>
                <span class="error">* <?php echo "$movieErr";?></span>
                <select class="form-control" name="movieID">
                    <option value=""> </option>
                    <?php
                      if($rsMovie->num_rows>0){
                        while($row = $rsMovie->fetch_assoc()){
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
                  <label for="actor">Actor:</label>
                  <span class="error">* <?php echo "$actorErr";?></span>
                  <select class="form-control" name="actor">
                    <option value=""> </option>
                    <?php
                      if($rsactor->num_rows>0){
                        while($row = $rsactor->fetch_assoc()){
                  ?>
                      <option value = <?php echo $row["id"] ?>> <?php echo $row["ActorName"] ?></option>
                    <?php   }
                      }else{
                    ?>
                      <option>None</option>
                    <?php
                      }
                    ?>
                  </select>
<br><input type="submit">
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  //echo 'ASDFASDF';
  $movieID = $_REQUEST['movieID'];
  $actorID = $_REQUEST['actor'];
  $role = $_REQUEST['role'];
  $db = new mysqli('localhost', 'cs143', '', 'CS143');
  if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
  }
  $rs = mysqli_query($db,"INSERT INTO MovieActor(mid,aid,role) VALUES ($movieID, $actorID,'$role');");
  if(!$rs){
      //$errmsg = $db->error;
      print "No enough information/Already existed<br/>";
      exit(3);
  }else{
      echo "Succefully Inserted!<br>";
      //echo " <a href=' MovieInfo.php?mid=$movie '>Click this to go back to see the movie</a>";
  }
  //mysql_close($db);
}
?>
</div>


</body>
</html>
