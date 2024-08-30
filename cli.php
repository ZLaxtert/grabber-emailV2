<?php
/*==========> INFO 
 * CODE     : BY ZLAXTERT
 * SCRIPT   : GRABBER EMAIL & PASSWORD
 * VERSION  : 2
 * TELEGRAM : t.me/zlaxtert
 * BY       : DARKXCODE
 */

require_once "function/function.php";

echo banner();
echo banner2();
enterCount:
echo "\n\n$WH [$BL+$WH]$BL COUNT $WH($DEF MAX:$YL 1M$WH )$GR >> $WH";
$count = trim(fgets(STDIN));
if (!preg_match("/^[0-9]*$/", $count)) {
    echo "\n $WH [$RD!$WH]$YL PLEASE INPUT NUMBER ONLY$WH [$RD!$WH]\n";
    goto enterCount;
}
if ($count > 1000000) {
    echo "\n $WH [$RD!$WH]$YL MAX 1M$WH [$RD!$WH]\n";
    goto enterCount;
}
if ($count < 1) {
    echo "\n $WH [$RD!$WH]$YL MIN 1$WH [$RD!$WH]\n";
    goto enterCount;
}

entertype:
echo "\n         [$GR+$WH]$BL TYPE$WH [$GR+$WH] $WH
 [$GR 1 $WH]$BL EMAIL:PASS $WH       [$GR 2 $WH]$BL USER:PASS $WH
 [$GR 99 $WH]$BL EXIT  $WH

 [$YL+$WH]$BL CHOOSE$GR >> $WH";
$typegrabber = trim(fgets(STDIN));
if ($typegrabber == 1) {
    $type_grabber = "email";
} else if ($typegrabber == 2) {
    $type_grabber = "username";
} else if ($typegrabber == 99) {
    echo "\n\n [$BL!$WH] THANKS FOR USING [$BL!$WH]\n\n";
    exit();
} else {
    echo "\n\n [$RD!$WH] CHOOSE NOT FOUND [$RD!$WH]\n\n";
    goto entertype;
}

entergate:
echo "\n         [$GR+$WH]$BL GATEWAY$WH [$GR+$WH] $WH
 [$GR 1 $WH]$BL GATEWAY 1 $WH       [$GR 2 $WH]$BL GATEWAY 2 $WH
 [$GR 3 $WH]$BL GATEWAY 3 $WH       [$GR 4 $WH]$BL GATEWAY 4 $WH
 [$GR 5 $WH]$BL GATEWAY 5 $WH       [$GR 6 $WH]$BL GATEWAY 6 $WH
 [$GR 7 $WH]$BL GATEWAY 7 $WH       [$GR 8 $WH]$BL GATEWAY 8 $WH
 [$GR 9 $WH]$BL GATEWAY 9 $WH       [$GR 10 $WH]$BL GATEWAY 10 $WH
 [$GR 99 $WH]$BL EXIT  $WH

 [$YL+$WH]$BL CHOOSE$GR >> $WH";
$gateee = trim(fgets(STDIN));
if ($gateee == 1) {
    $gateWay = "1";
} else if ($gateee == 2) {
    $gateWay = "2";
} else if ($gateee == 3) {
    $gateWay = "3";
}else if ($gateee == 4) {
    $gateWay = "4";
} else if ($gateee == 5) {
    $gateWay = "5";
} else if ($gateee == 6) {
    $gateWay = "6";
} else if ($gateee == 7) {
    $gateWay = "7";
} else if ($gateee == 8) {
    $gateWay = "8";
}else if ($gateee == 9) {
    $gateWay = "9";
} else if ($gateee == 10) {
    $gateWay = "10";
} else if ($gateee == 99) {
    echo "\n\n [$BL!$WH] THANKS FOR USING [$BL!$WH]\n\n";
    exit();
} else {
    echo "\n\n [$RD!$WH] CHOOSE NOT FOUND [$RD!$WH]\n\n";
    goto entergate;
}

$no = 0;
$live = 0;
$die = 0;
echo PHP_EOL . PHP_EOL;

for ($i=0; $i < $count; $i++) { 

    $no++;
    $api = "https://api.darkxcode.site/other/grabber-email/V2/?submit=1&count=1&gateway=".$gateWay."&type=".$type_grabber;
    // CURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $x = curl_exec($ch);
    curl_close($ch);
    $js = json_decode($x, TRUE);

    $msg = $js['data']['msg'];
    $msg = strtoupper($msg);
    $ress = $js['data']['lists'];

    if(strpos($x, '"success graber email & password !"')){
        $live++;
        echo "[$RD$no$DEF/$GR$count$DEF]$CY GETTING$DEF =>$WH $ress$DEF | [$YL GATEWAY$DEF: $MG$gateWay$DEF ] | [$YL MSG$DEF: $MG$msg$DEF ] | BY$CY DARKXCODE$DEF (V2)" . PHP_EOL;
        save_file("result/emailpass.txt",$ress);
    }else if(strpos($x, '"success graber username & password !"')){
        $live++;
        echo "[$RD$no$DEF/$GR$count$DEF]$CY GETTING$DEF =>$WH $ress$DEF | [$YL GATEWAY$DEF: $MG$gateWay$DEF ] | [$YL MSG$DEF: $MG$msg$DEF ] | BY$CY DARKXCODE$DEF (V2)" . PHP_EOL;
        save_file("result/userpass.txt",$ress);
    }else{
        $die++;
        echo "[$RD$no$DEF/$GR$count$DEF]$RD FAILED GRABBER$DEF | BY$CY DARKXCODE$DEF (V2)" . PHP_EOL;
    }


    
}

//============> END

echo PHP_EOL;
echo "================[SUCCESS]================" . PHP_EOL;
echo " SUCCESS GRABBER      : " . $live . PHP_EOL;
echo " FAILED GRABBER       : " . $die . PHP_EOL;
echo "======================================" . PHP_EOL;
echo "File saved in folder 'result/' " . PHP_EOL . PHP_EOL;


// ==========> FUNCTION

function collorLine($col)
{
    $data = array(
        "GR" => "\e[32;1m",
        "RD" => "\e[31;1m",
        "BL" => "\e[34;1m",
        "YL" => "\e[33;1m",
        "CY" => "\e[36;1m",
        "MG" => "\e[35;1m",
        "WH" => "\e[37;1m",
        "DEF" => "\e[0m"
    );
    $collor = $data[$col];
    return $collor;
}
?>