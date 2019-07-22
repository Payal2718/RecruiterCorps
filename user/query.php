<?php
 include "header.php";

mysql_connect("localhost","root","") or die("Unable to connect with server");
mysql_select_db("dbjobpotal") or die("Error while connecting with database");

 extract($_REQUEST);
 
 if(isset($_POST["btnsubmit"]))
 {
	
	$qry= "insert into querytable(Name,EmailId,Mobile,QueryName,	
	DateOfQuery,CompanyId,Status) values('$name','$txtemail','$txtmobile','$txtquery',NOW(),'$drpcompany','Unanswered')";
    mysql_query($qry);
   //echo $qry;


}

?>

<html>
    <head>
    <script>
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
			document.getElementById("p1").innerHTML=msg;
			var y=document.forms["aa"]["txtmobile"].value;
		var z=y.length;
		{
			if((z < 10) || z== " " || (z > 10))
			{
				alert("phone number should be of 10 digits");
				return false;
			}
		}
		var a=document.forms["aa"]["txtemail"].value;
   		q = a.indexOf("@");
   		w = a.lastIndexOf(".");
   		if (q < 1 || w<q+2 || w+2>a.length)
   		{
       			alert("Please enter correct email ID")
       			return false;
		}
	
					if(sts==true)
					return true;
					else
					return false;
			
			
			}
            </script>
       
    </head>
	
 <body>
<form method="post" name="aa" onSubmit="return validate()">
<table border="4" align="center">
<tr>
<td>Company Name</td>
<td><select name="drpcompany" id="drpcompany">
<option value="0">----select----</option>

<?php
$companyqry= "select * from company";
$companyres= mysql_query($companyqry);
//echo $stateres;
while ($r=mysql_fetch_row($companyres))
{
    echo "<option value=$r[0]>$r[1]</option>";
			
}

?>

</select>
</td>
</tr>
<tr>
<td>Name</td>
<td><input type="text" name="name" required></td>
</tr>


<tr>
<td>Email id</td>
<td><input type="text" name="txtemail" required></td>
</tr>


<tr>
<td>Mobile</td>
<td><input type="number" name="txtmobile" required maxlength="10"></td>
</tr>


<tr>
<td>Query</td>
 <td> <textarea name="txtquery" required> </textarea></td>                                                                         </tr>
 
 <tr>
 <td>
 <input type="submit" name="btnsubmit" value="submit">
 </td>
 </tr>
 </table>
<p id="p1" style="color:red"/>
 </form>
 </body>
 </html>