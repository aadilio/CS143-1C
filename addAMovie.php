<!DOCTYPE html>
<html>

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

<h1>Add a Movie</h1>
<br>Type an Movie's info name in the following boxes:
<br>
<br> <br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Title: <input type="text" name="title"> <br>
Company: <input type="text" name="company"> <br>
Year: <input type="text" name="year"> <br>
MPAA Rating: <input type="text" name="rating"> <br>
Genre: <input type="text" name="genre"> <br>
<br><input type="submit">
<br>
</form>

<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $title = $_REQUEST['title'];
    $company = $_REQUEST['company'];
    $year = $_REQUEST['year'];
    $rating = $_REQUEST['rating'];
    $genre = $_REQUEST['genre'];

    //Connect PHP code with SQL
    $db = new mysqli('localhost', 'cs143', '', 'TEST');
    if($db->connect_errno > 0)
    {
      die('Unable to connect to database [' . $db->connect_error . ']');
    }

    $rs = mysqli_query($db,"SELECT id from Movie ORDER BY id DESC LIMIT 1;");
    foreach($rs as $key => $var){
      foreach($var as $col => $val) {
          $MaxID1 = $val;
              //echo $MaxID1;
        }
    }
    $rs = mysqli_query($db,"SELECT id from MaxMovieID;");
    foreach($rs as $key => $var){
       foreach($var as $col => $val){
          $MaxID2 = $val;
              //echo $MaxID2;
        }
    }
    $MaxMovieID = max($MaxID1,$MaxID2);
    echo $MaxMovieID;
    $rs = mysqli_query($db,"INSERT INTO Movie (id, title, year, rating, company) VALUES ($MaxMovieID+1,'$title', '$year', '$rating', '$company');");
    if($rs == true){
          //if（!mysqli_query($db,"UPDATE MaxPersonID SET id = $MaxDirectorID+1;")）{
          //	mysqli_query($db,"INSERT INTO MaxPersonID(id) VALUES ($MaxDirectorID+1);")
          //}
        $rs = mysqli_query($db,"SELECT id from MaxMovieID;");
        foreach($rs as $key => $var){
            foreach($var as $col => $val){
                $id = $val;
            }
      }
      if($id == 0){
        mysqli_query($db,"INSERT INTO MaxMovieID(id) VALUES ($MaxMovieID+1);");
      }
      else
      {
        mysqli_query($db,"UPDATE MaxMovieID SET id = $MaxMovieID+1;");
      }
        echo "Successfully added!";
      }else{
        echo "No insert happened!";
      }


  }
?>


</body>
</html>
