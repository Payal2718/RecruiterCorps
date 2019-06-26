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
	$data=mysql_query("select * from `university` where `UniversityName`='$name'");
$row=mysql_fetch_array($data);
if($row['UniversityName']=="")
{
	mysql_query("insert into university(UniversityName) values('$name')");?>
	<script>
	alert( 'University Added');
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
	$qry= "update university set UniversityName='$name' where UniversityId='$id'";
	
	mysql_query($qry); 
			 
			 //header("location:university.php");
			  
}
     if(isset($_REQUEST["uid"]))
	  {
		$universityid = $_REQUEST["uid"];


		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
		{
			
			$qry ="select * from university where UniversityId = '$universityid'";
		
				  $res = mysql_query($qry);
				  if($r = mysql_fetch_row($res))
				  {
					  $nm = $r[1];
				  }
		
		}
		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "d")
		{
			$qry = "delete from university where UniversityId= '$universityid'";
			mysql_query($qry);
		}
 		
	}
	
?>


<form name="form1" method="post" action="">
<table width="800" border="1" cellpadding="5">
  <tr>
    <td><b>UNIVERSITY NAME</b>   </td>
    <td>
    <input type="text" name="name" id="name" placeholder="Enter the University" value="<?php if(isset($nm)) echo $nm; ?>" required></td>
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
 <td>University 
 Name</td>
 <td> Actions</td>
</tr>
<?php
$qry = "select * from university";
$res = mysql_query($qry);

while($r =  mysql_fetch_row($res))
{
	echo "<tr>";
	echo "<td>$r[1]</td>";

	echo "<td>
			<a href=university.php?uid=$r[0]&mod=e>Edit<a>
			&nbsp;&nbsp;&nbsp;
			<a href=university.php?uid=$r[0]&mod=d>Delete<a>
		</td>";
		
	echo "</tr>";
}
?>
</table>
<input type="hidden" value="<?php if(isset($universityid)) echo $universityid;?>" name="h1">
  
  
  <p>&nbsp;</p>
</form>
<?php
include '../footer.php';
?>