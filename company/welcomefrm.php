<?php
session_start();
include 'header.php';
?>


<?php
    
mysql_connect("localhost","root","") or die("Unable to connect with server");
mysql_select_db("dbjobpotal") or die("Error while connecting with database");

    $MemberId = $_SESSION["UserId"];
    $dspqry = "select * from company,statetbl,citytbl where companycityid = cityid and
               citystateid = stateid and  companyid = '$MemberId'";
    
    $resqry = mysql_query($dspqry);
    $row = mysql_fetch_row($resqry);
?>
<table  width="700px">
            <tr>
                <td class="style2" style="width: 75px">
                   Welcome
                </td>
                <td>
                    <?php echo $row[1]; ?>
                </td>
            </tr>
            <tr>
                <td class="style2" style="width: 75px">
                    Address
                </td>
                <td>
                   <?php echo $row[2],"\x20",$row[20],"\x20", $row[18],"\x20",$row[17]; ?>
                </td>
            </tr>
            
            <tr>
                <td class="style2" style="width: 75px">
                    Phone
                </td>
                <td>
                    <?php echo $row[5]; ?>
                </td>
            </tr>
            <tr>
                <td class="style2" style="width: 75px">
                    Email Id
                </td>
                <td>
                    <?php echo $row[6]; ?>
                </td>
            </tr>
            <tr>
                <td class="style2" style="width: 75px">
                    Mobile
                </td>
                <td>
                    <?php echo $row[5]; ?>
                </td>
            </tr>
            <tr>
                <td class="style2" style="width: 75px">
                    PinCode
                </td>
                <td>
                    <?php echo $row[7]; ?>
                </td>
            </tr>
           
        </table>

<?php
include 'footer.php';
?>