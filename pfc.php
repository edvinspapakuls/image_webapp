<?php
include('includes/profile.inc.php');

#session_start();

if (!isset($_SESSION['user'])) {
    header("location: ./index.php");
    exit();
}

?>

<h1>Change your profile data</h1>

<?php
if ($pfp_status==0) {
echo '<div class="profile mr-3"><img src="files/def.png" alt="..." width="130" class="rounded mb-2 img-thumbnail">';
}
else {
    echo "<div class='profile mr-3'><img src='files/images/$pfp_status' alt='...' width='130' class='rounded mb-2 img-thumbnail'>";
}
?>

<a href="home.php" >Back</a>

<p>

<form action="includes/profile.inc.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit">
</form>
