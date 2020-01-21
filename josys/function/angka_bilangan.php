<?php
function angka_bilangan($n) {
    // first strip any formatting;
    $n = (0+str_replace(",","",$n));
    
    // is this a number?
    if(!is_numeric($n)) return false;
    
    // now filter it;
    if($n>1000000000000) return round(($n/1000000000000),1).' Triliun';
    else if($n>1000000000) return round(($n/1000000000),1).' Miliar';
    else if($n>1000000) return round(($n/1000000),1).' Juta';
    else if($n>1000) return round(($n/1000),1).' Ribu';
    
    return number_format($n);
}

?>

