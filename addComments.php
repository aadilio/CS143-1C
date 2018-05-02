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
</ul>

<div style="margin-left:25%;padding:1px 16px;height:1000px;">
<h1>Add a comment to a movie</h1>
<br>Give a Movie's name and a comment in the following boxes:
<br>
<br> <br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Your Name: <input type="text" name="name"> <br>
Movie Title: <input type="text" name="title"> <br>
Rating: <input type="text" name="title"> <br>

</form>
//Should make this a drop down menu
Comment:
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<textarea name="query" cols="60" rows="8" style="margin: 0px; width: 590px; height: 269px;"></textarea>
<br><input type="submit">
</form>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST")
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
?>
</div>

</body>
</html>
