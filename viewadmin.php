
<?php
session_start();?>
<html>
    <head><title>View Admin</title>
    <style>
            .image
            {
                text-align:center;
            }
            .logout
            {

            color: white;
            background-Color: red;
            borderRadius: 8px;
            font-size:20px;

            }
            button:hover
        {
            color:black;
        }
        table 
        {
            border: solid 2px;
            border-colapse:collapse;
            width:50%;
            position:relative;
            left:25%;
            top:3%;
        }
        .delete
            {

            color: white;
            background-Color: red;
            borderRadius: 8px;
            font-size:20px;
            width:100%;
            }
            .changepassword
            {

            color: white;
            background-Color: green;
            borderRadius: 8px;
            font-size:20px;
            width:100%;
            }
            .addadmins
            {

            color: white;
            background-Color: green;
            borderRadius: 8px;
            font-size:20px;
                position:relative;
                left:25%;
            }
        
     </style>
</head>
<body>
<?php
if(!empty($_SESSION))
{
    if($_SESSION['adminlog']==true)
    {
$conn=mysqli_connect('localhost','root','','municipality');
if(!$conn)
{
    die("error:".mysqli_connect_error());
}
$sql="select * from admins";
$result=mysqli_query($conn,$sql);
if($result)
{?>
<div class="image"><img src="metrologo.jpg" /><a href="logout.php"><button class="logout">Logout</button></a></div>
<a href="adminpanel.php"><button class="addadmins">Add Admins</button></a>

<table border="2">
    <tr><th>Username</th><th>Password</th><th>User Type</th><th colspan="2">Action</th></tr>
<?php
   while($row=mysqli_fetch_assoc($result))
   {
        echo "<tr><td>$row[username]</td><td>$row[password]</td><td>$row[usertype]</td>
                <td><a href='changepassword.php?id=$row[id]'><button class='changepassword'>Change Password</button></a></td>
                <td><a href='deleteuser.php?id=$row[id]''><button class='delete'>Delete User</button></a></td>
        </tr>";
   }
}
?>
</table>

</body>
</html>
<?php
    }
}
else
{
    header('location:login.php');
}
?>