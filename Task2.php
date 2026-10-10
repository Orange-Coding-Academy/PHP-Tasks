<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task2</title>
</head>
<body>
    
</body>
</html>
<?php
  echo "<h5>============================= Q1
 =============================</h5>";
$words = array(
    "Twinkle, ",
    " twinkle,",
    " twinkle",
    " little star."
);
var_dump($words);

  echo "<h5>============================= Q2
 =============================</h5>";
$char = 'a';
 $nextLetter = chr(ord($char) + 1);
 echo " <p> The entered letter is : $char </p>";
echo " <p> The next letter of the entered letter is :  $nextLetter </p>";

$char2 = 'e';
 $nextLetter2 = chr(ord($char2) + 1);
 echo " <p> The entered letter is : $char2 </p>";
echo " <p> The next letter of the entered letter is :  $nextLetter2 </p>";

  echo "<h5>============================= Q3
 =============================</h5>";
$String = "The brown fox";
$insert= "quick ";
$position = 4; 
$result = substr_replace($String, $insert, $position,0);
echo "befor insert: " . $String . "<br>";
echo "after insert: " . $result . "<br>";
echo "================================ <br>";
$firstWord = strtok($result, " ");

echo $firstWord; 

echo "<h5>============================= Q4
 =============================</h5>";
 function deleteZero ($num){
    $secNum = $num;
    $str="";
     while ($secNum > 0) {
        $digit = $secNum % 10; 
        if($digit != 0){
            $str = $digit . $str;}
        $secNum = (int)($secNum / 10);  
 }
   return (int)$str;}

$int = 0000657022.24;
echo " <p> The number befor calling function $int </p> ";

echo " <p> The number befor calling function" .deleteZero($int) ."</p> ";


echo "<h5>============================= Q5
 =============================</h5>";
 function deleteDashes ($str){
  return str_replace('-', '', $str) ;
 }
 
$dashedStr = "dog--";
echo " <p> The string befor calling function $dashedStr </p> ";

echo " <p> The string befor calling function   " .deleteDashes($dashedStr) ."</p> ";
echo "<h5>============================= Q6
 =============================</h5>";
 $string = "The quick brown fox jumps over the lazy dog";

$words = explode(" ", $string);

$firstFive = array_slice($words, 0, 5);

echo implode(" ", $firstFive);
echo "<h5>============================= Q7
 =============================</h5>";
 function removeCommas($number){
    $String = str_replace(',', '', $number);
      return $String;
    
 }
 $number = '2,543.12' ;
 echo "The number befor deleting comma  ".$number ."<br> ";
 echo  "The number after deleting comma  " .removeCommas($number); 
 echo "<h1>============================= LOOPS
 =============================</h1>";
 echo "<h5>============================= Q1
 =============================</h5>";
 function fibonacci ($Numbers){
  $fibArray = [0,1];
  for ($i = 2; $i < $Numbers; $i++) {
        $fibArray[$i] = $fibArray[$i - 1] + $fibArray[$i - 2];
    }
  return $fibArray ;
 }


 echo "The Number Befor Fibonacci : 9 "."<br>";
 echo "The Numbers After Fibonacci : ".implode(fibonacci(9));
 echo "<h5>============================= Q2
 =============================</h5>";
 function numberTriangle ($num){
  for($i=1 ; $i<=$num; $i++){
    $n=1;
    for($j=1;$j<=$i;$j++){
     echo $n . " ";
     $n++;
    }
    echo $n ."<br>";
  }
 }
numberTriangle(5);
?>
