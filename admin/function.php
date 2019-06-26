<?php
include 'header.php';

?>
<?php

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");


if(isset($_REQUEST['CompanyTypeId']))
{
	$steid=$_REQUEST['CompanyTypeId'];
}
if(isset($_REQUEST["btninsert"]))
{
	$name=$_REQUEST['txtfunction'];
	$CompanyTypeId=$_REQUEST['drpcompany'];
	$qry= "insert into functiontype(FunctionName,FunctionCompanyTypeId) values('$name','$CompanyTypeId')";
	//echo $qry;
	mysql_query($qry);
//header ("location:function.php?CompanyTypeId=".$CompanyTypeId);
	
}
if(isset($_POST["btnupdate"]))
{
    $FunctionId = $_POST["hdnFunctionId"];
    $FunctionName = $_POST["txtfunction"];
    
    $updqry = "update functiontype
        set FunctionName = '$FunctionName'
     where FunctionId ='$FunctionId'";
	 
       mysql_query($updqry);
     // header ("location:function.php?CompanyTypeId=".$_POST["hdnCompanyId"]);
}


if(isset($_REQUEST['fid']))
{
	$FunctionId=$_REQUEST['fid'];
     
	 if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
        {
            $fndqry = "select * from functiontype
                        where FunctionId = '$FunctionId'";
            
            $fndres = mysql_query($fndqry);
                        if($r = mysql_fetch_row($fndres))
            {
                $FunctionName = $r[1];
            }
        } 
        if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "d")
        {
         $delqry = "delete from functiontype where FunctionId = '$FunctionId'";
		 //echo $delqry;
         mysql_query($delqry);
        } 
}





?>
<html>
    <head>
        <script>
                function getCompany(id)
                {
                    window.location ="function.php?CompanyTypeId="+id;
                }
				function validate()
       		{
	        var msg="";
           	var sts= true;
			
			var company=document.getElementById("drpcompany");
		if(company.selectedIndex == 0)
		{
			sts=false;
			msg +="select the company<br>";
			}
			}
        </script>
    </head>
    <body>



<form method="post" action="function.php" onSubmit="return validate()">
<table border="4">
<tr>
<th colspan="2">FUNCTION FORM</th>
</tr>
<tr>
<td>Company Type</td>
<td><select name="drpcompany" id="drpcompany" onChange="getCompany(this.value)">
<option value="0">----select----</option>
<?php
$companyqry= "select * from companytype";
$companyres= mysql_query($companyqry);
//echo $stateres;
while ($r=mysql_fetch_row($companyres))
{
	if($_REQUEST["CompanyTypeId"] && $_REQUEST["CompanyTypeId"] ==$r[0])
	{
	    echo "<option value=$r[0] selected>	$r[1]</option>";
		}
		else
		{
			echo "<option value=$r[0]>$r[1]</option>";
			}
	}
?>
</select>
</td>
</tr>

<tr>
<td> Function</td>
<td><input type="text" name="txtfunction" placeholder="Enter the Function" value="<?php if(isset($FunctionName)) echo $FunctionName; ?>" required><td>
</td>
 <tr>
    <td>
     <?php
	  
	  		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
			{
				echo       "<input type=submit name=btnupdate value=UPDATE>";
			}
      		else
			{
					echo    "<input type=submit name=btninsert value=INSERT>";
			}

	  
	  ?> </td>
     
    <td><input type="submit" name="btncancel" id="btncancel" value="CANCEL"></td>
  </tr>
</table>
<table border="4">
<tr> 
 <td> FunctionName</td>
 <td> Actions</td>
</tr>
<?php
if($_REQUEST["CompanyTypeId"])
{
	
$CompanyTypeId= $_REQUEST["CompanyTypeId"];
$qry = "select * from functiontype where FunctionCompanyTypeId='$CompanyTypeId'";

$res = mysql_query($qry);

while($r = mysql_fetch_row($res))
{
	echo "<tr>";
	echo "<td>$r[1]</td>";
	echo "<td>
			
			<a href=function.php?CompanyTypeId=$FunctionCompanyTypeId&fid=$r[0]&mod=e>Edit</a>
            <a href=function.php?CompanyTypeId=$FunctionCompanyTypeId&fid=$r[0]&mod=d>Delete</a>
		</td>";
		
	echo "</tr>";
}
}
?>
</table>

<input type="hidden"
                   name="hdnFunctionId"
                   value="<?php if(isset($FunctionId)) echo $FunctionId;  ?>">
                   
            
                   <input type="hidden"
                   name="hdnCompanyId"
                   value="<?php if(isset($steid)) echo $steid;  ?>">
</form>
<?php
include 'footer.php';
?>
</body>
</html>