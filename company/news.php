<?php
session_start();

include "header.php";

mysql_connect("localhost","root","");
mysql_select_db("dbjobpotal");
if(isset($_REQUEST["btninsert"]))
{
	$name=$_POST['txtnews'];
	$attach=$_FILES['txtattach']['name'];
        $date = $_POST["txtDate"];
        $companyid=$_SESSION["UserId"];
	
	move_uploaded_file($_FILES["txtattach"]["tmp_name"],"../news/".$_FILES["txtattach"]["name"]);
	
	$insqry= "insert into news(NewsTittle,NewsAttachment,NewsDate,NewsCompanyId) 
                            values('$name','$attach','$date','$companyid')";
							?>
					
		
		<script>
        alert ('news added'); 
        </script>
        <?php
        
	mysql_query($insqry);
}
?>
<html>
<head>
<script>
       function getCompanyId(id)
                {
                    window.location ="news.php?CompanyId="+id;
                }
</script>
</head>



<form method="post" enctype="multipart/form-data">
<table border=5>

<tr>
<th>NewsTitle</th>
<td><input type="text" name="txtnews"  placeholder="Enter the Newstitle" required>
</td>
</tr>
<tr>
    <th>Date</th>
    <td><input type="date" name="txtDate" placeholder="Enter the Date" required maxlengt="5"></td>
</tr>
<tr>
<th>News Attachment</th>
<td><input type="file" name="txtattach" required>
</td>
</tr>

    <tr>
    <td><input type="submit" name="btninsert" value="INSERT"></td>
   <td><input type="submit" name="btncancel"  value="CANCEL"></td>
    </tr>

</table>
  
</form>
<?php
include 'footer.php';
?>
</html>