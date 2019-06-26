<?php
include 'header.php';

?>
<?php
//ob_start();
mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");


if(isset($_REQUEST['StateId']))
{
	$steid=$_REQUEST['StateId'];
}

if(isset($_REQUEST['CityId']))
{
	$ctyid=$_REQUEST['CityId'];
     
	 if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
        {
            $fndqry = "select * from citytbl
                        where CityId = '$ctyid'";
            
            $fndres = mysql_query($fndqry);
                        if($r = mysql_fetch_row($fndres))
            {
                $CityName = $r[1];
            }
        } 
        if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "d")
        {
         $delqry = "delete from citytbl where CityId ='$ctyid'";
		 //echo $delqry;
         mysql_query($delqry);
        } 
}


if(isset($_REQUEST["btninsert"]))
{
	$name=$_REQUEST['txtcity'];
	$CityStateId=$_REQUEST['drpstate'];
	$qry= "insert into citytbl(CityName,CityStateId) values('$name','$CityStateId')";
	//echo $qry;
	mysql_query($qry);
	//header ("location:cityinsert.php?StateId=".$_POST["hdnStateId"]);
	
}

/*if(isset($_POST["btnupdate"]))
{
    $CityId = $_POST["hdnCityId"];
    $CityName = $_POST["txtcity"];
    
    $updqry = "update citytbl
        set CityName = '$CityName'
     where CityStateId ='$CityId'";
	 
       mysql_query($updqry);
       header ("location:cityinsert.php?StateId=".$_POST["hdnStateId"]);
}*/

?>
<html>
    <head>
        <script>
                function getStateId(id)
                {
                    window.location ="cityinsert.php?StateId="+id;
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
	
        	/*var city=document.getElementById("txtcity").value;
	         if(city=="" || city==null)
	       {
		    sts=false;
	    	msg +="empty city field<br>";
    	   }*/
           document.getElementById("p1").innerHTML=msg;
	
					if(sts==true)
					return true;
					else
					return false;
	
		}
        </script>
    </head>
    <body>



<form method="post" action="" onSubmit="return validate()">
<table border="4" align="center">
<tr>
<th colspan="2">CITY FORM</th>
</tr>
<tr>
<td>STATE</td>
<td>
    <select name="drpstate" id="drpstate" onChange="getStateId(this.value)">
<option value="0">----select----</option>
<?php
$stateqry= "select * from statetbl";
$stateres= mysql_query($stateqry);
//echo $stateres;
while ($r=mysql_fetch_row($stateres))
{
	if($_REQUEST["StateId"] && $_REQUEST["StateId"] ==$r[0])
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
<td> CITY</td>
<td><input type="text" name="txtcity" placeholder="Enter the City" id="txtcity" value="<?php if(isset($CityName)) echo $CityName; ?>" required><td>
</td>
 <tr>
    <td>
    <?php
	  
	  		if(isset($_REQUEST["mod"]) && $_REQUEST["mod"] == "e")
			{
				//echo       "<input type=submit name=btnupdate value=UPDATE>";
			}
      		else
			

			{
					echo       "<input type=submit name=btninsert value=INSERT>";
			}

	  
	  ?>
     
    <td><input type="submit" name="btncancel" id="btncancel" value="CANCEL"></td>
  </tr>
</table>
<table border="4">
<tr> 
 <td> CityName</td>
 <td> Actions</td>
</tr>
<?php
if($_REQUEST["StateId"])
{
	
$CityStateId = $_REQUEST["StateId"];
$qry = "select * from citytbl where CityStateId='$CityStateId'";


$res = mysql_query($qry);

while($r = mysql_fetch_row($res))
{
	echo "<tr>";
	echo "<td>$r[1]</td>";
	echo "<td>
			
			
             <a href=cityinsert.php?StateId=$CityStateId&CityId=$r[0]&mod=d>Delete</a>
		</td>";
		
	echo "</tr>";
}
}
?>
</table>
<p id="p1" style="color:red"/>

<input type="hidden"
                   name="hdnCityId"
                   value="<?php if(isset($ctyid)) echo $ctyid; ?>">
                   
            
                   <input type="hidden"
                   name="hdnStateId"
                   value="<?php if(isset($steid)) echo $steid; ?>">
</form>
<?php
include 'footer.php';
?>

</body>
</html>