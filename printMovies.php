


<?php


echo "Movie Information is: <br> <br>";

$varue = $_GET["id"];

$db = new mysqli('localhost', 'cs143', '', 'CS143');
if($db->connect_errno > 0)
{
  die('Unable to connect to database [' . $db->connect_error . ']');
}

$rs = mysqli_query($db,"SELECT * FROM Movie WHERE id = $varue ORDER BY title DESC;");
if ($rs->num_rows > 0)
{
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

echo "Director is: <br>";

$ry = mysqli_query($db,"SELECT * FROM Director, MovieDirector WHERE MovieDirector.did = Director.id AND MovieDirector.mid = $varue ORDER BY id DESC;");
if ($ry->num_rows > 0)
{
    $ndisplay = "<table border='1' width='600'>";
    foreach($ry as $key => $var) {
    if($key===0) {
        $ndisplay .= '<tr>';
        foreach($var as $col => $val) {
            $ndisplay .= "<td>" . "<b>$col</b>" . '</td>';
        }
        $ndisplay .= '</tr>';
        $ndisplay .= '<tr>';
        foreach($var as $col => $val) {
            $ndisplay .= '<td>' . $val . '</td>';
        }
        $ndisplay .= '</tr>';
    }
    else {
        $ndisplay .= '<tr>';
        foreach($var as $col => $val) {
            $ndisplay .= '<td>' . $val . '</td>';
        }
        $ndisplay .= '</tr>';
    }
  }
  $ndisplay .= '</table>';
  echo $ndisplay;
}

echo "Genre is: <br>";
$rs = mysqli_query($db,"SELECT genre FROM MovieGenre WHERE mid = $varue ORDER BY mid;");
if ($rs->num_rows > 0)
{
    $display = "<table border='1' width='100'>";
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

echo "<br> Actors in Movie: <br>";
$rs = mysqli_query($db,"SELECT CONCAT(Act.first, ' ',Act.last) AS Name, aid, MovAct.role FROM Actor Act, MovieActor MovAct WHERE Act.id = MovAct.aid AND MovAct.mid = $varue;");
if ($rs->num_rows > 0){
    $display = "<table border='1' width='600'>";
    foreach($rs as $key => $var) {
    if($key===0) {
        $display .= '<tr>';
        foreach($var as $col => $val) {
          //  $my_id_num = $col["id"];
            $display .= "<td>" . "<b>$col</b>" . '</td>';
        }
        $display .= '</tr>';
        $display .= '<tr>';
        foreach($var as $col => $val)
        {
            $my_id_num = $var["aid"];
            $vaz = "<a href=\"printActors.php?id=".$my_id_num."\">".$val."</a><br/>";
            $display .= '<td>' . $vaz . '</td>';
        }
        $display .= '</tr>';
    }
    else {
      $my_id_num=1;
      $display .= '<tr>';
      foreach($var as $col => $val)
      {
          $my_id_num = $var["aid"];
          $vaz = "<a href=\"printMovies.php?id=".$my_id_num."\">".$val."</a><br/>";
          $display .= '<td>' . $vaz . '</td>';
      }
        $display .= '</tr>';
    }
}
$display .= '</table>';
echo "<a href=\"printMovies.php?id=".$my_id_num."\">".$display."</a><br/>";
}

echo "<br> Average Scores for Movie: <br>";
$rs = mysqli_query($db,"SELECT AVG(rating) AS AverageRating FROM Review WHERE mid = $varue;");
if ($rs->num_rows > 0)
{
    $display = "<table border='1' width='500'>";
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
  echo "No Reviews have been written, so there is no average score <br>";
}



echo "<br> Reviews for Movie: <br>";
$rs = mysqli_query($db,"SELECT * FROM Review WHERE mid = $varue;");
if ($rs->num_rows > 0)
{
    $display = "<table border='1' width='500'>";
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
  echo "No Reviews have been written <br>";
}

$display = "<br> Add your own comment below by clicking here: <br>";
echo "<a href=\"addComments.php\">".$display."</a><br/>";

//echo $var;
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

</div>


</body>
</html>
