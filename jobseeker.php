<?php
    session_start();
	
	mysql_connect("localhost","root","") or die("jj");
    mysql_select_db("dbjobpotal") or die("dfg");
	
	extract($_REQUEST);
	
    if(isset($_REQUEST['sub']))
        {
	       if($username=="" or $userpass=="")
	                {
		              $error="<script> alert('PLZ FILLS ALL FIELDS');</script>";
		         
		            }
		  else
		  {
			  
			$userpass1=md5($userpass);
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
						header('location:user/welcomeuser.php');
					}
					else if($res[4] == "company")
					{
                                            $fndqry = "select CompanyStatus from company where companyid='$res[3]'";
                                            $fndres = mysql_query($fndqry);
                                            $sts = mysql_fetch_row($fndres);
                                                
                                            if($sts[0] == "Active")
                                            {
						header('location:company/welcomefrm.php');
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
			$error="<script> alert('WRONG USERNAME OR PASSWORD');</script>";
            
			}
		  }
		}
?>

<html>
<head>
<link media="all" rel="stylesheet" type="text/css" href="css/all.css" />
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.main.js"></script>

</head>


<body>
<div id="header">
		<div class="wrapper">
			<div class="holder">
				<blockquote>
				  <h1 class="logo"><a href="#">JobBoardTemplate</a></h1>
				  <form method="post" >
				    <table border="0" align="center" style="border:1px solid #000; border-radius:10px;">
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
			  </blockquote>
			</div>
			<ul id="nav">
				<ul>
				  <li><a href="index.php">Home</a></li>
				  <li><a href="jobseeker.php">Job Seekers</a></li>
				  <li><a href="employers.php">Employers</a></li>
				  <li><a href="career.php">Career advice</a></li>
				  <li><a href="faq.php">FAQ</a></li>
			  </ul>
			</ul>
		</div>
	</div>
   <div style="background:#FFF; width:1031px; margin-left:160px;">
<?php
	mysql_connect("localhost","root","") or die("jj");
    mysql_select_db("dbjobpotal") or die("dfg");
	
	$qry="select * from registration";
	$query=mysql_query($qry);
	echo "<table width=500 align=center border=1 bgcolor='#FFFFFF'><tr>";
	echo "<th>Registered user name</th>";
	echo "<th>User Image</th>";
	while($r=mysql_fetch_row($query))
	{
		$imgres=$r[11];
		//echo $imgres;
		echo "<tr>";
		echo "<td align=center>$r[1]</td>";
		echo "<td align='center'><img src=userpic/$imgres width=100px height=100px></td>";
		echo "</tr>";
	}
	echo "</table>";

?>
</div>
<div id="footer">
		<div class="holder">
			<div class="info">
				
			</div>
			<ul class="footer-nav">
				<ul>
				  <li><a href="index.php">Home</a></li>
				  <li><a href="jobseeker.php">Job seekers</a></li>
				  <li><a href="employers.php">Employers</a></li>
				  <li><a href="#">Career Advice</a></li>
				  <li><a href="faq.php">FAQ</a></li>
				  <li><a href="contact.php">Contact</a></li>
			  </ul>
			</ul>
		</div>
	</div>
     </body>



</html>