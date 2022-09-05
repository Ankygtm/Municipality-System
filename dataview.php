<html>
    <head><title>Home</title>
    <style>
        .details
        {
            position:relative;
            top:15%;
            border-collapse:collapse;
            border:solid 2px;
            border-color:black;
            text-align:center;
            width:40%;
            
        }
        .delete
        {
            color: white;
            background-Color: red;
            borderRadius: 8px;
            font-size:20px;
        }
        .edit
        {
            color:white;
            background-Color: #4CAF50;
            borderRadius: 8px;
            font-size:20px;
        }
        .fulldetails
        {
            color: white;
            background-Color: #008CBA;
            borderRadius: 8px;
            font-size:20px;
        }
        button:hover
        {
            color:black;
        }
        .adddetails
        {
            position:relative;
            top:14%;
            color:white;
            background-Color: #4CAF50;
            borderRadius: 8px;
            font-size:20px;
        }
    </style>
<?php
session_start();
if(!empty($_SESSION))
{
    if($_SESSION['logged']==true)
    {
        $conn=mysqli_connect('localhost','root','','municipality');
        if(!$conn)
        {
            die("Error:".mysqli_connect_error($conn));
        }
       $sql="select citizen_info.cid,name,house_info.hno ,ward,gender
             from citizen_info,house_info 
             inner join residency 
             where citizen_info.cid=residency.cid 
             and house_info.hno=residency.hno";
         }
         $result=mysqli_query($conn,$sql);
         if(!$result)
         {
          
                die("Error:".mysqli_error());
            
         }
        include 'navbar.php';
        include 'piechart.php';
        include 'barchart.php';
         ?>
         <a  href="userentry.php"><button class='adddetails'>ADD DETAILS</button></a>
         <table class= "details" border="2">
            <tr><th>Citizen ID</th><th>Name</th><th>Gender</th><th>House Number</th><th>Ward</th><th colspan="3">Action</th></tr>
            
            <?php
                while($row=mysqli_fetch_assoc($result))
                {
                    echo "<tr>
                                <td>$row[cid]</td> <td>$row[name]</td><td>$row[gender]</td> <td>$row[hno]</td> <td>$row[ward]</td>
                                <td><a  href='edit.php?id=$row[cid]'><button class='edit'>EDIT</button></a></td>
                                <td><a href='delete.php?id=$row[cid]'><button class='delete'>Delete</button></a></td>
                                <td><a  href='fulldetails.php?id=$row[cid]'><button class='fulldetails'>Full Details</button></a></td>
                          </tr>";
                }
            ?>
           
        </table>
         <?php
}
else
{
    header('location:login.php');
}
?>