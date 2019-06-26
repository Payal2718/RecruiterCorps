<?php
include 'header.php';

?><?php

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");
//$name=$_REQUEST['name'];

if(isset($_REQUEST["btninsert"]))
{
	$name=$_REQUEST['name'];
	$qry= "insert into position (PositionName) values ('$name')";
	//echo $qry;
	
	mysql_query($qry);
	
}
if(isset($_POST["btnupdate"]))
{
	$id=$_POST["h1"];
     $name=$_POST["name"];
	//echo $name;
	$qry= "update position set PositionName='$name' where PositionId='$id'";
	//echo $qry;
	
	mysql_query($qry); 
			 
			// header("location:position.php");
			  
}
if(isset($_REQUEST["pid"]))
	{
		$positionid = $_REQUEST["pid"];


		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
		{
			
			$qry ="select * from position where PositionId = '$positionid'";
			//echo $qry;
		
				  $res = mysql_query($qry);
				  //echo $res;
				  if($r = mysql_fetch_row($res))
				  {
					  $nm = $r[1];
				  }
		
		}
		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "d")
		{
			$qry = "delete from position where PositionId= '$positionid'";
			mysql_query($qry);
		}
 		
	}
	
?>


<form name="form1" method="post" action="">
<table width="800" border="1" cellpadding="5">
<tr>
<th colspan="2">POSITION FORM</th>
</tr>
  <tr>
    <td><b>POSITION NAME</b>   </td>
    <td>
    <input type="text" name="name" id="name" placeholder="Enter the Position" value="<?php if(isset($nm)) echo $nm; ?>" required></td>
  </tr>
  <tr>
  <td>
  <?php
	  
	  		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
			{
				echo       "<input type=submit name=btnupdate value=UPDATE>";
			}
      		else
			{
					echo     "<input type=submit name=btninsert value=INSERT>";
			}

	  
	  ?>
    </td>
    <td><input type="submit" name="btncancel" id="btncancel" value="CANCEL"></td>
  </tr>
</table>


<table border="4">
<tr> 
 <td>Position
 Name</td>
 <td> Actions</td>
</tr>
<?php
$qry = "select * from position";
$res = mysql_query($qry);

while($r =  mysql_fetch_row($res))
{
	echo "<tr>";
	echo "<td>$r[1]</td>";

	echo "<td>
			<a href=position.php?pid=$r[0]&mod=e>Edit<a>
			&nbsp;&nbsp;&nbsp;
			<a href=position.php?pid=$r[0]&mod=d>Delete<a>
		</td>";
		
	echo "</tr>";
}
?>
</table>
<input type="hidden" value="<?php if(isset($positionid)) echo $positionid;?>" name="h1">
  
  
  <p>&nbsp;</p>
</form>
<?php
include '../footer.php';
?>