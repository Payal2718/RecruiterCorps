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
			$error="<script> alert('WRONG USERNAME OR PASSWORD');</script>";
            
			}
		  }
		}
?>
<?php

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");

 
if(isset($_REQUEST["btninsert"]))
{
	$companyname=$_REQUEST['companyname'];
	$companyaddress=$_REQUEST['companyaddress'];
	$companycityid=$_REQUEST['drpcity'];
	$companytypeid=$_REQUEST['drpcompany'];
	$companynumber=$_REQUEST['companynumber'];
	$emailid=$_REQUEST['emailid'];
	$companypin=$_REQUEST['txtcompanypin'];
	$companyfax=$_REQUEST['txtcompanyfax'];
	$companyprofile=$_REQUEST['companyprofile'];
	$companydescription=$_REQUEST['companydescription'];
	$companyimage=$_FILES['fimage']['name'];
	
	move_uploaded_file($_FILES["fimage"]["tmp_name"],"companyimages/".$_FILES["fimage"]["name"]);
	$status='InActive';
	$ownername=$_REQUEST['txtownername'];
	$ownerphone=$_REQUEST['txtownerphone'];
	
	$qry = 	"insert into company(CompanyName,CompanyAddress,
							     CompanyCityId,CompanyTypeId,
								 CompanyPhone,CompanyEmailId,
								 CompanyPinCode,CompanyFaxCode,
								 CompanyProfile,CompanyDescription,
								 CompanyImage,CompanyStatus,
								 CompanyRegistrationDate,
								 CompanyOwnerName,CompanyOwnerPhone)
						value
						('$companyname', '$companyaddress',
						'$companycityid', '$companytypeid',
						'$companynumber','$emailid',
						'$companypin', '$companyfax',
						'$companyprofile','$companydescription',
						'$companyimage','$status',
						NOW(),
						'$ownername','$ownerphone')";
	

       
	mysql_query($qry);
	
	$companyid = mysql_insert_id();


	$username = $_REQUEST["txtuser"];
	$userpassword = $_REQUEST["userpass"];
	
		 $userpass1=md5($userpassword);
		 
	mysql_query("insert into users (UserName,UserPassword,UserMemberId,UserRole) values ('$username','$userpass1','$companyid','company')");
	
	
	header("location:index.php");

        
}
?>

<html>
<head>
<link media="all" rel="stylesheet" type="text/css" href="css/all.css" />
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.main.js"></script>

	<script>
	function getStateId(id)
    {
	window.location="companyinfo.php?stateid="+id;
	}
</script>	
</head>


<body>
<div id="header">
		<div class="wrapper">
			<div class="holder">
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
														<option class="default">---select category---</option>
														
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
                            
						    <marquee direction="left" scrollamount="4">
                                    <?php
															$qry= "select * from company";
															$res= mysql_query($qry);
															//echo "<ul>";
															//echo $stateres;
															echo "<table>
																	<tr>";
															while ($r=mysql_fetch_row($res))
															{
																//echo "<li>";
																echo "<td>";
																echo "<img src=companyimages/$r[11] width=60px height=60px align='center'>";
															//echo $r[11];
															echo "<td>";
															echo $r[9]." ";
															echo $r[6];
															echo "</td>";
															//echo "<li>";
															}
															echo "</td>";
															echo "</tr></table>";
															//echo "<ul>";
														?>
										</marquee>
								</li>
							</ul>
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
							<?php
								$qry="select * from position";
								$res=mysql_query($qry);
								echo "<ul>";
								while($r=mysql_fetch_row($res))
								{
								     echo "<li>";
									echo $r[1]."<br>";
									echo "</li>";
									}
								echo "</ul>";
                                ?> 
                            
                            </div>
                            </div>
                            </div>
                            </div>				<div class="block">
					<div class="holder">
						<div class="frame">
							<div class="title">
								<h2><span>COMPANY REGISTRATION</span></h2>
							</div>
							<div class="list-holder">
								
								
								<form method="post" enctype="multipart/form-data">
<table width="600" border="0">

<tr>
<th> STATE</th>
<td>
<select name="drpstate" onChange="getStateId(this.value)">
<option value="0">----select----</option>
<?php
$cityqry= "select * from statetbl";
$cityres= mysql_query($cityqry);
//echo $stateres;
while ($r=mysql_fetch_row($cityres))
{
	if($_REQUEST["stateid"] && $_REQUEST["stateid"] ==$r[0])
	{
	    echo "<option value=$r[0] selected>	$r[1]</option>";
		}
		else
		{
			echo "<option value=$r[0]>$r[1]</option>";
			}
	}
?>
</select>
</td>
</tr>

<tr>
<th> CITY</th>
<td>
<select name="drpcity">
<option value="0">----select----</option>
<?php
if(isset($_REQUEST["stateid"]))
{
$stateid = $_REQUEST["stateid"];

$cityqry= "select * from citytbl where CityStateId = $stateid";
$cityres= mysql_query($cityqry);
//echo $stateres;
while ($r=mysql_fetch_row($cityres))
{
	if($_REQUEST["stateid"] && $_REQUEST["stateid"] ==$r[0])
	{
	    echo "<option value=$r[0] selected>	$r[1]</option>";
		}
		else
		{
			echo "<option value=$r[0]>$r[1]</option>";
			}
	}
}
?>
</select>
</td>
</tr>
<tr>
<th>Company Name</th>
<td><input type="text" name="companyname"></td>
</tr>
<tr>
<th>Company Address</th>
<td><textarea name="companyaddress"></textarea></td>
</tr>
<tr>
<th> COMPANY TYPE</th>
<td>
<select name="drpcompany" onChange="getcompanyid(this.value)">
<option value="0">----select----</option>

<?php
$companyqry= "select * from companytype";
$companyres= mysql_query($companyqry);

while($r=mysql_fetch_row( $companyres))
{
	echo "<option value=$r[0]>$r[1]</option>";
}

?>
	

</select>
</td>
</tr>
<tr>
<th>CompanyPhone</th>
<td><input type="number" name="companynumber"></td>
</tr>
<tr>
<th>CompanyemailId</th>
<td><input type="text" name="emailid"></td>
</tr>
<tr>
<th>CompanyPin Code</th>
<td><input type="number" name="txtcompanypin"></td>
</tr>
<tr>
<th>CompanyFax Code</th>
<td><input type="number" name="txtcompanyfax"></td>
</tr>
<tr>
<th>Company WebSite Url</th>
<td><input type="text" name="companyprofile"></td>
</tr>
<tr>
<th>Company Description</th>
<td><textarea name="companydescription"></textarea></td>
</tr>
<tr>
<th>Company Image</th>
<td><input type="file" name="fimage"></td>
</tr>

<tr>
<th>company owner name</th>
<td> <input type="text" name="txtownername"></td>
</tr>
<tr>
<th>company owner phonenumber</th>
<td><input type="number" name="txtownerphone"> </td>
</tr>
<tr>
<tr>
<th>
User Name
</th>
<td>
<input type="text" name="txtuser">
</td>
<tr> 
<th>User Password</th>
<td><input type="password" name="userpass" required></td>
</tr>
<tr>
<td><input type="submit" name="btninsert" value="Insert">
</td>
<td>
<input type="submit" name="btncancel" value="Cancel">
</td>
</tr>

</table>
</form>
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



