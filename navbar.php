<html>
    <head><title>NavBar</title>
    <style>
        .navbar {
        position:absolute;
            top:0px;
            left:0px;
            right:0px;
            max-height:6%;
  padding: 20px;
  display: flex;
  flex-direction: row;
  align-items: center;
  max-width: 100%;
  margin: 0 auto;
  border-bottom: #f2f2f2;
  background-color:grey;
  position:fixed;
  z-index:1;
}
img
{
  position:relative;
  left:13%;
}
.navbar .links {
  margin-left: auto;
}
.navbar a {
  margin-left: 16px;
  text-decoration: none;
  padding: 6px;
}
.navbar .regular:hover {
  color: black;
}
.navbar .logout:hover {
  color: black;
}
 .logout
{
            color: white;
            background-Color: red;
            borderRadius: 8px;
            font-size:20px;
} 
.regular
{
    color:white;
    font-size:25px;
}

@media screen and (max-width: 600px) {
  .navbar a:not(:first-child) {display: none;}
  .navbar a.regular {
    float: right;
    display: block;
  }
}
    </style>
</head>
<body>
  
<nav class="navbar">
      <img src="metrologo.jpg" width="300px" height= "80px" />
      <div class="links">
        <a  href="dataview.php" class="regular">Home</a>
        <a href="userentry.php" class="regular"> Add Details</a>
        <a class="logout"  href="logout.php" >Logout</a>
      </div>
    </nav>
</body>