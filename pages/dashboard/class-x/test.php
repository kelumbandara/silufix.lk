<?php

 $cars=array(
    array("volvo",43,56),
    array("bmw",54,678),
     array("bmw",54,678),
     array("bmw",54,678),
     array("bmw",54,678),
     array("bmw",54,678),
     array("bmw",54,678)
  );
  $mySubSize=sizeof($cars);
  
  echo $mySubSize;
  
  for ($i=0;$i<$mySubSize;$i++) 
  {
    foreach ($cars[$i] as $value) {
      echo "$value <br>";
    }
  }