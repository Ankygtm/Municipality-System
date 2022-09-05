<?php
function process_form()
        {
            $data 		=	$_POST;
            $errors 	= 	$defaults =	array();
        
            $defaults 	=	$data;
            $conn=mysqli_connect('localhost','root','','municipality');
            if(!$conn)
            {
                die("Error:".mysqli_connect_error($conn));
            }
           
            if(!requiredValidation($data['name'])){
                $errors['name']="*Name is required";
            }
            if(!requiredValidation($data['cno'])&&!requiredValidation($data['bcn'])){
                $errors['id']="*Unique ID required"; 
            } 
            else if(requiredValidation($data['cno'])&& requiredValidation($data['bcn']))
            {
                $errors['id']="*Insert only one id";
            }
            else if(strlen($data['cno'])>6 || strlen($data['bcn'])>6)
            {
                $errors['id']="*invalid id";
            }
            else if($data['cno']!==strval(intval($data['cno'])) && $data['bcn']!==strval(intval($data['bcn']))){
                $errors['id'] 	=	'*Id should be numbers';
            }
            else
            {
            $sql="select * from citizen_info where cid=$data[cno] or cid='$data[bcn]'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            if(!empty($row))
            {
                $errors['id']="*id exists ";
            }
            }
            if(empty($data['gender'])){
                $errors['gender']="*Gender required"; 
            } 
            if(!requiredValidation($data['fname'])){
                $errors['fname']="*Father's Name required"; 
            } 
            if(!requiredValidation($data['dob']))
                {
                    
                    $errors['dob']="*Please enter Date Of birth";
            } 
            if(!requiredValidation($data['ward']))
                {
                    
                    $errors['ward']="*Please enter ward number";
            } 
            if(!requiredValidation($data['hno']))
                {
                    
                    $errors['hno']="*Please enter House Number";
            } 
            
            
            
            if(!requiredValidation($data['contact']))
                {
                    
                    $errors['contact']="*Please enter your contact";
            } 
            else if($data['contact']!==strval(intval($data['contact']))){
                $errors['contact'] 	=	'*Contact should be numbers';
            }
            else{

             if(strlen($data['contact'])!=10)
            {
                $errors['contact'] 	=	'*Valid Contact required';
            }
        }
                
                if(!requiredValidation($data['email'])){
                    $errors['email'] 	=	'*Email is required';
                }else{
                    if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
                        $errors['email'] 	=	'*Invalid email format';
                    }
                }
            
            if(empty($errors)) {
                if(saveData($data)){
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
        }
        function saveData($data)
        {
           
            $conn=mysqli_connect('localhost','root','','municipality');
            if(!$conn)
            {
                die("Error:".mysqli_connect_error($conn));
            }
            if(!empty($data['cno']))
            {
            $sql= "insert into citizen_info values('$data[cno]','$data[name]','$data[fname]','$data[gender]','$data[dob]','$data[email]','$data[contact]')";
            }
            else
            {
                $sql="insert into citizen_info values('$data[bcn]','$data[name]','$data[fname]','$data[gender]','$data[dob]','$data[email]','$data[contact]')";
            }
           
            
            
            if(!empty($data['cno']))
            {
            $sql2="insert into  residency values('$data[cno]','$data[hno]')";
            }
            else
            {
                $sql2="insert into  residency values('$data[bcn]','$data[hno]')";
            }
            $result=mysqli_query($conn,$sql);
            $sql="select * from house_info where hno='$data[hno]' and ward='$data[ward]'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            if(empty($row))
            {
                $sql1="insert into  house_info(Country,District,Municipality,Ward,hno) values('$data[country]','$data[district]','$data[municipality]',$data[ward],'$data[hno]')";
                $result1=mysqli_query($conn,$sql1);
                if(!$result1)
                {
                    die("error".mysqli_error());
                }
            }
            $result2=mysqli_query($conn,$sql2);
            if(!$result && !$result2 )
            {
                die("error".mysqli_error());
            }
            else
            {
                return true;
            }
        }
        
    ?>