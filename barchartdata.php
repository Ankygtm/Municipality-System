<?php
$conn=mysqli_connect('localhost','root','','municipality');
            if(!$conn)
            {
                die("Error:".mysqli_connect_error($conn));
            }
            $ward0="select count(ward) as one from citizen_info,house_info inner join residency where citizen_info.cid=residency.cid and house_info.hno=residency.hno and ward=1";
            $ward1="select count(ward) as two from citizen_info,house_info inner join residency where citizen_info.cid=residency.cid and house_info.hno=residency.hno and ward=2";
            $ward2="select count(ward) as three from citizen_info,house_info inner join residency where citizen_info.cid=residency.cid and house_info.hno=residency.hno and ward=3";
            $ward3="select count(ward) as four from citizen_info,house_info inner join residency where citizen_info.cid=residency.cid and house_info.hno=residency.hno and ward=4";
            $ward4="select count(ward) as five from citizen_info,house_info inner join residency where citizen_info.cid=residency.cid and house_info.hno=residency.hno and ward=5";
            $ward5="select count(ward) as six from citizen_info,house_info inner join residency where citizen_info.cid=residency.cid and house_info.hno=residency.hno and ward=6";
            $resul0=mysqli_query($conn,$ward0);
           
            $resul1=mysqli_query($conn,$ward1);
            
            $resul2=mysqli_query($conn,$ward2);
            $resul3=mysqli_query($conn,$ward3);
           
            $resul4=mysqli_query($conn,$ward4);
            
            $resul5=mysqli_query($conn,$ward5);
            
            if($resul0 && $resul1 && $resul2 && $resul3 && $resul4 && $resul5 )
            {
                $ro1=mysqli_fetch_assoc($resul0);
                $ro2=mysqli_fetch_assoc($resul1);
                $ro3=mysqli_fetch_assoc($resul2);
                $ro4=mysqli_fetch_assoc($resul3);
                $ro5=mysqli_fetch_assoc($resul4);
                $ro6=mysqli_fetch_assoc($resul5);
                
               
            }
            else
           {
            die("error");
           }
?>