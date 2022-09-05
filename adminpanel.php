<?php
session_start(); ?>
<html>
    <head>
        <title>Add admin</title>
        <style>
            .image 
            {
                text-align:center;
            }
            #d01
            {
                text-align:center;
                border:solid 2px;
                position:relative;
                left:25%;
                top:3%;
                width:50%;
            }
            label
            {
                font-weight:bold;
            }
            span
            {
                color:red;
            }
            input
            {
                border-radius: 25px;
                border: 2px solid black;
                 padding: 20px; 
                 width: 30%;
                height: 15px;   
            }
            select 
            {
                border-radius: 25px;
                border: 2px solid black;
                  padding: 20px; 
                 width: 15%;
                
            }
            .logout 
            {
            color: white;
            background-Color: red;
            borderRadius: 8px;
            font-size:20px;
           
            }
          .submit
          {
            background-color:green;
            color:white;
            font-size:20px;
           
          }
button:hover
{
    color:black;
}
        </style>
</head>
<?php
if(!empty($_SESSION))
{
if($_SESSION['adminlog']==true)
{
if($_SERVER['REQUEST_METHOD']=="POST")  {
	process_form();
}else{
	show_form();
}
}
}
else
{
    header('Location:login.php');
}
function show_form($defaults='' ,$errors='')
{
?>
<div class="image"><img src="metrologo.jpg" /> <a  href="logout.php"><button class="logout">Logout</button></a></div>
<div id="d01">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"name="form" >
<label>Username</label><br />
<input type="text" name="username" placeholder="Username" value="<?php  if(!empty($defaults['username'])){echo $defaults['username']; }?>"/><br />
<span><?php  if(!empty($errors['username'])){echo $errors['username'];}?></span><br />
<label>Password</label><br />
<input type="password" name="password" placeholder="Password" value="<?php  if(!empty($defaults['password'])){echo $defaults['password']; }?>"/><br />
<span><?php  if(!empty($errors['password'])){echo $errors['password'];}?></span><br />
<label>User</label><br />
        <select name="usertype">
            <option selected="selected" value="">Select</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
            
          
        </select><br /><span><?php echo !empty($errors['usertype'])?$errors['usertype']:'';?></span><br /><hr />
<input class="submit" type="Submit" value="Add Admin" />
</form>
</div>
<?php
}
 function process_form()
 {
     $data 		=	$_POST;
     $errors 	= 	$defaults =	array();
 
     $defaults 	=	$data;
     $con 	=	mysqli_connect('localhost','root','','municipality');
     if(!$con){
         echo "errors : ".mysqli_connect_error();
     }
    $sql="select * from admins where username='$data[username]'";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
             if(!requiredValidation($data['username']))
                 {
                     
                     $errors['username']="*UserName Required";
             } 
             else if(!empty($row))
             {
                $errors['username']="*UserName already exists";
             }
             if(!requiredValidation($data['password']))
             {
                 
                 $errors['password']="*Password Required";
             } 
             else if(strlen($data['password'])<=7)
             {
                 $errors['password']="*Password should be more than 6 characters";
             }
             if($data['usertype']=="")
             {
                 $errors['usertype']="*Please Select the User";
             }
            
            
            
            if(empty($errors))
            {
                if(saveData($data)){
                    header('Location:viewadmin.php');
                }
           } 
            
            else{
                show_form($defaults,$errors);
            }
        
        
           }
           function requiredValidation($data){
            if(!empty($data)) {
                return true;
            }else{
                return false;
            }
        }
        function saveData($data)
            {
                $con = mysqli_connect('localhost','root','','municipality');
                 $sql="INSERT INTO admins(username,password,usertype)
                VALUES ('$data[username]','$data[password]','$data[usertype]')";
                $result = mysqli_query($con, $sql);
                if($result){
                    return true;
                }else{
                    die(mysqli_error($con));
                }
            }
            
           
   ?>