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
	   $qualificationregid = $_SESSION["UserId"];
	   	   
	 $insqry="insert into qualification
  (QualificationUniversity,QualificationStream,YearOfPassing,
  QualificationPercentage,QualificationRegistrationId) 
  values ('$drpUniversity','$stream','$passing','$persentage','$qualificationregid')";
	 
	 mysql_query($insqry);
	 
 }
 if(isset($_REQUEST["qid"]))
{
		$qualificationid = $_REQUEST["qid"];
        if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "d")
		{
			$qry = "delete from qualification where QualificationId= '$qualificationid'";
			mysql_query($qry);
		}
	}
?>
    
<script>
                function getUniversityId(id)
                {
                    window.location ="qualification.php?uid="+id;
                }
				function validate()
       		{
	        var msg="";
           	var sts= true;
			
			var university=document.getElementById("drpUniversity");
		if(university.selectedIndex == 0)
		{
			sts=false;
			msg +="select the university<br>";
			}
			document.getElementById("p1").innerHTML=msg;
	
					if(sts==true)
					return true;
					else
					return false;
			}
</script>

        
<form method="post" onsubmit="return validate()">
<table border="4" align="center">
<tr>
<td colspan="2" align="center">
QUALIFICATION
</td>
</tr>
<tr>
<td>
University Name
</td>
<td>
<select name="drpUniversity" id="drpUniversity" onChange="getUniversityId(this.value)">
<option value="0">----select----</option>    
<?php

$qry= "select * from university";
$res= mysql_query($qry);

while ($r=mysql_fetch_row($res))
{
	if($_REQUEST["uid"] && $_REQUEST["uid"] ==$r[0])
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
<td>
Stream
</td>
<td>
<input type="text" name="stream" required>
</td>
</tr>
<tr>
<td> Year Of Passing
</td>
<td>
<input type="date" name="passing" required>
</td>
</tr>
<tr>
<td> Percentage
</td>
<td>
<input type="number" name="persentage" required>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="btnsubmit" value="AddQualification" >
</td>
</tr>
</table>
<p id="p1" style="color:red"/>
</form>

<table border="5" cellpadding="8" cellspacing="4">
<tr>
<td>
University Name
</td>
<td>
Stream
</td>
<td>
Year Of Passing
</td>
<td>
Percentage
</td>
<td>
Action
</td>
</tr>
<br>
<?php
if(isset($_SESSION["UserId"]))
{
	   $qualificationregid = $_SESSION["UserId"];  
           $qry1 = "select * from qualification,university where 
                    QualificationUniversity = UniversityId
                    and
                    QualificationRegistrationId =  '$qualificationregid'";
           $res1 = mysql_query($qry1);
           
while($r =  mysql_fetch_row($res1))
{
	echo "<tr>";
	echo "<td>$r[7]</td>";
        echo "<td>$r[2]</td>";
	echo "<td>$r[3]</td>";
	echo "<td>$r[4]</td>";
	echo "<td>
			
	<a href=qualification.php?qid=$r[0]&mod=d>Delete<a>
		</td>";
		
	echo "</tr>";
}
}
?>
</table>
