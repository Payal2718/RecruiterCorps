<?php
session_start();
include 'header.php';

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");

if(isset($_REQUEST["ctid"]) && $_REQUEST["click"])
{
    $companyid = $_REQUEST["ctid"];
    
    $dspqry = "select * from company where CompanyTypeId = '$companyid' and CompanyStatus='Active'";
    $dspres = mysql_query($dspqry);
}

?>

<script>
        function getcompanyid(cid)
        {
            window.location="viewcompanies.php?ctid="+cid;
        }
    
</script>
    
<form method="post" action="viewcompanies.php">
    <table>
        <tr>
            <td>Select Company Type</td>
            <td>
                <select name="drpcompany" onChange="getcompanyid(this.value)">
<option value="0">----select----</option>

<?php
$companyqry= "select * from companytype";
$companyres= mysql_query($companyqry);

while($r=mysql_fetch_row( $companyres))
{
        if(isset($_REQUEST["ctid"]) && $_REQUEST["ctid"] == $r[0])
        {
            echo "<option value=$r[0] selected>$r[1]</option>";
        }
        else
        {
            echo "<option value=$r[0]>$r[1]</option>";
        }
}

?>
</select>

            </td>
            
            <td>
                <?php
                if(isset($_REQUEST["ctid"]))
                {
                    $ctid = $_REQUEST["ctid"];
                    
                    echo "<a href=viewcompanies.php?ctid=$ctid&click=view>View Companies</a>";
                }
                ?>
            </td>
        </tr>
        
        <?php
        
        if(isset($dspres))
        {
            while($r  = mysql_fetch_row($dspres))
            {
                echo "<tr>";
                echo "<td><a href=$r[9]><img src=../companyimages/$r[11] width=200px height=100px></a></td>";
                echo "<td>$r[6]<br>$r[10]</td>";
                echo "<td><a href=viewcriteria.php?cmpid=$r[0]>Take Test</td>";
            }
        }
              
        
        
        ?>
        
        
    </table>
    
    
</form>


 