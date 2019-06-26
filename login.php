<?php
    session_start();
	
	mysql_connect("localhost","root","") or die("jj");
    mysql_select_db("dbjobpotal") or die("dfg");
	
	extract($_REQUEST);
	
    if(isset($_REQUEST['sub']))
        {
	       if($username=="" or $userpass=="")
	                {
		              $error="PLZ FILLS ALL FIELDS";
		            }
		  else
		  {
			  
			//$userpass1=md5($userpass);
			$userpass1=$userpass;
			$chk=mysql_query("select * from users where UserName='$username' and UserPassword='$userpass1'");
			//echo $chk;
			
			$n= mysql_num_rows($chk);
			
			if($n > 0)
			{
				$res = mysql_fetch_row($chk);
				$_SESSION['UserId']=$res[3];
			
				if($res[3] == 0)
				{
					header('location:admin/welcomeadmin.php');	
				}
				else
				{
					if($res[4] == "user")
					{
						header('location:user/qualification.php');
					}
					else if($res[4] == "company")
					{
                                            $fndqry = "select CompanyStatus from company where companyid='$res[3]'";
                                            $fndres = mysql_query($fndqry);
                                            $sts = mysql_fetch_row($fndres);
                                                
                                            if($sts[0] == "Active")
                                            {
						header('location:company/addsamplepaper.php');
                                            }
                                             else
                                            {
                                                $error="<script> alert('Not Activated By Admin');</script>";
                                            }
					}
				}
			}
			else
			{
			//$error="<script> alert('WRONG USERNAME OR PASSWORD');</script>";
            
			}
		  }
		}
?>
<form method="post" >
<table border="4" align="center">
<tr>
<th colspan="2">LOGIN HERE
</th>
<tr>
<tr>
<th>User Name</th>
<td><input type="text" name="username">
</td></tr>
<tr>
<th>
User Password
</th>
<td><input type="password" name="userpass">
</td>
</tr>
<tr>
<td colspan="2">
    <input type="checkbox" value="remember" name="chkremember">Remember Me ! 
    
    <input type="submit" name="sub" value="LOGIN">
   </td>
   
<tr>
    <td colspan="2">
       Register as <a href="registration.php">User</a> |
       <a href="companyinfo.php">Company</a>
       
   </td>
   </tr>
       <?php
	  if(isset($error))
	  {
		  echo $error;
	  } 
	?>

 
  </table>
</form>
