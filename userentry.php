<?php session_start(); ?>
<html>
    <head><title>Citizen Entry</title>
    <style>
            span
            {
                color:red;
            }
            label
            {
                font-weight:bold;
                color:black;
                position:relative;
                left:2%;
            }
     
            .userentry
            {
                position:absolute;
                top:12%;
                left:13.5%;
                border:solid 2px;
                width:75%;
                background-color:grey;
                
            }
            input
            {
                border-radius: 25px;
                border: 2px solid black;
                 padding: 20px; 
                 width: 30%;
                height: 15px;   
            }
          .gender
            {
                width:3%;
            }
            .formpart
            {
                position:relative;
                left:5%;
            }
            select
            {
                position:relative;
                left:2%;
            }
            .submit
            {
                background-color:green;
                text-align:center;
                color:white;
                width:150px;
            }
            select 
            {
                border-radius: 25px;
                border: 2px solid black;
                  padding: 20px; 
                 width: 20%;
                
            }
            body
            {
                background-color:rgba(0,0,0,.2);
                z-index:-1;
                
            }
          
    </style>
</head>
<body>
   
    <?php
     if(!empty($_SESSION))
     {
     if($_SESSION['logged']==true)
     {
    include 'navbar.php';
         include 'entryprocess.php';
        
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            process_form();
        }
        else
        {
            show_form();
        }
    }
}
else
{
    header('location:login.php');
}

        function show_form($defaults= '' ,$errors='')
        {
            ?>
            <div class="userentry">
                    <div class="formpart">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <h2 >PERSONAL DETAILS</h2>
                <span>(Note:If below 16 enter Birth Certificate Number)</span><br />
                <label>Citizenship Number</label><br />
                <input type="text" name="cno" placeholder="Citizenship no" value="<?php echo !empty($defaults['cno'])?$defaults['cno']: ''; ?>" />
                <span> <?php echo !empty($errors['cno'])?$errors['cno']:""; ?></span><br />
                <span> <?php echo !empty($errors['id'])?$errors['id']:""; ?></span><br />
                
                <label>Birth Certificate Number</label><br />
                <input type="text" name="bcn" placeholder="Birth Certificate Number" value="<?php echo !empty($defaults['bcn'])?$defaults['bcn']: ''; ?>" />
                <span> <?php echo !empty($errors['bcn'])?$errors['bcn']:""; ?></span><br />
               <br />
                <label>Full Name</label><br />
                <input type="text" name="name" placeholder="Full Name" value="<?php echo !empty($defaults['name'])?$defaults['name']: ''; ?>" />
                <span> <?php echo !empty($errors['name'])?$errors['name']:""; ?></span><br />
                <br />
                <label>Gender</label><br />

                <?php  if(!empty($defaults['gender'])&&$defaults['gender']=="M")
                {
                ?>
                <input class="gender" type="radio" name="gender" value="M" checked />Male
                <?php } else
                { ?>
                <input class="gender" type="radio" name="gender" value="M"  />Male
                 <?php } 
                  if(!empty($defaults['gender'])&&$defaults['gender']=="F")
                {
                ?>
                <input class="gender" type="radio" name="gender" value="F" checked />Female
                <?php } else
                { ?>
                <input class="gender" type="radio" name="gender" value="F"  />Female
                 <?php } 
                  if(!empty($defaults['gender'])&&$defaults['gender']=="O")
                  {
                  ?>
                  <input class="gender" type="radio" name="gender" value="O" checked />Other
                  <?php } else
                  { ?>
                  <input class="gender" type="radio" name="gender" value="O"  />Other
                   <?php } ?>
                
            
                <span> <?php echo !empty($errors['gender'])?$errors['gender']:""; ?></span><br />
                <br />
                <label>Father's Name</label><br />
                <input type="text" name="fname" placeholder="Father's Name" value="<?php echo !empty($defaults['fname'])?$defaults['fname']: ''; ?>" />
                <span> <?php echo !empty($errors['fname'])?$errors['fname']:""; ?></span><br />
                <br />
                <label>Date Of Birth</label>
                <br />
                <input type="date" name="dob"  value="<?php echo !empty($defaults['dob'])?$defaults['dob']: ''; ?>" />
                <span> <?php echo !empty($errors['dob'])?$errors['dob']:""; ?></span><br />
                <br />
                <span>(Note:Email of any member of family)</span><br />
                <label>Email</label><br />
                <input type="email" name="email" placeholder="eg:abc@gmail.com" value="<?php echo !empty($defaults['email'])?$defaults['email']: ''; ?>" />
                <span> <?php echo !empty($errors['email'])?$errors['email']:""; ?></span><br />
                <br />
                <label>Contact</label><br />
                <input type="text" name="contact" placeholder="Contact" value="<?php echo !empty($defaults['contact'])?$defaults['contact']: ''; ?>" />
                <span> <?php echo !empty($errors['contact'])?$errors['contact']:""; ?></span><br /><hr />
                <h2 class="entryheads">Location Details</h2>
                <label>Country</label>  <br />
                <select name="country">
                    <option value="Nepal">Nepal</option>
                </select><br />
                <label>District</label><br />
                <select name="district">
                    <option value="Kathmandu">Kathmandu</option>
                </select><br />
                <label>Municipality</label><br />
                <select name="municipality">
                    <option value="Kathmandu Metropolitan">Kathmandu Metropolitan</option>
                </select><br />
                <label>Ward</label><br />
                <select name="ward" >
                <option selected="selected" value="<?php echo !empty($defaults['ward'])?$defaults['ward']: ''; ?>">
                    <?php echo !empty($defaults['ward'])?$defaults['ward']: 'Select'; ?>
                </option>
                    <?php 
                    for($i=1; $i<=6;$i++)
                    {
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $i ?> </option>
                    <?php } ?>
                </select><br />
                <span> <?php echo !empty($errors['ward'])?$errors['ward']:""; ?></span><br />
                <br />
                <label>House No</label><br />
                <input type="text" name="hno" placeholder="House Number" value="<?php echo !empty($defaults['hno'])?$defaults['hno']: ''; ?>" />
             
                <span> <?php echo !empty($errors['hno'])?$errors['hno']:""; ?></span><br />
              
                <hr />
                <input class="submit" type="Submit" value="ADD DETAILS" />
                </form>
                    </div>
             </div>
            <?php
        }
        
       ?>

</body>
</html>