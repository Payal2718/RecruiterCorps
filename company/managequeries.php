<?php
session_start();
include 'header.php';
?>

<?php


mysql_connect("localhost","root","") or die("Unable to connect with server");
mysql_select_db("dbjobpotal") or die("Error while connecting with database");
 echo $UserscompId = $_SESSION["UserId"];
 if(isset($_REQUEST["qid"]) && isset($_REQUEST["emailid"]))
	{
		$queryid = $_REQUEST["qid"];
		$emailid = $_REQUEST["emailid"];
		
		$table = "<table>
						<tr>
							<td>
								<input type=textfield name=txtAnswer maxlength=100 required>
					
							</td>
						</tr>			
						<tr>
						<td>
						<input type=submit name=btnReply value=Reply >
						</td>
						</tr>
					</table>";
		
	}
	
	
	
	
	
	if(isset($_POST["btnReply"]))
	{
		  $queryid = $_POST["hdnQueryId"];
	      $emailid = $_POST["hdnEmailid"];
		   $reply = $_POST["txtAnswer"];
		  
		  
			  $updqry = "update querytable set Status = 'Answered', userquerytable = '$reply'
					where
					queryid= '$queryid'";
		//echo $updqry;
		mysql_query($updqry);?>
        <script>
		alert('query answered');
		</script><?php
}
	
	

?>
<form method="post">
<table border="4">
<td>
Name
</td>
<td>
Email
</td>
<td>
Query
</td>
<td>
Answer
</td>
</tr>
<?php
$qry = "select * from querytable WHERE STATUS='Unanswered' and CompanyId = '$UserscompId'";
$res = mysql_query($qry);
  while($r =  mysql_fetch_row($res))
{
	echo "<tr>";
	echo "<td>$r[1]</td>";
	echo "<td>$r[2]</td>";
	echo "<td>$r[4]</td>";
	

	echo "<td>
		
			<a href=managequeries.php?qid=$r[0]&emailid=$r[2]>$r[7]<a>
			
		</td>";
		
	echo "</tr>";
}
?>

</table>


<input type="hidden" name="hdnQueryId" value="<?php if(isset($queryid)) echo $queryid; ?>">

<input type="hidden" name="hdnEmailId" value="<?php  if(isset($emailid))echo $emailid; ?>">


<?php

if(isset($table))
{
	echo $table;
}
?>

</form>
<?php
include 'footer.php';
?>