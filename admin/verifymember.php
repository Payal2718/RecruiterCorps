<?php
include 'HEADER.php';

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");


if(isset($_REQUEST["mid"]))
{
    $MemberId = $_REQUEST["mid"];
    
    if($_REQUEST["sts"] == "InActive")
    {
        $updqry = "update company set CompanyStatus = 'Active' where  CompanyId='$MemberId'";
        mysql_query($updqry);
    }
    if($_REQUEST["sts"] == "Active")
    {
        $updqry = "update company set CompanyStatus = 'NotActive' where  CompanyId='$MemberId'";
        mysql_query($updqry);
    }
        
}
    
    
?>
		<h1>Member Verification</h1>
        <table border="5">
            <tr>
            <tr>
                <?php 
                    $totcountqry = "select count(*) from company";
                    $totcountres = mysql_query($totcountqry);
                    $totcount = mysql_fetch_row($totcountres);
                    
                    $inactcountqry = "select count(*) from company where CompanyStatus='InActive'";
                    $inactcountres = mysql_query($inactcountqry);
                    $inactcount = mysql_fetch_row($inactcountres);
                    
                    $actcountqry = "select count(*) from company where CompanyStatus='Active'";
                    $actcountres = mysql_query($actcountqry);
                    $actcount = mysql_fetch_row($actcountres);
                ?>
                <th colspan="5">Total Members (<?php if(isset($totcount[0])) echo $totcount[0];?>) | NotActive Members (<?php if(isset($inactcount[0])) echo $inactcount[0]; ?>) | Active Members (<?php if(isset($actcount[0])) echo $actcount[0]; ?>)</th>
            </tr>
                <th>Name&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Address&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>EmailId&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Mobile&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Website Url&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Status&nbsp;&nbsp;&nbsp;&nbsp;</th>
            </tr>
            
            <?php
                $dspqry = "select * from company";
                $dspres = mysql_query($dspqry);
                while($row = mysql_fetch_row($dspres))
                {
                    echo "<tr>";
                    echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[1]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$row[2]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td>$row[6]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td>$row[7]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td><a href=$row[9] targe=_blank>$row[9]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                    echo "<td><a href=verifymember.php?mid=$row[0]&sts=$row[12]>$row[12]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                }
				
            ?>
        </table>
 <?php
 include 'footer.php';
 ?>       
    