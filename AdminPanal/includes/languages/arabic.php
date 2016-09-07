<?php
function language($phrase){
  static $lang =array(
  	// home page 
'MESSAGE'=>'اهلا',
'ADMIN' =>'ادمن'
// settings

  	);
  return $language[$phrase];
}

?>