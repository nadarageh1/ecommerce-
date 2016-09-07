<?php
function lang($phrase){
  static $lang =array(
  	// home page 
'MESSAGE'=>'WELCOME',
'ADMIN' =>'ADMINISTRATOR'
// setting

  	);
  return $lang[$phrase];
}

?>