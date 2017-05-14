<?php
include("header.php") ?>
<?php
$conn = mysqli_connect("127.0.0.1", "root", "laizenan.123", "exp_use");
$psw_md5 = md5('Shanghai');
foreach ($_COOKIE as $key => $value) {
  if (!isset($_REQUEST[$key]))
  $_REQUEST[$key] = $value;
}
foreach ($_REQUEST as $key => $value) {
  # code...
  echo "<p>$key : $value</p>";
}
if ($conn)
{
  echo "Successed connect!\n";
  $uname = $_REQUEST["username"];
  $psw_md5 = md5($_REQUEST['password']);
  if ($_REQUEST['cmd'] == 'register')
  {
    if ($conn -> query("insert into users(username, psw_md5) VALUES ('$uname', '$psw_md5')"))
    {
      echo "Successed register!\n";
    }
    else {
      echo "User existed!\n";
    }
  }
  else if ($_REQUEST['cmd'] == 'login')
  {
    $res = $conn -> query("select * from users where username='$uname' and psw_md5='$psw_md5'");
    $qstr = "select * from users where username='$uname' and psw_md5='$psw_md5'";
    echo "<p> SQL query: $qstr </p>";
    if ($res -> num_rows)
    {
      foreach ($res as $item)
      {
        $sysuname =$item['username'];
        echo "<p> $sysuname </p>";
      }
      echo '<p>Login success</p> <p>Welcome, '. $sysuname. '</p>';
      if ($sysuname == 'admin')
      {
        echo '<hr>';
        $ret = $conn -> query('select * from users');
        foreach ($ret as $key => $value) {
          foreach ($value as $k2 => $v2)
            echo "<p>$k2 : $v2 </p>";
          # code...
        }
      }
    }
    else {
      echo '<p>Login failed, password not correct or no such a username!</p>';
    }
  }
  ?>
  <hr>
  <?php
  $conn -> close();
}
else
{
  die ('Cound not connect: '. mysql_error());
}
?>

<?php include("footer.php") ?>
