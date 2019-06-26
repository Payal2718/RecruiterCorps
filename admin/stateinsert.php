<?php
include 'header.php';

?>
<?php

mysql_connect("localhost","root","") or die("Unable to connect with server");
mysql_select_db("dbjobpotal") or die("Error while connecting with database");
//$name=$_REQUEST['name'];

if(isset($_REQUEST["btninsert"]))
{
	$name=$_REQUEST['name'];
	$data=mysql_query("select * from `statetbl` where `StateName`='$name'");
$row=mysql_fetch_array($data);
if($row['StateName']=="")
{
	mysql_query("insert into statetbl(StateName) values('$name')");?>
	<script>
	alert( 'State Added');
	</script><?php
}
else
{?><script>
	alert('Already exist');</script><?php
}
	
	
}
if(isset($_POST["btnupdate"]))
{
	$id=$_POST["h1"];
     $name=$_POST["name"];
	//echo $name;
	$qry= "update statetbl set StateName='$name' where StateId='$id'";
	//echo $qry;
	
	mysql_query($qry); 
			 
			 //header("location:stateinsert.php");
			  
}
if(isset($_REQUEST["sid"]))
	{
		$stateid = $_REQUEST["sid"];


		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
		{
			
			$qry ="select * from statetbl where StateId = '$stateid'";
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
			$qry = "delete from statetbl where StateId= '$stateid'";
			mysql_query($qry);
		}
 		
	}
	
?>


<form name="form1" method="post" action="">
<table width="800" border="1" cellpadding="5">
<tr>
<th colspan="2">STATE FORM</th>
</tr>
  <tr>
    <td><b>STATE NAME</b>   </td>
    <td>
    <input type="text" name="name" id="name" placeholder="Enter the state" value="<?php if(isset($nm)) echo $nm; ?>" required></td>
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
					echo       "<input type=submit name=btninsert value=INSERT>";
			}

	  
	  ?>
    </td>
    <td><input type="submit" name="btncancel" id="btncancel" value="CANCEL"></td>
  </tr>
</table>


<table border="4">
<tr> 
 <td> StateName</td>
 <td> Actions</td>
</tr>
<?php
$qry = "select * from statetbl";
$res = mysql_query($qry);

while($r =  mysql_fetch_row($res))
{
	echo "<tr>";
	echo "<td>$r[1]</td>";

	echo "<td>
			<a href=stateinsert.php?sid=$r[0]&mod=e>Edit<a>
			&nbsp;&nbsp;&nbsp;
			<a href=stateinsert.php?sid=$r[0]&mod=d>Delete<a>
		</td>";
		
	echo "</tr>";
}
?>
</table>
<input type="hidden" value="<?php if(isset($stateid)) echo $stateid;?>" name="h1">
  
  
  <p>&nbsp;</p>
</form>
<?php
include 'footer.php';
?>