<?php 
     session_start();?>
     <html>
        <head><title>Change Password</title>
        <style>
                .image 
                {
                    text-align:center;
                }
                .changepassword 
                {
                    border:solid 2px;
                    position:relative;
                    left:30%;
                    width:40%;
                    text-align:center;
                    top:3%;
                }
                label
                {
                    font-weight:bold;
                }
                .logout 
            {
            color: white;
            background-Color: red;
            borderRadius: 8px;
            font-size:20px;
           
            }
                input
            {
                border-radius: 25px;
                border: 2px solid black;
                 padding: 20px; 
                 width: 30%;
                height: 15px;   
            }
            .submit
          {
            background-color:green;
            color:white;
            font-size:20px;
           
          }
        </style>
</head>
<div class="image"><img src="metrologo.jpg" /> <a  href="logout.php"><button class="logout">Logout</button></a></div>
     <?php 
     if(!empty($_SESSION))
     {
        if($_SESSION['adminlog']==true)
        {
     
     if($_SERVER['REQUEST_METHOD']=="POST")  {
        $id= $_POST['id'];
         process_form($id);
     }else{
         show_form();
     
     }
    }
}
     else
     {
        header('Location:login.php');
     }

function show_form($defaults= '' ,$errors='',$id='')
{
    $id = !empty($_GET['id'])?$_GET['id']:$id; 
    if($id)
    {
       $con=mysqli_connect('localhost','root','','municipality');
       if(!$con)
       {
           die("Error in connection".mysqli_connect_error());
   
       }
       $sql="select * from admins where id=$id";
       $result=mysqli_query($con,$sql);
       $row=mysqli_fetch_assoc($result);
       ?>
    <div class="changepassword">
       <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
       <input type="hidden" name="id" value="<?php if(!empty($defaults['id'])){echo $defaults['id'];}else { echo $row['id'];}?>" />
            
           <label>New Password</label><br />
           <input type="password" name="password" value="<?php  echo !empty($defaults['password'])?$defaults['password']:'';?>" /><br />
           <span><?php echo !empty($errors['password'])?$errors['password']:'';?></span><hr />
            <input type="submit" value="Change Password" />
        
    </form>
    </div>
    <?php }}
        function process_form($id)
        {
            $data 		=	$_POST;
            $errors 	= 	$defaults =	array();
        
            $defaults 	=	$data;
        
            if(!requiredValidation($data['password'])){
                $errors['password']="*Field cannot be empty";
            }
            else if(strlen($data['password'])<=7)
            {
                $errors['password']="*Password should be more than 6 characters";
            }
            if(empty($errors)) {
                if(saveData($data)){
                    header('Location:viewadmin.php');
                }
            }else{
                show_form($defaults,$errors,$id);
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
                 $sql="UPDATE admins
                 SET password='$data[password]' where id=$data[id]";
                  $result = mysqli_query($con, $sql);
                  if($result){
                      return true;
                  }else{
                      die(mysqli_error($con));
                  }
              }
              ?>