<?php
include("header.php") ?>
<?php
$config_sql = parse_ini_file('config.ini');
$conn = mysqli_connect("127.0.0.1", $config_sql['user'], $config_sql['psw'], "exp_use");
if (!$conn)
{
  echo "<p style = 'color:red'> Your database is automatically created!</p>";
  $conn = mysqli_connect("127.0.0.1", $config_sql['user'], $config_sql['psw']);
  $conn -> query("create database exp_use");
  $conn -> select_db("exp_use");
  $conn -> query("CREATE TABLE users( user_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(25) NOT NULL, email VARCHAR(35) NOT NULL, psw_md5 VARCHAR(32) NOT NULL, UNIQUE(email) )");
}
//$conn = mysqli_connect("127.0.0.1", $config_sql['user'], $config_sql['psw'], "exp_use");
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
