<?php
session_start();
include 'HEADER.php';
?>


<?php
mysql_connect("localhost","root","") or die("Unable to connect with server");
mysql_select_db("dbjobpotal") or die("Error while connecting with database");


if(isset($_POST["btnSubmit"]))
{
    $UsersMemberId = $_SESSION["UserId"];
    $OldPassword = $_POST["pwdOldPassword"];
    $NewPassword = $_POST["pwdNewPassword"];
     
    $OldPassword = md5($OldPassword);
    $chkqry = "select * from Users where UserPassword='$OldPassword' and UserMemberId='$UsersMemberId'";
    $chkres = mysql_query($chkqry);
    if(mysql_num_rows($chkres) > 0)
    { 
        $NewPassword = md5($NewPassword);
        $updqry = "update Users set UserPassword='$NewPassword' where UserMemberId='$UsersMemberId'";
        mysql_query($updqry);
       $status = "Password Updated Successfully";
    }
   else
    {
       $status = "Wrong Old Password";
   }
}
?>


        <form method="post" action="changepasswordfrm.php" >
            <table border="5">
                <tr>
                    <th>Old Password</th>
                    <th><input type="password" name="pwdOldPassword" id="pwdOldPassword" placeholder="Enter the Old Password" required/></th>
                </tr>
                
                 <tr>
                    <th>New Password</th>
                    <th><input type="password" name="pwdNewPassword" id="pwdNewPassword" placeholder="Enter the New Password" required /></th>
                </tr>
                
                 <tr>
                    <th>Reenter New Password</th>
                    <th><input type="password" name="pwdReenterNewPassword" id="pwdReenterNewPassword" placeholder="Reenter New Password" required /></th>
                </tr>
                
                 <tr>
                    <th><input type="submit" name="btnSubmit" value="Submit"></th>
                    <th><input type="submit" name="btnCancel" value="Cancel"></th>
                </tr>
                
                <tr>
                    <th colspan="2"><?php if(isset($status)) echo $status; ?></th>
                </tr>
            </table>
        </form>
 