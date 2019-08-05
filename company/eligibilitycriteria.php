<?php
session_start();

include "header.php";

mysql_connect("localhost","root","");
mysql_select_db("dbjobpotal");

if(isset($_REQUEST["ecid"]))
{
    $eligibilitycriteriaid = $_REQUEST["ecid"];
    $delqry = "delete from eligibilitycriteria where eligibilitycriteriaid='$eligibilitycriteriaid'";
    mysql_query($delqry);
}

if(isset($_REQUEST["btninsert"]))
{
        //$attach=$_FILES['txtattach']['name'];
		
			 
		
			$companyid=$_SESSION["UserId"];
			
	$testname = $_POST["txtTestName"];
        $criteria= $_POST["txtCriteria"];
		
        
	//move_uploaded_file($_FILES["txtattach"]["tmp_name"],"../criteria/".$_FILES["txtattach"]["name"]);
	
	$insqry= "insert into eligibilitycriteria
            (eligibilitycriteriafile,eligibilitycriteriatestname,
            eligibilitycriteriacompanyid) 
            values
            ('$criteria','$testname','$companyid')";
        
	mysql_query($insqry);

		}
	
   

?>
<form method="post" enctype="multipart/form-data">
<table border=5>
    <tr>
        <th colspan="2"><h2>Set Eligibility Criteria</h2></th>
    </tr>
    
    <tr>
        <th>Test Name</th>
        <th><input type="text" name="txtTestName" placeholder="Enter the Test Name" required></th>
    </tr>
    
    

<tr>
<th>Eligibiltiy Criteria</th>
<td>
    <!--<input type="file" name="txtattach"> -->
    <textarea rows="5" cols="30" name="txtCriteria" placeholder="Enter the Eligibility Criteria" required></textarea>
</td>
</tr>

<tr>
<td><input type="submit" name="btninsert" value="INSERT"></td>
<td><input type="submit" name="btncancel"  value="CANCEL"></td>
</tr>

</table>
  
   
        <?php
		$MemberId=$_SESSION["UserId"];
                $dsp ="select * from eligibilitycriteria,company where eligibilitycriteriacompanyid=companyid and companyid='$MemberId'";
                $res = mysql_query($dsp);
                
                if(isset($res))
                {
                   echo "<table>
                    <tr>
                    <th>Test Name&nnbsp; &nbsp; &nbsp;</th>
                    <th>Eligibility Criteria&nbsp;&nbsp;&nbsp;</th>
                    <th>Actions&nbsp;&nbsp;&nbsp;</th>
                </tr>";
                while($r = mysql_fetch_row($res))
                {
                    echo "<tr>";
                    echo "<td>$r[2]</td>";
                    echo "<td>$r[1]</td>";
					
                    echo "<td><a href=eligibilitycriteria.php?ecid=$r[0]>Delete</a></td>";
                    echo "</tr>";
                }
            
                }
        ?>
        
    </table>
    
    
</form>