<?php

    ob_start();  
    session_start(); 
    $rands = rand(1000,9999); 
    header("Content-type: image/gif"); 
    // $_SESSION['reg_num_check'] = $rands; 
    session(['reg_num_check' => $rands]);
    $im = @imagecreate(40, 15); 
    imagecolorallocate($im, 240, 240, 240); 
    $loc = 2; 
    $color1=imagecolorallocate($im, 0, 0, 0); 
    for($i=0;$i<4;$i++){ 
        $color=imagecolorallocate($im, rand(0,255), rand(0,255), rand(0,255)); 
        imagestring($im, 4, ($loc+1), 1, substr($rands,$i,1), $color1); 
        imagestring($im, 4, $loc, 0, substr($rands,$i,1), $color); 
        $loc += 9; 
    } 
    Imagegif($im); 
    imagedestroy($im); 
    ob_end_flush(); 