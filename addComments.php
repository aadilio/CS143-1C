<!DOCTYPE html>
<html>
<body>

<h1>Add a Comment to a Movie</h1>
<br>Give a Movie's name and a comment in the following boxes:
<br>
<br> <br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Title: <input type="text" name="title"> <br>
//Should make this a drop down menu
Comment: <input type="text" name="comment"> <br>

<br><input type="submit">
<br>
</form>

<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $title = $_REQUEST['title'];
    $comment = $_REQUEST['comment'];

    //Connect PHP code with SQL
    $db = new mysqli('localhost', 'cs143', '', 'TEST');
    if($db->connect_errno > 0)
    {
      die('Unable to connect to database [' . $db->connect_error . ']');
    }

    //Creating a drop down menu of all of the movies
    $query = ("SELECT * FROM Movie");
    $sql = $db->query($query);
    if(mysql_num_rows($sql))
    {
      $select= '<SELECT NAME="select">';
      while($rs=mysql_fetch_array($sql))
      {
        $select.='<option value="'.$rs['title'].'">'.'</option>';
      }
    }
$select.='</SELECT>';

  }
?>


</body>
</html>
