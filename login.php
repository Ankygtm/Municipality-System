<?php session_start(); ?>
<html>
    <head> <title>Home</title>
    <style>
           
        #d01{
            border:solid;
            position:absolute;
            left:35%;
            top:20%;
            width:500px;
            text-align:center;
        }
        img
        {
            height:200px;
            width:100%;
            postion:center;
            z-index:-5;
        }
        input
        {
            height:50px;
            width:75%;
            text-align:center;
        }
       
        .submit
        {
            background-color:green;
            font-weight:bold;
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
                
                height: 10px;   
            }
            select 
            {
                border-radius: 25px;
                border: 2px solid black;
                  padding: 20px; 
                 width: 20%;
                
            }
    </style>
</head>
<body>
  <?php
  if($_SERVER['REQUEST_METHOD']=="POST")  {
	process_form();
}else{
	show_form();
}
  function show_form($defaults= '' ,$errors='')
  {?> 
  <div id="d01">
    <img src="metrologo.jpg" />
  
      <form action="<?php echo $_SERVER['PHP_SELF'];?>"method="post" name="form">
       <label>Username</label><br />
          <input type="text" name="username" placeholder="Username" value="<?php echo !empty($defaults['username'])?$defaults['username']:'';?>"/>
          <br /><span><?php echo !empty($errors['username'])?$errors['username']:'';?></span><br /><hr />
         <label>Password</label><br />
          <input type="password" name="password" placeholder="Password" value="<?php echo !empty($defaults['password'])?$defaults['password']:'';?>"/>
          <br /><span><?php echo !empty($errors['password'])?$errors['password']:'';?></span><br />
          <label>User</label><br />
                <select name="usertype">
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                </select><br />
                <span> <?php echo !empty($errors['usertype'])?$errors['usertype']:""; ?></span><br />
          <br />
         <input class="submit" type="submit" value="LOGIN" />
  </div>
         <?php }
          function process_form()
          {
              $data 		=	$_POST;
              $errors 	= 	$defaults =	array();
          
              $defaults 	=	$data;
          
              if(!requiredValidation($data['username'])){
                  $errors['username']="*Username is required";
              }
              if(!requiredValidation($data['password']))
                  {
                      
                      $errors['password']="*Password is required";
              } 
             
              else
              {
                  $con = mysqli_connect('localhost','root','','municipality');
              $un="select * from admins where password='$data[password]' and username='$data[username]' and usertype='$data[usertype]'";
              $unique=mysqli_query($con,$un);
              $row=mysqli_fetch_assoc($unique);
              if(empty($row))
              {
                    $errors['password']="*Invalid username or password or user";
              }
                  
            }  
              if(empty($errors)) {
                  if($data['usertype']=="Admin")
                  {
                    $_SESSION['adminlog']=true;
                    header('location:viewadmin.php');
                  }
                  else
                  {
                    $_SESSION['logged']=true;
                      header('Location:dataview.php');
                  }
                  
              }else{
                  show_form($defaults,$errors);
              }
          }
        
          function requiredValidation($data){
              if(!empty($data)) {
                  return true;
              }else{
                  return false;
              }
          }  ?>