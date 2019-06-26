<?php
include 'header.php';

?>
<?php
mysql_connect("localhost","root","");
mysql_select_db("dbjobpotal");

if(isset($_REQUEST["btninsert"]))
{
	$JobTypeName = $_REQUEST['txtjobtype'];      
	$data=mysql_query("select * from `jobtype` where `JobTypeName`='$JobTypeName'");
$row=mysql_fetch_array($data);
if($row['JobTypeName']=="")
{
	$insqry = "insert into jobtype
	                         (JobTypeName)
							  values
							 ('$JobTypeName')";
	mysql_query($insqry);?>
	<script>
	alert( 'Job type Added');
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
     $name=$_POST["txtjobtype"];
	//echo $name;
	$qry= "update jobtype set JobTypeName='$name' where JobtypeId='$id'";
	//echo $qry;
	
	mysql_query($qry); 
			 
			 //header("location:stateinsert.php");
			  
}
if(isset($_REQUEST["jid"]))
	{
		$jobtypeid = $_REQUEST["jid"];


		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
		{
			
			$qry ="select * from jobtype where JobTypeId = '$jobtypeid'";
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
			$qry = "delete from jobtype where JobTypeId= '$jobtypeid'";
			mysql_query($qry);
		}
 		
	}
	
?>



<form method="post">
<table border="5">
<tr>
<th colspan="2">JOB FORM</th>
</tr>
<tr>
<th>
Job Type Name</th>
<td><input type="text" name="txtjobtype" placeholder="Enter the jobtype" value="<?php if(isset($nm)) echo $nm; ?>" required>
</td>
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

</th>
<th><input type="submit" name="btncancel" value="cancel">
</th>
</tr>
</table>

<table border="4">
<tr> 
 <td> JobType Name</td>
 <td> Actions</td>
</tr>

<?php
$qry = "select * from jobtype";
$res = mysql_query($qry);

while($r =  mysql_fetch_row($res))
{
	echo "<tr>";
	echo "<td>$r[1]</td>";

	echo "<td>
			<a href=jobtype.php?jid=$r[0]&mod=e>Edit<a>
			&nbsp;&nbsp;&nbsp;
			<a href=jobtype.php?jid=$r[0]&mod=d>Delete<a>
		</td>";
		
	echo "</tr>";
}
?>
</table>
<input type="hidden" value="<?php if(isset($jobtypeid)) echo $jobtypeid;?>" name="h1">
  
  
  <p>&nbsp;</p>
</form>
<?php
include 'footer.php';
?>