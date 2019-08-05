<?php
session_start();
ob_start();

include "HEADER.php";

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");


if(isset($_REQUEST["year"]) && isset($_REQUEST["month"]) && isset($_REQUEST["tnam"]))
{
    $year = $_REQUEST["year"];
    $month = $_REQUEST["month"];
    $testname = $_REQUEST["tnam"];

 
     $correctarr = array();
     $attemptarr = array();
     
    if(isset($_SESSION["correctarr"]))
    {
      $correctarr =  $_SESSION["correctarr"];   
    }
    
    if(isset($_SESSION["attemptarr"]))
    {
        $attemptarr = $_SESSION["attemptarr"];
    }
    
    $totalquestion = count($correctarr);
    
    $correctanswer = 0;
    
    for($i =0; $i<$totalquestion; $i++)
    {
        if($correctarr[$i] == $attemptarr[$i])
        {
            $correctanswer++;
        }
    }
    
    $wronganswer = $totalquestion - $correctanswer;
    
              
    $qustdspqry = "select * from question where QuestionYear='$year'
                                                             and QuestionMonth = '$month'
                                                                  and QuestionTestName='$testname'";
                 
     $qustdspres = mysql_query($qustdspqry);
     
    
     
    

if(isset($_POST["btnSubmit"]))
{
 $year = $_POST["hdnyear"];
 $month = $_POST["hdnmonth"];
 $testname = $_POST["hdntestname"];
 $UsersMemberId = $_SESSION["UserId"];
 $CompanyId = $_SESSION["CompanyId"];
 $j =0;
 
 
 while($qrow = mysql_fetch_row($qustdspres))
 {
     $insqry = "insert into result(resultyear,resultmonth,resultquestionname,resulttestname,
                                   resultattemptans,resultcorrectans,resultuserid,resultcompanyid)
                                   values
                                   ('$year','$month','$qrow[4]','$testname',
                                   '$attemptarr[$j]','$correctarr[$j]','$UsersMemberId','$CompanyId')";
     mysql_query($insqry);
    
     $j++;
 }

 header("location:welcomeuser.php");
 
}


    $i = 0;
     echo "<table cellspacing=10px>";
     echo "<tr>";
     echo "<th colspan=3>Total Questions :- $totalquestion |Correct Answers :- $correctanswer | Wrong Answers   :- $wronganswer </th>";
     echo "</tr>";
     
     echo "<tr>";
     echo "<td>Questions</td>";
     echo "<td>Attempt Answer</td>";
     echo "<td>Correct Answer</td>";
     echo "</tr>";
     
     while($qrow = mysql_fetch_row($qustdspres))
     {
     echo "<tr align=left>";
     echo "<td>$qrow[4]<td>";
     echo "<td>$attemptarr[$i]</td>";
     echo "<td>$correctarr[$i]</td>";
     echo "</tr>";
      $i++;
     }
    
    
}
 

?>

<form method="post">
 <tr>
     <td align=right colspan=3><input type=submit name=btnSubmit value='Submit Result'></td>
     </tr>
   </table>

            <input type="hidden" name="hdnyear" value="<?php if(isset($year)) echo $year; ?>">
            
            <input type="hidden" name="hdnmonth" value="<?php if(isset($month)) echo $month; ?>">
            
            <input type="hidden" name="hdntestname" value="<?php if(isset($testname)) echo $testname; ?>">
            
            
            </form>