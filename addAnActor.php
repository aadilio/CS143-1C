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
  </ul>


<div class='A' style="margin-left:25%;padding:1px 16px;height:1000px;">
<h1>Add new actor/director</h1>
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
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $occupation = $_REQUEST['actOrDir'];
    $firstName = $_REQUEST['fname'];
    $lastName = $_REQUEST['lname'];
    $sex = $_REQUEST['sex'];
    $dob = $_REQUEST['DOB'];
    $dod = $_REQUEST['DOD'];

    //Connect PHP code with SQL
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->connect_errno > 0)
    {
      die('Unable to connect to database [' . $db->connect_error . ']');
    }
    //echo $sex;
    //Inserting the submitted values into the Actor/Director table
    if($occupation == "Actor")
    {
        //$rs = $db->query("SELECT id from Actor ORDER BY id DESC LIMIT 1;");
    	$rs = mysqli_query($db,"SELECT id from Actor ORDER BY id DESC LIMIT 1;");
	    foreach($rs as $key => $var){
	        foreach($var as $col => $val) {
	            $MaxID1 = $val;
	            //echo $MaxID1;
	        }
	    }
	    $rs = mysqli_query($db,"SELECT id from MaxPersonID;");
	    foreach($rs as $key => $var){
	        foreach($var as $col => $val){
	           	$MaxID2 = $val;
	          	//echo $MaxID2;
	        }
	    }
	    $MaxActorID = max($MaxID1,$MaxID2);
	    //echo $MaxActorID;
	    if($dod == 'N/A'){
	    	$rs = mysqli_query($db,"INSERT INTO Actor (id, last, first, sex, dob) VALUES ($MaxActorID+1,'$firstName', '$lastName', '$sex', '$dob');");
	    }else{
	    	$rs = mysqli_query($db,"INSERT INTO Actor (id, last, first, sex, dob, dod) VALUES ($MaxActorID+1,'$firstName', '$lastName', '$sex', '$dob', '$dod');");
		}
	    if($rs == true){
	      	//if（!mysqli_query($db,"UPDATE MaxPersonID SET id = $MaxDirectorID+1;")）{
	      	//	mysqli_query($db,"INSERT INTO MaxPersonID(id) VALUES ($MaxDirectorID+1);")
	      	//}
	      	$rs = mysqli_query($db,"SELECT id from MaxPersonID;");
	    	foreach($rs as $key => $var){
	        	foreach($var as $col => $val){
	           		$id = $val;
	        	}
	    	}
	    	if($id == 0){
	    		mysqli_query($db,"INSERT INTO MaxPersonID(id) VALUES ($MaxActorID+1);");
	    	}else{
	    		mysqli_query($db,"UPDATE MaxPersonID SET id = $MaxActorID+1;");
	    	}
	      	echo "Successfully added!";
	  	}else{
	  		echo "No insert happened!";
	  	}
    }
    else
    {
        $rs = mysqli_query($db,"SELECT id from Director ORDER BY id DESC LIMIT 1;");
	    foreach($rs as $key => $var){
	        foreach($var as $col => $val) {
	            $MaxID1 = $val;
	            //echo $MaxID1;
	        }
	    }
	    $rs = mysqli_query($db,"SELECT id from MaxPersonID;");
	    foreach($rs as $key => $var){
	        foreach($var as $col => $val){
	           	$MaxID2 = $val;
	          	//echo $MaxID2;
	        }
	    }
	    $MaxDirectorID = max($MaxID1,$MaxID2);
	    echo $MaxDirectorID;
	    if($dod == 'N/A'){
			$rs = mysqli_query($db,"INSERT INTO Director (id,last, first, dob) VALUES ($MaxDirectorID+1,'$firstName', '$lastName', '$dob');");
		}else{
	    	$rs = mysqli_query($db,"INSERT INTO Director (id,last, first, dob, dod) VALUES ($MaxDirectorID+1,'$firstName', '$lastName', '$dob', '$dod');");
		}
	    if($rs == true){
	    	$rs = mysqli_query($db,"SELECT id from MaxDirectorID;");
	    	foreach($rs as $key => $var){
	        	foreach($var as $col => $val){
	           		$id = $val;
	        	}
	    	}
	    	if($id == 0){
	    		mysqli_query($db,"INSERT INTO MaxPersonID(id) VALUES $MaxDirectorID+1;");
	    	}else{
	    		mysqli_query($db,"UPDATE MaxPersonID SET id = $MaxDirectorID+1;");
	    	}
	    	echo "Successfully added!";
	  	}else{
	  		echo "No insert happened!";
	  	}
    }
    //mysqli_close($db);
}
?>
</div>


</body>
</html>
