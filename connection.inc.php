<?php
  $server='localhost';
  $user='root';
  $passwd='AdminNii';
  $my_db='niiwireless';
  $conn_error='Error connecting.';
  $conn=@mysql_connect($server,$user,$passwd) or die('<strong>'.$conn_error.'</strong>');
  @mysql_select_db($my_db) or die('<strong>'.$conn_error.'</strong>');
?>