<?php
$conn = oci_connect('esco','project123','localhost/XEPDB1') or die(oci_error());
echo " est conn";
if(!$conn){
    echo "There is an error to connect";
    exit;
}

?>