<?php
$conn=mysqli_connect('localhost','root','','municipality');
            if(!$conn)
            {
                die("Error:".mysqli_connect_error($conn));
            }
            $sql0="select count(gender) as male from citizen_info where gender='M'";
            $sql1="select count(gender) as female from citizen_info where gender='F'";
            $sql2="select count(gender) as other from citizen_info where gender='O'";
            $result0=mysqli_query($conn,$sql0);
           
            $result1=mysqli_query($conn,$sql1);
            
            $result2=mysqli_query($conn,$sql2);
            
            if($result && $result1 && $result2)
            {
                $row1=mysqli_fetch_assoc($result0);
                $row2=mysqli_fetch_assoc($result1);
                $row3=mysqli_fetch_assoc($result2);
               
            }
            else
           {
            die("error");
           }
?>