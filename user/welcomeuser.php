<?php
session_start();
include 'header.php';
?>


<?php
    
mysql_connect("localhost","root","") or die("Unable to connect with server");
mysql_select_db("dbjobpotal") or die("Error while connecting with database");

    $MemberId = $_SESSION["UserId"];
    $dspqry = "select * from registration,statetbl,citytbl 
               where registrationcityid = cityid and
               citystateid = stateid and  RegistrationId = '$MemberId'";
    
    $resqry = mysql_query($dspqry);
	
    $row = mysql_fetch_row($resqry);
	//print_r($row);
?>
<table  width="700px">
            <tr>
                <td class="style2" style="width: 100px;font-size:16px;">
                   Welcome : 
                </td>
                <td style="font-size:16px;">
                    <?php echo $row[1]; ?>
                </td>
            </tr>
            <tr>
                <td class="style2" style="width: 100px;font-size:16px;">
                    Address : 
                </td>
                <td style="font-size:16px;">
                   <?php echo $row[2] ?>
                </td>
            </tr>
            
            <tr>
                <td class="style2" style="width: 100px;font-size:16px;">
                    Phone : 
                </td>
                <td style="font-size:16px;">
                    <?php echo $row[5]; ?>
                </td>
            </tr>
            <tr>
                <td class="style2" style="width: 100px;font-size:16px;">
                    Email Id : 
                </td>
                <td style="font-size:16px;">
                    <?php echo $row[7]; ?>
                </td>
            </tr>
            <tr>
                <td class="style2" style="width: 100px;font-size:16px;">
                    Mobile : 
                </td>
                <td style="font-size:16px;">
                    <?php echo $row[6]; ?>
                </td>
            </tr>
           
        </table>

