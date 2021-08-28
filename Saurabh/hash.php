<?php
  echo $hashPass = password_hash('123456', PASSWORD_DEFAULT);
  if(password_verify('123456', $hashPass)){
    echo '<br/>Yes';
  } else{
    echo '<br/>No';
  }
?>