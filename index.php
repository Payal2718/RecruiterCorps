<?php
     session_start();
	
	mysql_connect("localhost","root","") or die("jj");
    mysql_select_db("dbjobpotal") or die("dfg");
	
	extract($_REQUEST);
	
	
	if(isset($_POST["btnSubmit"]))
	{
		
	}
	
    if(isset($_REQUEST['sub']))
        {
	       if($username=="" or $userpass=="")
	                {
		              $error="<script> alert('PLZ FILLS ALL FIELDS');</script>";
		            }
		  else
		  {
			 if($userpass == "admin")
			 {
				 //202cb962ac59075b964b07152d234b70
				 $chk=mysql_query("select * from users where UserName='$username' and UserPassword='$userpass'");
				 
			 }
			 
			 else
			 {
			$userpass1=md5($userpass);
			
			$chk=mysql_query("select * from users where UserName='$username' and UserPassword='$userpass1'");
			//print_r($chk);
			 }
			$n= mysql_num_rows($chk);
			//echo "<br>".$n;
			
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
<link media="all" rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.main.js"></script>

</head>


<body>
<div id="header">
		<div class="wrapper">
			<div class="holder">
				<h1 class="logo"><a href="#">JobBoardTemplate</a></h1>
				<form method="post" >
                
<table border="0" align="center" class = "logintable tableloginext" >
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
   
<tr class="colorusercomp">
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

                
                
			</div>
			<ul id="nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="jobseeker.php">Job Seekers</a></li>
				<li><a href="employers.php">Employers</a></li>
				<li><a href="career.php">Career advice</a></li>
				<li><a href="faq.php">FAQ</a></li>
			</ul>
		</div>
	</div>
	<div id="main">
		<div class="wrapper">
			<div id="content">
				<div class="block">
					<div class="holder">
						<div class="frame">
							<div class="block-content">
								<div class="title">
									<h2>Job<span>Search</span></h2>
								</div>
								<form class="search-form" method="post">
									<fieldset>
										<div class="columns-holder">
											<div class="column">
												<div class="row">
													<label for="job-category">Select a job category</label>
													<select id="job-category" name="drpposition">
														<option class="default"> - - - - select category - - - -</option>
													</select>
												</div>
                                                <div class="row">
													<input type="submit" name="btn1" value="Search by category" class="submit" />
												</div>
											</div>
											<div class="column">
												<div class="row">
													<label for="location">Select Location</label>
													<select id="location" name="drplocation">
														<option class="default"> - - - - select city - - - -</option>
													
													</select>
												</div>
                                                <div class="row">
													<input type="submit" name="btn2" value="Search by location" class="submit" />
												</div>
												
											</div>
											<div class="column">
												<div class="row">
													<label for="employer">Select Employer</label>
													<select id="employer" name="drpemploye">
														<option class="default" value="0">---select company---</option>
														
													</select>
												</div>
												<div class="row">
													<input type="submit" name="btn3" value="Search by employer" class="submit" />
												</div>
											</div>
										</div>
										
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="block">
					<div class="holder">
						<div class="frame">
							<div class="title">
								<h2>Featured<span>categories</span></h2>
							</div>
                            
				
						</div>
					</div>
				</div>
				<div class="block">
					<div class="holder">
						<div class="frame">
                        
                       <div class="title">
								<h2>Browse by<span>category</span></h2>
							</div>
							<div class="list-holder">
                           
                            </div>
						</div>
					</div>
				</div>
				<div class="block">
					<div class="holder">
						<div class="frame">
							<div class="title">
								<h2>Browse by<span>city</span></h2>
							</div>
							<div class="list-holder">
                     
                      	</div>
						</div>
					</div>
				</div>
							
				<div class="block">
					<div class="holder">
						<div class="frame">
							<div class="title">
								<h2><span>Testimonials</span></h2>
							</div>
							<div class="blockquote-section">
								<blockquote>
									<q>
										<span class="quote-holder">
											<span></span>
											<span>
                                            </span>
										</span>
									</q>
									
								</blockquote>
								<blockquote>
									<q>
										<span class="quote-holder">
											<span>
                                            </span>
											<span>
                                            </span>
										</span>
									</q>
									
								</blockquote>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="sidebar">
				<div class="block">
					<div class="holder">
						<div class="frame">
							<div class="title">
								<h3>Find a<span>job</span></h3>
							</div>
							<div class="info-text">
								<img src="images/img07.jpg" alt="image description" width="99" height="105" class="alignright" />
								<p>Post your resume on this site</p>
							</div>
							
							<a href="registration.php" class="btn">Post your resume</a>
						</div>
					</div>
				</div>
				<div class="block">
					<div class="holder">
						<div class="frame">
							<div class="title">
								<h3>Post a<span>job</span></h3>
							</div>
							<div class="img-holder">
								<img src="images/img08.jpg" alt="image description" width="158" height="114" />
							</div>
                          
						</div>
					</div>
				</div>
				<div class="block">
					<div class="holder">
						<div class="frame">
							<div class="title">
								<h3><span></span></h3>
							</div>
							<div class="article">
								
							</div>
							
						</div>
					</div>
				</div>
				<div class="block">
					<div class="holder">
						<div class="frame">
							<div class="title">
								<h3>Top<span>employers</span></h3>
							</div>
							<div class="area">
								<ul class="sponsors-list">
								
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div id="footer">
		<div class="holder">
			<div class="info">
				
			</div>
			<ul class="footer-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="jobseeker.php">Job seekers</a></li>
				<li><a href="employers.php">Employers</a></li>
				<li><a href="career.php">Career Advice</a></li>
				<li><a href="faq.php">FAQ</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</div>

</body>



</html>