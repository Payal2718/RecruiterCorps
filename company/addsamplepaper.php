<?php
session_start();
include 'header.php';
?>

<?php

mysql_connect("localhost","root","") or die("Unable to connect with server");
mysql_select_db("dbjobpotal") or die("Error while connecting with database");


//echo $_SESSION["UserId"];

if(isset($_POST["btnPaper"]))
{
	$companyid = $_SESSION["UserId"];
	//echo $companyid;
	$year  = $_POST["drpYear"];
	$month = $_POST["drpMonth"];
	$title = $_POST["txtTitle"];
	$attachment = $_FILES["fuAttachment"]["name"];
	
	move_uploaded_file($_FILES["fuAttachment"]["tmp_name"],
						"../samplepaper/".$_FILES["fuAttachment"]["name"]);
						
	$insqry = "insert into samplepaper(samplepaperyear,
			samplepapermonth,samplepapertitle,samplepaperfile,samplecompanyid)
			values
			('$year','$month','$title','$attachment','$companyid')";
			mysql_query($insqry);?>
            <script>
			alert('sample paper successfully added');
			</script>
            <?php
			 
				
}
?>
<script>
	function GetYear(year)
	{
		window.location = "addsamplepaper.php?year="+year;
	}
	function GetMonth(month)
	{
		var year = document.getElementById("drpYear").value;
		window.location = "addsamplepaper.php?year="+year+"&month="+month;
	}
   function validate()
       		{
	        var msg="";
           	var sts= true;
			
			var year=document.getElementById("drpYear");
		if(year.selectedIndex == 0)
		{
			sts=false;
			msg +="select the year<br>";
			}
			var month=document.getElementById("drpMonth");
		if(month.selectedIndex == 0)
		{
			sts=false;
			msg +="select the month<br>";
			}
	
        	
           document.getElementById("p1").innerHTML=msg;
	
					if(sts==true & sts==true)
					return true;
						else
					return false;
	
		}
</script>
    
<form method="post" enctype="multipart/form-data" onsubmit="return validate()">
<table border="5">
<th align="center"><b><h3>Sample paper</h3></b></th>
<tr>
<th>Year</th>
<td>
<select name="drpYear" id="drpYear" onchange="GetYear(this.value)">
<option  value="0">---Select---</option>
<?php
for($i=1991; $i<2000; $i++)
{
	if(isset($_REQUEST["year"]) && $_REQUEST["year"] == $i)
	{
		echo "<option value=$i selected>$i</option>";
	}
	else
	{
		echo "<option value=$i>$i</option>";
	}
}
?>
</select>
</td>
</tr>



<tr>
<th>Month</th>
<td>
<select name="drpMonth" id="drpMonth" onchange="GetMonth(this.value)">
<option value="0">--Select--</option>
<?php
		$montharr = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		foreach($montharr as $month)
		{
		if(isset($_REQUEST["month"]) && $_REQUEST["month"] == $month)
		{
				echo "<option value=$month selected>$month</option>";	
		}
		else
		{
				echo "<option value=$month>$month</option>";	
		}
		}
	
?>
</select>
</td>
</tr>


<tr>
<th>
	Title
</th>
<td>
<input type="text" name="txtTitle" placeholder="Enter the Title" required>
</td>
</tr>


<tr>
<th>
	Attactment
</th>
<td>
<input type="file" name="fuAttachment" required>
</td>
</tr>


<tr>
<th>
<input type="submit" value="Add Sample Paper" name="btnPaper">
</th>
<th>
</th>
</tr>
</table>
<p id="p1" style="color:red"/>
</form>
<?php
include 'footer.php';
?>