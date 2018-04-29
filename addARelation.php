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
  <li><a href="addAnActor.php">Add Actor/Director</a></li>
  <li><a href="addAMovie.php">Add Movie </a></li>
  <li><a href="addARelation.php">Add Movie Relation </a></li>
  <li><a href="addComments.php">Add comment</a></li>
</ul>


<div class='A' style="margin-left:25%;padding:1px 16px;height:1000px;">
<h1>Add an Actor/Director Relation</h1>
<br>Pick an Actor and Director to Relate with a Movie:
<br>Note: Only add a role if it is an Actor NOT a Director
<br> <br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Actor or Director: <br> <input type="radio" name="actOrDir"
<?php if (isset($actOrDir) && $actOrDir=="Actor") echo "checked";?>
value="Actor"> Actor
<input type="radio" name="actOrDir"
<?php if (isset($actOrDir) && $actOrDir=="Director") echo "checked";?>
value="Director"> Director <br>
Actor/Director: <input type="text" name="human"> <br>
Movie: <input type="text" name="movie"> <br>
Role (Only if Actor): <input type="text" name="role"> <br>
<br><input type="submit">
<br>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $occupation = $_REQUEST['actOrDir'];
    $humanNameAndDob = $_REQUEST['human'];
    $movieAndYear = $_REQUEST['movie'];
    $role = $_REQUEST['role'];

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
