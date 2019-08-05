<?php
session_start();
include 'header.php';
?>


<?php
    
mysql_connect("localhost","root","") or die("Unable to connect with server");
mysql_select_db("dbjobpotal") or die("Error while connecting with database");

    $MemberId = $_SESSION["UserId"];
    $dspqry = "select * from registration,statetbl,citytbl,querytable 
               where registrationcityid = cityid and
               citystateid = stateid and
               RegistrationEmailId = EmailId and  RegistrationId = '$MemberId'";
    
    $resqry = mysql_query($dspqry);
    $row = mysql_fetch_row($resqry);
?>
<table  width="700px">
         
            <tr>
                <td class="style2" style="width: 75px;font-size:18px">
                    Email Id:
                </td>
                <td style="width: 75px;font-size:18px">
                   <?php echo $emailtest = $row[7];?>
				</td>
			</tr>
			<tr>
				<td class="style2" style="color:Blue;font-size:18px">
                   REPLY:
                </td>
</tr>
   </table>
   
<?php		
			$emailtest1=$emailtest;
			//$chk_email=mysql_query("select userquerytable from querytable where EmailId='$emailtest1'");
			$chk_email=mysql_query("select * from querytable where EmailId='$emailtest1'");
			 while($rw =  mysql_fetch_row($chk_email))
				{
					//print_r($rw);
					if($rw[7] == "Answered")
					{
						echo "<div style='font-size:16px'>Your Qyery '".$rw[4]."' For ComapnyId= ".$rw[6]." is  ".$rw[7]." By Employer <div style='color:red'>".$rw[8]."</div>"."</div>";
						//echo "<br>";
					}
					//echo $rw[0];
					//echo "<br>";
					
				}
					
					
					?>
               
          
       
           
     

