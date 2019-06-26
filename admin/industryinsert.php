<?php
include 'header.php';

?>
<?php

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");

if(isset($_REQUEST["btninsert"]))
{
	$name=$_REQUEST['name'];     
	$data=mysql_query("select * from `industry` where `IndustryName`='$name'");
$row=mysql_fetch_array($data);
if($row['IndustryName']=="")
{
	$qry= "insert into industry(IndustryName) values('$name')";
	//echo $qry;
	
	mysql_query($qry);?>
	<script>
	alert( 'Industry Added');
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
	$qry= "update industry set IndustryName='$name' where IndustryId='$id'";
	//echo $qry;
	
	mysql_query($qry); 
			 
	//header("location:industryinsert.php");
			  
}
if(isset($_REQUEST["indusid"]))
	{
		$industryid = $_REQUEST["indusid"];
		

		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
		{
			$qry ="select * from industry where IndustryId = '$industryid'";
				 // echo $qry;
				  $res = mysql_query($qry);
				  //echo $res;
				  if($r = mysql_fetch_row($res))
				  {
					  $nm = $r[1];
				  }
			
		}
		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "d")
		{
			$qry = "delete from industry where IndustryId= '$industryid'";
			mysql_query($qry);
		}
 		
	}
	
?>
<form name="form1" method="post" action="">
<table width="800" border="1" cellpadding="5">
<tr>
<th colspan="2">INDUSTRY FORM</th>
</tr>
  <tr>
    <td><b>INDUSTRY NAME    </b></td>
    <td><label for="textfield"></label>
    <input type="text" name="name" id="name" placeholder="Enter the Industryname" value="<?php if(isset($nm)) echo $nm; ?>" required></td>
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
     
    <td><input type="submit" name="btncancle" id="btncancle" value="CANCEL"></td>
  </tr>
</table>




<table border="4">
<tr> 
 <td> Name</td>
 <td> Actions</td>
</tr>
<?php
$qry = "select * from industry";
$res = mysql_query($qry);

while($r =  mysql_fetch_row($res))
{
	echo "<tr>";
	echo "<td>$r[1]</td>";

	echo "<td>
			<a href=industryinsert.php?indusid=$r[0]&mod=e>Edit<a>
			&nbsp;&nbsp;&nbsp;
			<a href=industryinsert.php?indusid=$r[0]&mod=d>Delete<a>
		</td>";
		
	echo "</tr>";
}


?>

</table>
<input type="hidden" value="<?php if(isset($industryid)) echo $industryid;?>" name="h1">
  
  
  <p>&nbsp;</p>
  </form>
  <?php
include '../footer.php';
?>