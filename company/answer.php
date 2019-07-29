<?php
session_start();
include 'header.php';
?>


<script>
    
	function GetYear(year)
	{
		window.location = "answer.php?year="+year;
	}
	function GetMonth(month)
	{
		var year = document.getElementById("drpYear").value;
		window.location = "answer.php?year="+year+"&month="+month;
	}
	
        
        function getTestName(tn)
        {
                var year = document.getElementById("drpYear").value;
		var month = document.getElementById("drpMonth").value;
                window.location = "answer.php?year="+year+"&month="+month+"&tnam="+tn;
        }
       
        
        function GetQuestionId(qid)
        {
            
                var year = document.getElementById("drpYear").value;
		var month = document.getElementById("drpMonth").value;
                var tname = document.getElementById("drpTestName").value;
                window.location = "answer.php?year="+year+"&month="+month+"&tnam="+tname+"&qid="+qid;
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
	var question=document.getElementById("drpQuestion");
		if(question.selectedIndex == 0)
		{
			sts=false;
			msg +="select the questionpaper<br>";
			}
	
           document.getElementById("p1").innerHTML=msg;
	
					if(sts==true & sts==true)
					return true;
					else
					return false;
	
		}
	
        
</script>


<?php

mysql_connect("localhost","root","") or die("Unable to connect with server");
mysql_select_db("dbjobpotal") or die("Error while connecting with database");

if(isset($_REQUEST["btnAnswer"]))
{
	$companyid=$_SESSION["UserId"];
	$year  = $_POST["drpYear"];
	$month = $_POST["drpMonth"];
	$question = $_POST["drpQuestion"];
        $answer =$_POST["txtAnswer"];
        $status = $_POST["rStatus"];
        
	$qry= "insert into answer(Year,Month,QuestionId,Answer,Status) 
               values
               ('$year','$month','$question','$answer','$status')";
	
	mysql_query($qry);
	
}

if(isset($_REQUEST["aid"]))
{
	$answerid = $_REQUEST["aid"];
	
	$delqry = "delete from answer where answerid = '$answerid'";
	mysql_query($delqry);
	
}



?>
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
 
<select name="drpTestName" id="drpTest" onChange="getTestName(this.value)">
<option value="0">----select----</option>
<?php


if(isset($_REQUEST["year"]) && isset($_REQUEST["month"]))
{
$year = $_REQUEST["year"];
$month = $_REQUEST["month"];
$memberid=$_SESSION["UserId"];
$qry= "select distinct QuestionTestName  from question,company where QuestionYear='$year'and QuestionMonth='$month' and QuestionCompanyId=companyid and companyid='$memberid'";

$res= mysql_query($qry);

while ($r=mysql_fetch_row($res))
{
	if($_REQUEST["tnam"] && $_REQUEST["tnam"] ==$r[0])
	{
	    echo "<option value='$r[0]' selected>$r[0]</option>";
	}
	else
	{
	    echo "<option value='$r[0]'>$r[0]</option>";
        }
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
<select name="drpQuestion" id="drpQuestion" onchange="GetQuestionId(this.value)">
<option value="0">--Select--</option>
<?php
if(isset($_REQUEST["year"]) && isset($_REQUEST["month"]) && isset($_REQUEST["tnam"]))
{
	$year = $_REQUEST["year"];
	$month = $_REQUEST["month"];
	$testname = $_REQUEST["tnam"];
	
	$dspqry = "select * from question
			  where questionyear = '$year' and questionmonth='$month'
                          and questiontestname='$testname'";
     
        $dspres = mysql_query($dspqry);
	
     
	while($r = mysql_fetch_row($dspres))
	{
		if(isset($_REQUEST["qid"]) && $_REQUEST["qid"]== $r[0])
		{
			echo "<option value=$r[0] selected>$r[4]</option>";
		}
		else
		{
			echo "<option value=$r[0]>$r[4]</option>";
		}
		
	}
}
?>
</select>
</td>
</tr>

<tr>
    <td>Answer</td>
    <td><textarea rows="5" cols="30" name="txtAnswer" required></textarea></td>
</tr>

<tr>
    <td>Status</td>
    <td>
        <input type="radio" name="rStatus" value="True" required>True
        <input type="radio" name="rStatus" value="False" required>False
    </td>
</tr>
<tr>
<th colspan="2">
<input type="submit" value="Submit Answer" name="btnAnswer">
</th>
</tr>


</table>



<table border="5">
<tr>
<td> Answer </td>
<td> Status </td>
<td> Actions </td>
</tr>

<?php
if(isset($_REQUEST["year"]) && isset($_REQUEST["month"]) && isset($_REQUEST["qid"]))
{
	$year = $_REQUEST["year"];
	$month = $_REQUEST["month"];
	$questionid = $_REQUEST["qid"];
	
	$dspqry = "select * from answer
			  where year = '$year' and month='$month'
			  and questionid= '$questionid'";

	$dspres = mysql_query($dspqry);
	
	while($r = mysql_fetch_row($dspres))
	{
		echo "<tr>";
		echo "<td>$r[4]</td>";
                echo "<td>$r[5]</td>";
		echo "<td><a href=answer.php?year=$year&month=$month&qid=$questionid&aid=$r[0]>Delete</a></td>";
		echo "</tr>";
	}
			  
}

?>
</table>
<p id="p1" style="color:red"/>
</form>