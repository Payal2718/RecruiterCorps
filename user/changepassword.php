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
      //  $status = "Password Updated Successfully";
    }
    //else
    //{
     //   $status = "Wrong Old Password";
    //}
}
?>
<script>
function validate()
{
	var msg="";
	var sts= true;
	var oldpassword=document.getElementById("pwdOldPassword").value;
			if (oldpassword==""||oldpassword==null)
			{
				sts=false;
				msg +="empty Old password field<br>";
				}
	
	var password=document.getElementById("pwdNewPassword").value;
			if (password==""||password==null)
			{
				sts=false;
				msg +="empty new password field<br>";
				}
				
				if(password.length>0)
				{
					if(!(password.length>=6&&password.length<=12))
					{
						sts=false;
						msg +="password length must b/w 6 to 12<br>";
						}
					}
				var confirmpassword=document.getElementById("pwdReenterNewPassword").value;
			if (confirmpassword==""||confirmpassword==null)
			{
				sts=false;
				msg +="empty  reenter password field<br>";
				}	
				if (password!=confirmpassword)
				{
					sts=false;
					msg +="mismatch password<br>";
					}
					document.getElementById("p1").innerHTML=msg;
					if(sts==true & sts==true )
					return true;
					else
					return false;
				
	
}
</script>

        <form method="post" action="changepassword.php" onsubmit="return validate()">
            <table border="5">
                <tr>
                    <th>Old Password</th>
                    <th><input type="password" name="pwdOldPassword"  id="pwdOldPassword"/></th>
                </tr>
                
                 <tr>
                    <th>New Password</th>
                    <th><input type="password" name="pwdNewPassword" id="pwdNewPassword"/></th>
                </tr>
                
                 <tr>
                    <th>Reenter New Password</th>
                    <th><input type="password" name="pwdReenterNewPassword" id="pwdReenterNewPassword"/></th>
                </tr>
                
                 <tr>
                    <th><input type="submit" name="btnSubmit" value="Submit"></th>
                    <th><input type="submit" name="btnCancel" value="Cancel"></th>
                </tr>
                
                <tr>
                    <th colspan="2"><?php if(isset($status)) echo $status; ?></th>
                </tr>
            </table>
            <p id="p1" style="color:red"/>
        </form>
 