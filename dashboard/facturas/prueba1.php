<?php

for ($k = 0; $k < 5; $k++) {
$a[] = array(
    "uno" => 1 + $k,
    "dos" => 2 + $k,
    "tres" => 3 + $k,
    "diecisiete" => 17 + $k
);
}

//die(var_dump($a));

foreach ($a as $k) {
    echo $k["dos"];
}

?>