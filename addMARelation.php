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
  <li><a href="addMDRelation.php">Add Movie/Director Relationt</a></li>
  <li><a href="addComments.php">Add Comment</a></li>
</ul>


<div class='A' style="margin-left:25%;padding:1px 16px;height:1000px;">
<h1>Add an Movie/Actor Relation</h1>
<br>Pick an actor to relate with a movie:
<br> <br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Role: <input type="text" name="role"><br>
<label for="movie">Movie Title:</label>
                <span class="error">* <?php echo "$movieErr";?></span>
                <select class="form-control" name="sMovie">
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
</div>
</form>         


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $movie = $_REQUEST['sMovie'];
  $actor = $_REQUEST['acotr'];
  $role = $_REQUEST['role'];
    //$occupation = $_REQUEST['actOrDir'];
    //$sex = $_REQUEST['maleOrFemale'];
    //$humanNameAndDob = $_REQUEST['actor'];
    //$movieAndYear = $_REQUEST['sMovie'];
    //$role = $_REQUEST['role'];
    //$fName = $_REQUEST['firstNmae'];
    //$lName = $_REQUEST['lastNmae'];
    //$dob = $_REQUEST['dob'];
    //$dod = $_REQUEST['dod'];
    //Connect PHP code with SQL
    $db = new mysqli('localhost', 'cs143', '', 'TEST');
    if($db->connect_errno > 0)
    {
      die('Unable to connect to database [' . $db->connect_error . ']');
    }
    //echo $sex;
    //Inserting the submitted values into the Actor/Director table
    $strlen = strlen($humanNameAndDob);
    $firstName = "";
    $lastName = "";
    $dob = "";
    $movieName = "";
    $movieYear;

    $counter=0; //0 means on first name, 1 means second, and 2 means dob
    for($i = 0; $i<$strlen; $i++)
    {
        if($humanNameAndDob[$i] == " ")
        {
          if($counter == 0)
          {
            $counter++;
          }
          else if($counter == 1)
          {
            $counter++;
          }
          else
          {
            break;
          }
          continue;
        }
        if($counter == 0)
        {
          $firstName .= $humanNameAndDob[$i];
        }
        else if($counter == 1)
        {
          $lastName .= $humanNameAndDob[$i];
        }
        else
        {
          $dob .= $humanNameAndDob[$i];
        }
    }

    //Split movie into parts
    $counter=0;
    $strlen = strlen($movieAndYear);
    for($i = 0; $i<$strlen; $i++)
    {
      if($movieAndYear[$i] == "(" && (($movieAndYear[$i+1] == 1) || ($movieAndYear[$i] == 2)))
      {
        $counter++;
        continue;
      }
      if($counter)
      {
        $movieYear .= $movieAndYear[$i];
      }
      else {
        $movieName .= $movieAndYear[$i];
      }

    }

    if($occupation == "Actor")
    {
        //$rs = $db->query("SELECT id from Actor ORDER BY id DESC LIMIT 1;");
    	$rs = mysqli_query($db,"SELECT id from Actor WHERE first = $firstName AND last = $lastName AND dob = $dob;");

	    $ry = mysqli_query($db,"SELECT id from Movie WHERE title = $movieName AND year = $movieYear;");

      $rz = mysqli_query($db,"INSERT INTO MovieActor (mid, aid, role) VALUES ($ry, $rs, $role);");
    }
    else
    {
      if($role != NULL)
      {
        echo "Can't make relation between director and movie if there is a role";
      }

      $rs = mysqli_query($db,"SELECT id from Director WHERE first = $firstName AND last = $lastName AND dob = $dob;");

      $ry = mysqli_query($db,"SELECT id from Movie WHERE title = $movieName AND year = $movieYear;");

      $rz = mysqli_query($db,"INSERT INTO MovieDirector (mid, did) VALUES ($ry, $rs);");

    }
    //mysqli_close($db);
}
?>
</div>


</body>
</html>
