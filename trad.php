<?php
$filetrad = fopen("trad.txt", "r+");
$text = "";
$file_crypt = fopen('PK_hex.txt', 'r');
while(!feof($file_crypt)) {
    $line = fgets($file_crypt, 255);
    $text .= $line;
}
fclose($file_crypt);
$text = str_replace("\n","",$text);
$text = str_replace("\r","",$text);
$text = str_replace("\t","",$text);
$text = str_replace(" ","",$text);

$hex = $text;
$bin = "";
$decrypt_bin = "";
$tab_bin = array();
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
    $bin .= $convert[$hex{$i}];
}

$file = fopen('keys.txt', 'r');

$alphabet1 = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
$alphabet2 = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
$alphabet3 = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
$alphabet4 = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
$alphabet5 = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
$alphabet6 = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");

$key_compte = 0;
$indesirable = array('{','}','`');

while(!feof($file)) {
    $key = fgets($file, 255);

    $key_hex = implode(unpack("H*", $key));
    if (substr($key_hex, 12, 4) == "0d0a") {
        $key_hex = substr($key_hex, 0, -4);
    }
    $key_bin = "";

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

    $tab = 0;

    $tableau_bin = str_split($decrypt_bin, 48);

    $i = 0;
    $taille = count($tableau_bin);

    while($i != $taille)
    {
        echo pack('H*', base_convert($tableau_bin[$i], 2, 16)) . "\n";
        $tab_convert[$i] = pack('H*', base_convert($tableau_bin[$i], 2, 16));
        fputs($filetrad, $tab_convert[$i]);
        $i++;
    }
    array_push($tab_bin,$decrypt_bin);
    $decrypt_bin = "";

}


fclose($file);
fclose($filetrad)
//var_dump($tab_bin);

?>