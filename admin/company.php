<?php
ob_start();
//session_start();
include 'header.php';
?>
<?php

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");

//echo $_SESSION["UserId"];

if(isset($_REQUEST["btninsert"]))
{
	$name=$_REQUEST['name'];
	$qry= "insert into companytype(CompanyTypeName) values('$name')";
	
	mysql_query($qry);
	
}
if(isset($_POST["btnupdate"]))
{
	$id=$_POST["h1"];
     $name=$_POST["name"];
	$qry= "update companytype set CompanyTypeName='$name' where CompanyTypeId='$id'";
	
	mysql_query($qry); 
			 
			 header("location:company.php");
			  
}
if(isset($_REQUEST["cid"]))
	{
		$companyid = $_REQUEST["cid"];


		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
		{
			
			$qry ="select * from companytype where CompanyTypeId = '$companyid'";
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
			$qry = "delete from companytype where CompanyTypeId= '$companyid'";
			//echo $qry;
			mysql_query($qry);
		}
 		
	}
?>


<form name="form1" method="post" action="">
<table width="800" border="1" cellpadding="5" class="table">
<tr>
<th colspan="2">COMPANY FORM</th>
</tr>
  <tr>
    <td><b>COMPANY TYPE</b>   </td>
    <td>
    <input type="text" name="name" id="name" placeholder="Enter the company" value="<?php if(isset($nm)) echo $nm; ?>" required></td>
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
 <td> CompanyName</td>
 <td> Actions</td>
</tr>
<?php
$qry = "select * from companytype";
$res = mysql_query($qry);

while($r =  mysql_fetch_row($res))
{
	echo "<tr>";
	echo "<td>$r[1]</td>";

	echo "<td>
			<a href=company.php?cid=$r[0]&mod=e>Edit<a>
			&nbsp;&nbsp;&nbsp;
			<a href=company.php?cid=$r[0]&mod=d>Delete<a>
		</td>";
		
	echo "</tr>";
}
?>
</table>
<input type="hidden" value="<?php if(isset($companyid)) echo $companyid;?>" name="h1">
  
  
  <p>&nbsp;</p>
</form>
<?php
include '../footer.php';
?>