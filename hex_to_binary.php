<?php

$hex = "2f0d 1559 1a14 1701 120a 4a13 0c06 0e1c";
$bin = "";
$key = "fabqtl";
$key_hex = implode(unpack("H*", $key));
$key_bin = "";
$decrypt_bin = "";
$j = 0;
$convert = array(
    "0" => "0000",
    "1" => "0001",
    "2" => "0010",
    "3" => "0011",
    "4" => "0100",
    "5" => "0101",
    "6" => "0110",
    "7" => "0111",
    "8" => "1000",
    "9" => "1001",
    "a" => "1010",
    "b" => "1011",
    "c" => "1100",
    "d" => "1101",
    "e" => "1110",
    "f" => "1111"
);

for ($i = 0; $i <= (strlen($hex)-1); $i++) {
    if ($hex{$i} != " ") {
        $bin .= $convert[$hex{$i}];
    }
}

for ($i = 0; $i <= (strlen($key_hex)-1); $i++) {
    $key_bin .= $convert[$key_hex{$i}];
}

for ($i = 0; $i <= (strlen($bin)-1); $i++) {
    if ($j == strlen($key_bin)) {
        $j = 0;
    }
    if ($bin{$i} xor $key_bin{$j} == true) {
        $decrypt_bin .= "1";
    } else {
        $decrypt_bin .= "0";
    }
    $j++;
}

echo $decrypt_bin;

?>