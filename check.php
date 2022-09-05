<form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="date" name="dob" />
<input type="submit" value="submit" />
</form>
<?php 
if(isset($_POST['dob']))
{
    echo $_POST['dob'];
}
?>