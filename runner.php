<?php

$file = fopen($argv[1],"r");
$group = [];
$current = [];

while(!feof($file))
{

   $line = trim(fgets($file));
   if ($line != '' && $line != feof($file)) {
        $current[] = $line;
        continue;
   }

   if ($line != '' && $line == feof($file)) {

    $current[] = $line;
    $group[] = $current;
    continue;

   }

   $group[] = $current;
   $current = [];

}

fclose($file);

$control = [];
$score = [];

#Lots of nested for loops, can be better
foreach ($group as $person) {
    foreach ($person as $answer) {
        $letters = str_split($answer);
        foreach ($letters as $letter) {
            if (!in_array($letter, $control)) {
                $control[] = $letter;   
            }
        }
    }
    $score[] = count($control);
    $control = [];
}

# Not necesarry, just to show the output.
foreach ($score as $sc => $val) {
    print_r('Group ' .($sc +1) . ' total = '. $val);
    print_r("\n");
}
