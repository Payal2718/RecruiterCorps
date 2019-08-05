<?php
session_start();
include 'header.php';

mysql_connect("localhost","root","") or die("jj");
mysql_select_db("dbjobpotal") or die("dfg");

if(isset($_REQUEST["cmpid"]))
{
    $companyid = $_REQUEST["cmpid"];
    $fndqry = "select * from company where companyid = '$companyid'";
    $fndres = mysql_query($fndqry);
     $res = mysql_fetch_row($fndres);
     $companyname = $res[1];
}

?>

<table>
    <tr>
        <td>Eligibility Criteria of  <?php if(isset($companyname)) echo $companyname; ?></td>
    </tr>
    
    <tr>
        <td>
            <?php 
                    if(isset($companyid)) 
                    {
                            $fndqry = "select * from eligibilitycriteria
                                       where
                                       eligibilitycriteriacompanyid= '$companyid'";
                            
                            $fndres = mysql_query($fndqry);
                            
                            $content = mysql_fetch_row($fndres);
                            
                            echo $content[1];
                            
                    }
            ?>
        </td>
    </tr>
    <tr width="300px">
        <td align="right">
            <?php
                    if(isset($companyid)) 
                    {
                        echo "<a href=taketest.php?cmpid=$companyid>Take Test</a>";
                    }
            ?>
        </td>
    </tr>
</table>
     