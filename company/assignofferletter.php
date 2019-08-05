<?php
session_start();
ob_start();
include 'header.php';
include 'email.php';

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");

if(isset($_SESSION["scandidatelist"]))
{
    $emailarr = array();
    
    $arrlist = $_SESSION["scandidatelist"];
    $result = implode(',', $arrlist);
    
    $dspqry = "select * from registration where  registrationid in ($result)";
    $dspres = mysql_query($dspqry);
    
    echo "<table>";
    echo "<tr>";
    echo "<th>Name&nbsp;</th>";
    echo "<th>Address&nbsp;</th>";
    echo "<th>Mobile&nbsp;</th>";
    echo "<th>Email&nbsp;</th>";
    echo "</tr>";
    
    while($r = mysql_fetch_row($dspres))
    {
       echo "<tr>";
       echo "<th>$r[1]&nbsp;</th>";
       echo "<th>$r[2]&nbsp;</th>";
       echo "<th>$r[6]&nbsp;</th>";
       echo "<th>$r[7]&nbsp;</th>";
       echo "</tr>";
       $emailarr[] = $r[7];
    }
    echo "</table>";
}

if(isset($_REQUEST["btnSubmit"]))
{
    
    
    $attach = $_FILES["fOfferLetter"]["name"];
    
    move_uploaded_file($_FILES["fOfferLetter"]["tmp_name"], 
                       "offerletter/".$_FILES["fOfferLetter"]["name"]);
    
    
    
    $CompanyId = $_SESSION["UserId"];
    $dspqry = "select * from company where companyid = '$CompanyId'";
    $resqry = mysql_query($dspqry);
    $row = mysql_fetch_row($resqry);
    
    $Companynameandowner= $row[1]." (".$row[14].")";
    
    for($i=0;$i<count($emailarr); $i++)
    {
    
    smtpmailer("$emailarr[$i]",'jobsearchonline14@gmail.com',
            "$Companynameandowner",'Offer Letter For Joining', 
            'See The Details Mentioned On The Attachment',
            "$attach");
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <br><br>
    Attach Offer Letter<input type="file" name="fOfferLetter" required>
    <br><br>
    <input type="submit" name="btnSubmit" value="Send Offer Letter To Email Id's">
</form>