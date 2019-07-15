<?php
session_start();
include 'header.php';
?>
<?php

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");
 extract($_REQUEST);
 if(isset($_REQUEST[btnsubmit]))
 {
	 $companyregid = $_SESSION["UserId"];
	  
	 $insqry="insert into experience (ExpCompanyName,ExpCompanyAddress,ExpCompanyCityId,
                                          ExpCompanyPhone,ExpCompanyEmailId,ExpCompanyPinCode,
                                          ExpCompanyStartDate,ExpCompanyEndDate,ExpCompanyTechnology,
                                          ExpCompanyPosition,ExpCompanyDescription,ExpCompanyRegistrationId) 
                                          values 
                                          ('$name','$address','$drpcity',
                                           '$phone','$emailid','$pincode',
                                           '$startdate','$enddate','$drptech',
                                           '$drpposition','$description','$companyregid')";
	
	 mysql_query($insqry);
	 
	 
 }
 if(isset($_REQUEST["eid"]))
	{
		$expid = $_REQUEST["eid"];
        if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "d")
		{
			$qry = "delete from experience where ExperienceId= '$expid'";
			mysql_query($qry);
		}
	}
?>
<html>
<head>
<script>
                function getStateId(id)
                {
                    window.location ="experience.php?stateid="+id;
                }
				
       
		function validate()
       		{
	        var msg="";
           	var sts= true;
			
			var state=document.getElementById("drpstate");
		if(state.selectedIndex == 0)
		{
			sts=false;
			msg +="select the state<br>";
			}
			var city=document.getElementById("drpcity");
		if(city.selectedIndex == 0)
		{
			sts=false;
			msg +="select the city<br>";
			}
			
			var tech=document.getElementById("drptech");
		if(tech.selectedIndex == 0)
		{
			sts=false;
			msg +="select the companytype<br>";
			}
			var position=document.getElementById("drpposition");
		if(position.selectedIndex == 0)
		{
			sts=false;
			msg +="select the position<br>";
			}
			document.getElementById("p1").innerHTML=msg;
			var y=document.forms["aa"]["phone"].value;
		var z=y.length;
		{
			if((z < 10) || z== " " || (z > 10))
			{
				alert("phone number should be of 10 digits");
				return false;
			}
		}
		var a=document.forms["aa"]["emailid"].value;
   		q = a.indexOf("@");
   		w = a.lastIndexOf(".");
   		if (q < 1 || w<q+2 || w+2>a.length)
   		{
       			alert("Please enter correct email ID")
       			return false;
		}
	
					if(sts==true & sts==true)
					return true;
					else
					return false;
			}
    
</script>

</head>

<form method="post" name="aa" onSubmit="return validate()">
<table border="4" align="center">
<tr>
<th colspan="2">
EXPERIENCE FORM
</th>
</tr>
<tr>
<td> STATE</td>
<td>
<select name="drpstate" id="drpstate" onChange="getStateId(this.value)">
<option value="0">----select----</option>
<?php
$cityqry= "select * from statetbl";
$cityres= mysql_query($cityqry);
while ($r=mysql_fetch_row($cityres))
{
	if($_REQUEST["stateid"] && $_REQUEST["stateid"] ==$r[0])
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
<td>CITY</td>
<td>
<select name="drpcity" id="drpcity">
<option value="0">----select----</option>
<?php

if(isset($_REQUEST["stateid"]))
{
$stateid = $_REQUEST["stateid"];
$cityqry= "select * from citytbl where CityStateId = $stateid";
$cityres= mysql_query($cityqry);
//echo $stateres;
while ($r=mysql_fetch_row($cityres))
{
	if($_REQUEST["stateid"] && $_REQUEST["stateid"] ==$r[0])
	{
	    echo "<option value=$r[0] selected>	$r[1]</option>";
		}
		else
		{
			echo "<option value=$r[0]>$r[1]</option>";
			}
	}
}
?>
</select>
</td>
</tr>
<tr>
<td>COMPANY TYPE</td>
<td>
<select name="drptech" id="drptech">
<option value="0">----select----</option>
<?php
$techqry= "select * from companytype";
$techres= mysql_query($techqry);
//echo $stateres;
while ($r=mysql_fetch_row($techres))
{
	if($_REQUEST["technologyid"] && $_REQUEST["technologyid"] ==$r[0])
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
<td>COMPANY POSITION</td>
<td>
<select name="drpposition" id="drpposition">
<option value="0">----select----</option>
<?php
$positionqry= "select * from position";
$pres= mysql_query($positionqry);
//echo $stateres;
while ($r=mysql_fetch_row($pres))
{
	if($_REQUEST["positionid"] && $_REQUEST["positionid"] ==$r[0])
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
<td>COMPANY NAME</td>
<td><input type="text" name="name" placeholder="enter company name" required >
</td></tr>
<tr>
<td>COMPANY ADDRESS
</td>
<td>
<textarea name="address" required></textarea>
</td>
</tr>
<tr>
<td>COMPANY PHONE</td>
<td>
<input type="number" name="phone" required>
</td>
</tr>
<tr>
<td>COMPANY EMAILID</td>
<td>
<input type="text" name="emailid" placeholder="abc@gmail.com" required>
<tr><td>COMPANY PINCODE
</td>
<td>
<input type="number" name="pincode" maxlength="3" required>
</td>
</tr>
<tr>
<td>COMPANY START-DATE</td>
<td>
<input type="date" name="startdate" required>
</td>
</tr>
<tr>
<td>COMPANY END-DATE</td>
<td>
<input type="date" name="enddate" required>
</td>
</tr>
<tr>
<td>COMPANY DESCRIPTION</td>
<td>
<textarea name="description" required></textarea>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="btnsubmit"  value="Add Experience">
</td>
</tr>
</table>
</form>
<form>
<table border="5" cellpadding="8" cellspacing="4">
<tr>
<td>
company name &nbsp;&nbsp;&nbsp;
</td>
<td>
city&nbsp;&nbsp;&nbsp;
</td>
<td>
Start date&nbsp;&nbsp;&nbsp;
</td>
<td>
End date&nbsp;&nbsp;&nbsp;
</td>
<td>
experience technology&nbsp;&nbsp;&nbsp;
</td>
<td>
Action
</td>
</tr>
<br>
<?php

if(isset($_SESSION["UserId"]))
{
$companyregid = $_SESSION["UserId"];

$qry = "select * from experience, citytbl, companytype where ExpCompanyCityId = CityId  and 
        ExpCompanyRegistrationId = '$companyregid' and ExpCompanyTechnology = companytypeid";

$res = mysql_query($qry);

while($r =  mysql_fetch_assoc($res))
{
	echo "<tr>";
	echo "<td>".$r["ExpCompanyName"]."</td>";
        echo "<td>".$r["CityName"]."</td>";
        echo "<td>".$r["ExpCompanyStartDate"]."</td>";
	echo "<td>".$r["ExpCompanyEndDate"]."</td>";
	echo "<td>".$r["CompanyTypeName"]."</td>";
	echo "<td>
			
			<a href=experience.php?eid=".$r["ExperienceId"]."&mod=d>Delete<a>
		</td>";
		
	echo "</tr>";
}
}
?>
</table>
<p id="p1" style="color:red"/>
</form>

</html>