<?php
session_start();
ob_start();

include 'header.php';

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");

if(isset($_REQUEST["cmpid"]))
{
    $_SESSION["CompanyId"] = $_REQUEST["cmpid"];
}

if(isset($_POST["btnCheckTest"]))
{
    
    $year = $_POST["hdnyear"];
    $month =$_POST["hdnmonth"];
    $testname = $_POST["hdntestname"];
    
    //correct answer array
    $_SESSION["stestname"]  = $testname;
    
    
    $correctarr = array();
    $icorrect = 0;
    
    $fndqry = "select Answer from answer where answer.QuestionId  
               in 
               (select QuestionId from Question where  QuestionYear= '$year' 
                        and 
                QuestionMonth='$month' and QuestionTestName='$testname') 
                        and
                status = 'true'";    
    
   $fndres = mysql_query($fndqry);
   
   while($res = mysql_fetch_row($fndres))
   {
       $correctarr[$icorrect] = $res[0];
       $icorrect++;
   }
   
   $_SESSION["correctarr"] = $correctarr;
    
   
   
   
    //attempt answer array
    $count = $_POST["hdncount"];
    
    $arr = array();
    $i = 0;
    for($j=0; $j<$count;$j++)
    {
        $radioname = "ranswer$i";
        $arr[$i] = $_POST[$radioname];
        $i++;
    }
    
    $_SESSION["attemptarr"] = $arr;
    
    //print_r($_SESSION["attemptarr"]);
    //print_r($_SESSION["correctarr"]);
    
    header("location:resultfrm.php?year=".$_POST["drpYear"]."&month=".$_POST["drpMonth"]."&tnam=".$_POST["drpTestName"]);
    
    
}
if(isset($_POST["hdncount"]))
{
     $count = $_POST["hdncount"];
}

if(isset($_REQUEST["year"]))
{
    $year  = $_REQUEST["year"];

    if(isset($_REQUEST["month"]))
    {
        $month = $_REQUEST["month"];
        
        if(isset($_REQUEST["tnam"]))
        {
            $testname = $_REQUEST["tnam"];
        }
        
    }
}
   
?>

        <script>
       function GetYear(year)
	{
		window.location = "taketest.php?year="+year;
	}
	function GetMonth(month)
	{
		var year = document.getElementById("drpYear").value;
		window.location = "taketest.php?year="+year+"&month="+month;
	}
	
        function getTestName(tn)
        {
                var year = document.getElementById("drpYear").value;
		var month = document.getElementById("drpMonth").value;
                window.location = "taketest.php?year="+year+"&month="+month+"&tnam="+tn;
        }
       
        function GetQuestionId(qid)
        {
                var year = document.getElementById("drpYear").value;
		var month = document.getElementById("drpMonth").value;
                 var tname = document.getElementById("drpTestName").value;
                window.location = "taketest.php?year="+year+"&month="+month+"&tnam="+tname+"&qid="+qid;
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
	
        	var tnam=document.getElementById("drpTestName");
		if(tnam.selectedIndex == 0)
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
           
            <h1>Judge Yourself</h1>
                    <table border="5">
               
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

<tr>
    <td>
        Test Name
    </td>
    <td>
 
<select name="drpTestName" id="drpTestName" onChange="getTestName(this.value)">
<option value="0">----select----</option>
<?php

if(isset($_REQUEST["year"]) && isset($_REQUEST["month"]))
{
$year = $_REQUEST["year"];
$month = $_REQUEST["month"];

$qry= "select distinct QuestionTestName from question where QuestionYear='$year'
               and QuestionMonth='$month'";
			   

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

                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" name="btnCheckTest" value="Check Test">
                    </td>
                </tr>
                   
              
            </table>
                   
            
             <table border="5" width="500px">
                 <?php
                 if(isset($_REQUEST["year"]) && isset($_REQUEST["month"]) && isset($_REQUEST["tnam"]))
                 {
                 $year = $_REQUEST["year"];
                 $month = $_REQUEST["month"];
                 $testname = $_REQUEST["tnam"];
                 
                 $qustdspqry = "select * from question where QuestionYear = '$year' 
                                                        and QuestionMonth= '$month'
                                                        and QuestionTestName = '$testname' order by questionid asc";
                 
                                                             
                 
                 $qustdspres = mysql_query($qustdspqry);
                 $i = 0;
                 while($qrow = mysql_fetch_row($qustdspres))
                 {
                     echo "<tr align=left>";
                     echo "<th>$qrow[4] <br>";
                         
                        $ansdspqry = "select * from answer where QuestionId='$qrow[0]'";
                        $ansdspres = mysql_query($ansdspqry);
                        while($arow = mysql_fetch_row($ansdspres))
                        {
                            $radioname = "ranswer$i";
                            echo "<input type=radio name=$radioname value='$arow[4]' required>$arow[4]<br>";
                        }
                     echo "</th></tr>";
                      $i++;
                 }
                 }
                 ?>
             </table>
             
             
            <input type="hidden" name="hdncount" value="<?php if(isset($i)) echo $i; ?>">
            
            <input type="hidden" name="hdnyear" value="<?php if(isset($year)) echo $year; ?>">
            
            <input type="hidden" name="hdnmonth" value="<?php if(isset($month)) echo $month; ?>">
            
            <input type="hidden" name="hdntestname" value="<?php if(isset($testname)) echo $testname; ?>">
         <p id="p1" style="color:red"/> 
        </form>
 