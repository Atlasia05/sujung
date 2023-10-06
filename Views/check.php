<?php
  use Art\Core\DB;

  $uid = $_GET['uid'];
  $check = DB::fetch("SELECT * FROM users WHERE uid = ?", [$uid]);
  
  if($check == "") {
    echo "able";
  }
  else {
    echo "unable";
  }
?>
