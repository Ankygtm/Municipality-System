<?php
function process_form($id)
        {
            $data 		=	$_POST;
            $errors 	= 	$defaults =	array();
            
            $defaults 	=	$data;
            
            $conn=mysqli_connect('localhost','root','','municipality');
            if(!$conn)
            {
                die("Error:".mysqli_connect_error($conn));
            }
            $sql="select * from citizen_info where cid='$data[c_id]'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            if(!requiredValidation($data['name'])){
                $errors['name']="*Name is required";
            }
            if(!requiredValidation($data['cno'])){
                $errors['id']="* ID required"; 
            } 
           
            else if(strlen($data['cno'])>6)
            {
                $errors['id']="*invalid id";
            }
            else if($data['cno']!==strval(intval($data['cno'])) ){
                $errors['id'] 	=	'*Id should be numbers';
            }
          
            else if(($data['cno']!=$data['c_id']) && !empty($row))
            {
                $errors['id']="*Id already exists";
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
                $conn = mysqli_connect('localhost','root','','municipality');
                 $sql="UPDATE citizen_info
                 SET cid='$data[cno]' ,
                    name='$data[name]',
                     gender='$data[gender]',
                     fname='$data[fname]',
                    dob='$data[dob]',
                    email='$data[email]',
                    contact='$data[contact]'
                 where cid=$data[c_id]";
                 $sql1="UPDATE residency
                      set  hno='$data[hno]' where cid='$data[cno]'";

                    $ret="select * from house_info where hno='$data[hno]' and ward=$data[ward]";
                    $result=mysqli_query($conn,$ret);
                $row=mysqli_fetch_assoc($result);
                if(empty($row))
            {
                $ret1="insert into  house_info(Country,District,Municipality,Ward,hno) values('$data[country]','$data[district]','$data[municipality]',$data[ward],'$data[hno]')";
                $resultr1=mysqli_query($conn,$ret1);
                if(!$resultr1)
                {
                    die("error".mysqli_error());
                }
            }
                $result2=mysqli_query($conn,$sql);
                $result3=mysqli_query($conn,$sql1);
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