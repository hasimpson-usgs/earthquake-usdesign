<?php


include_once '../../../src/conf/config.inc.php';

try {
  $lookupdatafactory = $LookupDataFactory($DB);
} catch (Exception $e) {
  print $e->getMessage() . "\n";
}
?>
