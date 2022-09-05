<?php session_start(); ?>
<html>
    <head><title>Full Details</title>
    <style>
        .image
        {
            text-align:center;
        }
        .infos
        {
            border:solid 2px;
            position:relative;
            left:26.5%;
            width:50%;
            height:50%;
            
        }
        .back
        {
            color:white;
            position:relative;
            left:26.5%;
            top:2%;
            width:100px;
            height:40px;
            background-color:#008CBA;
        }
        button:hover
        {
            color:black;
        }
        </style>
</head>
<body>
    <?php 
    if(!empty($_SESSION))
    {
        if($_SESSION['logged']==true)
        {
        $id = !empty($_GET['id'])?$_GET['id']:'';
      if($id)
      {    
        $conn=mysqli_connect('localhost','root','','municipality');
        if(!$conn)
        {
            die("Error:".mysqli_connect_error($conn));
        }
        $sql="select  citizen_info.cid,name,fname,gender,dob,email,contact,country,district,municipality,ward,house_info.hno
        from citizen_info,house_info 
        inner join residency 
        where citizen_info.cid=residency.cid 
        and house_info.hno=residency.hno
        and citizen_info.cid=$id";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        
        ?>
        <div class="image">
        <img src="metrologo.jpg" width="500px"/>
        </div>
    <table class="infos">
     <?php echo "<tr><td><b>Citizen ID :</b> $row[cid] </td><td><b>Father's Name :</b> $row[fname] </td></tr>
                <tr><td><b>Name :</b> $row[name] </td><td><b>Gender :</b> $row[gender] </td></tr>
                <tr><td><b>Date Of Birth:</b> $row[dob] </td><td><b>Email :</b> $row[email] </td></tr>
                <tr><td><b>Contact :</b> $row[contact] </td><td><b>Country:</b> $row[country] </td></tr>
                <tr><td><b> District :</b>  $row[district] </td><td><b> Municipality :</b>  $row[municipality] </td></tr>
                <tr><td><b> Ward no :</b>  $row[ward] </td><td><b> House Number :</b>  $row[hno] </td></tr>
        ";
    ?>
    </table>
<a href="dataview.php"><button class="back"><-Back</button></a>
     <?php  
    }
}
    }
    else
    {
        header('location:login.php');
    }
    ?>
</body>