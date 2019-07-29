<?php
session_start();
include 'header.php';
?>

<?php

mysql_connect("localhost","root","") or die("Unable to connect with server");
mysql_select_db("dbjobpotal") or die("Error while connecting with database");
//extract();
if(isset($_REQUEST["btnquestion"]))
{
	
	$companyid=$_SESSION["UserId"];
	$year  = $_POST["drpYear"];
	$month = $_POST["drpMonth"];
	$question = $_POST["question"];
        $testname = $_POST["drpTest"];
	
	
	$qry= "insert into question(QuestionYear,QuestionMonth,QuestionTestName,QuestionName,QuestionCompanyId) 
            values('$year','$month','$testname','$question','$companyid')";
	
	mysql_query($qry);
	
}

if(isset($_REQUEST["qid"]))
{
	$questionid = $_REQUEST["qid"];
	
	$delqry = "delete from question where questionid = '$questionid'";
	mysql_query($delqry);
	
}



?>
<script>
	function GetYear(year)
	{
		window.location = "question.php?year="+year;
	}
	function GetMonth(month)
	{
		var year = document.getElementById("drpYear").value;
		window.location = "question.php?year="+year+"&month="+month;
	}
        function GetTest(test)
        {
            var year = document.getElementById("drpYear").value;
            var month = document.getElementById("drpMonth").value;
            window.location = "question.php?year="+year+"&month="+month+"&test="+test;
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
	
        	var test=document.getElementById("drpTest");
		if(test.selectedIndex == 0)
		{
			sts=false;
			msg +="select the test<br>";
			}
	
           document.getElementById("p1").innerHTML=msg;
	
					if(sts==true & sts==true & sts==true)
					return true;
					else
					return false;
	
		}
	
</script>


<form method="post" onsubmit="return validate()">

<table border="5">
<tr>
<th colspan="2">
QUESTION FORM
</th>
</tr>
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
    <td>
        Test Name
    </td>
    <td>
       <select name="drpTest" id="drpTest" onchange="GetTest(this.value)">
<option value="0">--Select--</option>
<?php
$MemberId=$_SESSION["UserId"];
                $dsp ="select * from eligibilitycriteria,company where eligibilitycriteriacompanyid=companyid and companyid='$MemberId'";
               
                 $res = mysql_query($dsp);
 
                 while($r = mysql_fetch_row($res))
                {
                     if(isset($_REQUEST["test"]) && $_REQUEST["test"] == $r[2])
                     {
                         echo "<option value=$r[2] selected>$r[2]</option>";
                     }
                     else
                     {
                         echo "<option value=$r[2]>$r[2]</option>";
                     }
                 }
                  
?>
</select>
    </td>
</tr>

<tr>
<td>
Question
</td>
<td>
<textarea name="question" required></textarea>
</td>
</tr>

<tr>
<th colspan="2">
<input type="submit" value="Submit Question" name="btnquestion">
</th>
</tr>
</table>





<?php
if(isset($_REQUEST["year"]) && isset($_REQUEST["month"]) && $_REQUEST["test"])
{
	$year = $_REQUEST["year"];
	$month = $_REQUEST["month"];
	$test = $_REQUEST["test"];
	
$memberid=$_SESSION["UserId"];

	$dspqry = "select * from question,company
			  where QuestionYear = '$year' and QuestionMonth='$month' and QuestionCompanyId=companyid and companyid='$memberid'";

	$dspres = mysql_query($dspqry);
	
        if(isset($dspres))
        {
            echo "<table border=5>
      <tr>
      <td> Question </td>
      <td> Test Name</td>
      <td> Actions </td>
      </tr>";
        
            
        	while($r = mysql_fetch_row($dspres))
	{
		echo "<tr>";
                echo "<td>$r[4]</td>";
		echo "<td>$r[3]</td>";
		echo "<td><a href=question.php?year=$year&month=$month&test=$test&qid=$r[0]>Delete</a></td>";
		echo "</tr>";
	}
        }
			  
}

?>
</table>
<p id="p1" style="color:red"/>
</form>