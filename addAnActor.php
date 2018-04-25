<!DOCTYPE html>
<html>
<body>

<h1>Add an Actor</h1>
<br>Type an Actor's info in the following boxes:
<br>Example: Tom Hanks M 1998-03-11 N/A
<br> <br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Actor or Director: <br> <input type="radio" name="actOrDir"
<?php if (isset($actOrDir) && $actOrDir=="Actor") echo "checked";?>
value="Actor"> Actor
<input type="radio" name="actOrDir"
<?php if (isset($actOrDir) && $actOrDir=="Director") echo "checked";?>
value="Director"> Director <br>
First Name: <input type="text" name="fname"> <br>
Last Name: <input type="text" name="lname"> <br>
Sex (M/F): <input type="text" name="sex"> <br>
Date of Birth (i.e. 1998-03-11): <input type="text" name="DOB"> <br>
Date of Death (N/A if still alive): <input type="text" name="DOD"> <br>
<br><input type="submit">
<br>
</form>

<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $occupation = $_REQUEST['actOrDir'];
    $firstName = $_REQUEST['fname'];
    $lastName = $_REQUEST['lname'];
    $sex = $_REQUEST['sex'];
    $dob = $_REQUEST['DOB'];
    $dod = $_REQUEST['DOD'];

    //Connect PHP code with SQL
    $db = new mysqli('localhost', 'cs143', '', 'TEST');
    if($db->connect_errno > 0)
    {
      die('Unable to connect to database [' . $db->connect_error . ']');
    }

    //Inserting the submitted values into the Actor/Director table
    if($occupation == "Actor")
    {
      $query = ("INSERT INTO Actor (last, first, sex, dob, dod) VALUES ($firstName, $lastName, $sex, $dob, $dod)");
    }
    else
    {
      $query = ("INSERT INTO Director (last, first, sex, dob, dod) VALUES ($firstName, $lastName, $sex, $dob, $dod)");
    }
    $rs = $db->query($query);

  }
?>


</body>
</html>
