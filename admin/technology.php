<?php
include 'header.php';

?>
<?php

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");
//$name=$_REQUEST['name'];

if(isset($_REQUEST["btninsert"]))
{
	$name=$_REQUEST['name'];
	$data=mysql_query("select * from `technology` where `TechnologyName`='$name'");
$row=mysql_fetch_array($data);
if($row['TechnologyName']=="")
{
	mysql_query("insert into technology(TechnologyName) values('$name')");?>
	<script>
	alert( 'Technology Added');
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
	$qry= "update technology set TechnologyName='$name' where TechnologyId='$id'";
	//echo $qry;
	
	mysql_query($qry); 
			 
			 //header("location:technology.php");
			  
}
if(isset($_REQUEST["tid"]))
	{
		$technologyid = $_REQUEST["tid"];


		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
		{
			
			$qry ="select * from technology where TechnologyId = '$technologyid'";
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
			$qry = "delete from technology where TechnologyId= '$technologyid'";
			mysql_query($qry);
		}
 		
	}
	
?>


<form name="form1" method="post" action="">
<table width="800" border="1" cellpadding="5">
<tr>
<th colspan="2">TECHNOLOGY FORM</th>
</tr>
  <tr>
    <td><b>TECHNOLOGY NAME</b>   </td>
    <td>
    <input type="text" name="name" id="name" placeholder="Enter the Technology" value="<?php if(isset($nm)) echo $nm; ?>" required></td>
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
    <td><input type="submit" name="btncancle" id="btncancle" value="CANCEL"></td>
  </tr>
</table>


<table border="4">
<tr> 
 <td>Technology 
 Name</td>
 <td> Actions</td>
</tr>
<?php
$qry = "select * from technology";
$res = mysql_query($qry);

while($r =  mysql_fetch_row($res))
{
	echo "<tr>";
	echo "<td>$r[1]</td>";

	echo "<td>
			<a href=technology.php?tid=$r[0]&mod=e>Edit<a>
			&nbsp;&nbsp;&nbsp;
			<a href=technology.php?tid=$r[0]&mod=d>Delete<a>
		</td>";
		
	echo "</tr>";
}
?>
</table>
<input type="hidden" value="<?php if(isset($technologyid)) echo $technologyid;?>" name="h1">
  
  
  <p>&nbsp;</p>
</form>
<?php
include '../footer.php';
?>