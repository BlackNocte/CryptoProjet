<?php

$file = fopen("combinaison.txt", "r+");

$string = 'a';
while ($string != 'zzzzzz') {

    //fseek($file, 0, SEEK_END);
    $letter = $string++;
    print_r($letter);
    print_r("\n");
   fputs($file, $letter."\r\n");

}

fclose($file);