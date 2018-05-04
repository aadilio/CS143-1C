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
  <li><a href="searchActor.php">Search Actor</a></li>
  <li><a href="searchMovie.php">Search Movie</a></li>
  <li><a href="search.php">Search</a></li>


</ul>



<div class='A' style="margin-left:25%;padding:1px 16px;height:1000px;">
<h1>Search</h1>
<br>Type any phrase/actor/movie
<br>Example: Tom
<br> <br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Phrase: <input type="text" name="fname"> <br>
<br><input type="submit">
<br>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $phrase = $_REQUEST['fname'];

    //Connect PHP code with SQL
    $db = new mysqli('localhost', 'cs143', '', 'TEST');
    if($db->connect_errno > 0)
    {
      die('Unable to connect to database [' . $db->connect_error . ']');
    }
    //echo $sex;
    //Inserting the submitted values into the Actor/Director table
        //$rs = $db->query("SELECT id from Actor ORDER BY id DESC LIMIT 1;");

        $rs = mysqli_query($db,"SELECT first, last, dob from Actor WHERE first LIKE '%$phrase%' OR last LIKE '%$phrase%' ORDER BY first DESC;");
      //  $rs = mysqli_query($db,"SELECT CONCAT_WS(" ", first, last) AS name, dob from Actor WHERE first LIKE '%$phrase%' OR last LIKE '%$phrase%' ORDER BY first DESC;");
      //  $rs = mysqli_query($db,"SELECT CONCAT_WS(" ", first, last) AS name, dob FROM Actor WHERE first LIKE '%Tom%' OR last LIKE '%Tom%' ORDER BY first ASC LIMIT 5;");
        if ($rs->num_rows > 0){
            $display = "<table border='1' width='600'>";
            foreach($rs as $key => $var) {
            if($key===0) {
                $display .= '<tr>';
                foreach($var as $col => $val) {
                    $display .= "<td>" . "<b>$col</b>" . '</td>';
                }
                $display .= '</tr>';
                $display .= '<tr>';
                foreach($var as $col => $val) {
                    $display .= '<td>' . $val . '</td>';
                }
                $display .= '</tr>';
            }
            else {
                $display .= '<tr>';
                foreach($var as $col => $val) {
                    $display .= '<td>' . $val . '</td>';
                }
                $display .= '</tr>';
            }
        }
        $display .= '</table>';
        echo $display;
        }
        else {
          echo "None found";
        }





    $rs = mysqli_query($db,"SELECT title, year from Movie WHERE title LIKE '%$phrase%' ORDER BY title DESC;");
  //  $rs = mysqli_query($db,"SELECT CONCAT_WS(" ", first, last) AS name, dob from Actor WHERE first LIKE '%$phrase%' OR last LIKE '%$phrase%' ORDER BY first DESC;");
  //  $rs = mysqli_query($db,"SELECT CONCAT_WS(" ", first, last) AS name, dob FROM Actor WHERE first LIKE '%Tom%' OR last LIKE '%Tom%' ORDER BY first ASC LIMIT 5;");
    if ($rs->num_rows > 0){
        $display = "<table border='1' width='600'>";
        foreach($rs as $key => $var) {
        if($key===0) {
            $display .= '<tr>';
            foreach($var as $col => $val) {
                $display .= "<td>" . "<b>$col</b>" . '</td>';
            }
            $display .= '</tr>';
            $display .= '<tr>';
            foreach($var as $col => $val) {
                $display .= '<td>' . $val . '</td>';
            }
            $display .= '</tr>';
        }
        else {
            $display .= '<tr>';
            foreach($var as $col => $val) {
                $display .= '<td>' . $val . '</td>';
            }
            $display .= '</tr>';
        }
    }
    $display .= '</table>';
    echo $display;
    }
    else {
      echo "None found";
    }




    /*while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
    {
      printf("First: %s  Last: %s", $row["first"], $row["last"]);

    }
    */
    //mysqli_close($db);
}
?>
</div>


</body>
</html>
