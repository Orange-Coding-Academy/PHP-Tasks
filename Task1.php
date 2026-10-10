<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task-1</title>
</head>
<body>
    <h1>PHP Task1 :</h1>
</body>
</html>

<?php
echo "<h3>============================= Questin 1 =============================</h3>";
$Colors = ["white","green","red"];
echo "<ul>";
for($i = 0 ; $i <count($Colors) ; $i++){
    echo "<li> $Colors[$i] </li>";
}
echo "</ul>";

echo "<h3>============================= Questin 2 =============================</h3>";
$cities= array( "Italy"=>"Rome", "Luxembourg"=>"Luxembourg", "Belgium"=> "Brussels", 
"Denmark"=>"Copenhagen", "Finland"=>"Helsinki", "France" => "Paris", "Slovakia"=>"Bratislava", 
"Slovenia"=>"Ljubljana", "Germany" => "Berlin", "Greece" => "Athens", "Ireland"=>"Dublin", 
"Netherlands"=>"Amsterdam", "Portugal"=>"Lisbon", "Spain"=>"Madrid" );  
asort($cities);
foreach($cities as $country => $capital){
    echo "The capital of $country is $capital <br>";
}
echo "<h3>============================= Questin 3 =============================</h3>";
 $color = array (4 => 'white', 6 => 'green', 11=> 'red');
 $fe = reset($color) ;
 echo "the first element in arrays color : $fe";
 echo "<h3>============================= Questin 4 =============================</h3>";
$numbersArray = [1,2,3,5];
echo"Array befor add new item";
print_r($numbersArray);
$newItem = 4;
$position = 3;
array_splice($numbersArray,$position,0,$newItem);
echo"<br>";
echo"Array after add new item";
print_r($numbersArray);
echo "<h3>============================= Questin 5 =============================</h3>";
$fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");
ksort($fruits);
print_r($fruits);
echo "<h3>============================= Questin 6 =============================</h3>";
$Temperature = [  78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 
65, 64, 68, 73, 75, 79, 73 ];
$TemNum = count($Temperature);
$Sum = 0 ;
foreach($Temperature as $num){
    $Sum += $num;
}
$average = $Sum / $TemNum;
echo "<p>  The Average Temperature = ($average)</p>";
sort($Temperature);
$lowestFive = array_slice($Temperature, 0, 5);
$highestFive = array_slice($Temperature, -5);
echo "<p>The list of five lowest temperatures :"  ,implode(", ", $lowestFive)." </p>";
echo "<p>The list of five lowest temperatures :"  ,implode(", ", $highestFive)." </p>";
echo "<h3>============================= Questin 7 =============================</h3>";
$array1 = array("color" => "red", 2, 4); 
$array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4); 
print_r(array_merge($array1, $array2));
echo "<h3>============================= Questin 8 =============================</h3>";
$colors = array("red","blue", "white","yellow");
$upperArray = array_map("strtoupper", $colors);
print_r($upperArray);
echo "<h3>============================= Function =============================</h3>";
echo "<h5>============================= 1 =============================</h5>";
function primeNumber($number){
$isPrime = 0 ;
for($i= 1 ; $i <= $number ; $i++){
    if($number % $i == 0){
        $isPrime++;
    }
}
if($isPrime == 2){
    return "Prime Number";
}
else{
    return "Not a Prime Number";
}

}
$checkNum1 = 3 ;
$checkNum2 = 6 ;
echo "<p> the number $checkNum1 is ".primeNumber($checkNum1)."</p>";
echo "<p> the number $checkNum2 is ".primeNumber($checkNum2)."</p>";
echo "<h5>============================= 2
 =============================</h5>";
function Reverse ($string){
    $reverseString = strrev($string);
    return $reverseString;
}
 $reverseString = "remove";
 echo "<p> The reverse of remove : " .Reverse($reverseString)."</p>";
echo "<h5>============================= 3
 =============================</h5>";
 function swap ($n1,$n2){
    $n3 = $n1;
    $n1 = $n2;
    $n2 = $n3;
    return [$n1,$n2];
 }
 $num1 = 12 ;
 $num2 = 10;
echo "<p> the numbers befor swap : ". "number1 : $num1"." number2 :$num2 "."</p>";
$result = swap($num1, $num2);

echo "<p>The numbers after swap: number1: " . $result[0] . " number2: " . $result[1] . "</p>";
echo "<h5>============================= 4
 =============================</h5>";
 function Armstrong ($num){
    $secNum = $num;
    $sum = 0;
        while ($secNum > 0) {
        $digit = $secNum % 10;        
        $sum += $digit ** 3;        
        $secNum = (int)($secNum / 10);  
    }
     return $sum === $num;
 }
 $isArmstrongNum = 407;

if (Armstrong( $isArmstrongNum)) {
    echo "<p> $isArmstrongNum is an Armstrong number.</p>";
} else {
    echo "<p> $isArmstrongNum is NOT an Armstrong number.</p>";
}
echo "<h5>============================= 5
 =============================</h5>";
 function isPalindrome($text) {

    $text = strtolower($text);

    $text = preg_replace("/[^a-z0-9]/", "", $text);

    $reverseText = strrev($text);

    if ($text === $reverseText) {
        return "Yes it is a palindrome";
    } else {
        return "No it is not a palindrome";
    }
}

$sentence = "Eva, can I see bees in a cave?";

echo isPalindrome($sentence);
echo "<h5>============================= 6
 =============================</h5>";

function removeDuplicates($array) {

    return array_unique($array);

}

$array1 = array(2, 4, 7, 4, 8, 4);

$array1 = removeDuplicates($array1);

print_r($array1);
echo "<h3>============================= Logical Statements and Operators  =============================</h3>";
 echo "<h5>============================= 1
 =============================</h5>";

 function checkSum($firstNum, $secondNum) {

    $sum = $firstNum + $secondNum;

    if ($sum == 30) {
        return $sum;
    } else {
        return false;
    }
}

$firstNum = 10;
$secondNum = 10;

$result = checkSum($firstNum, $secondNum);

var_dump($result);
 echo "<h5>============================= 2
 =============================</h5>";
function multipleOf3($number) {

    if ($number % 3 == 0) {
        return true;
    } else {
        return false;
    }
}

$number = 12;

if (multipleOf3($number)) {
    echo "$number is a multiple of 3";
} else {
    echo "$number is not a multiple of 3";
}
 echo "<h5>============================= 3
 =============================</h5>";
 $number = 50;
echo ($number >= 20 && $number <= 50) ? 'true' : 'false';
 echo "<h5>============================= 4
 =============================</h5>";
 $largestNum = [1,5,9];
 $largest = $largestNum[0];
 for ($i=0; $i <count($largestNum) ; $i++) { 
    if($largestNum[$i]>$largest){
        $largest=$largestNum[$i];
    }
 }
 echo "<p>The largest number is : $largest </p>";

 echo "<h5>============================= 5
 =============================</h5>";

 function calculateElectricityBill($units) {
    $bill = 0;

    if ($units <= 50) {
       
        $bill = $units * 2.50;
    } elseif ($units <= 150) {
     
        $bill = (50 * 2.50) + (($units - 50) * 5.00);
    } elseif ($units <= 250) {
       
        $bill = (50 * 2.50) + (100 * 5.00) + (($units - 150) * 6.20);
    } else {
       
        $bill = (50 * 2.50) + (100 * 5.00) + (100 * 6.20) + (($units - 250) * 7.50);
    }

    return $bill;
}

$test_units = 275; 
$total_bill = calculateElectricityBill($test_units);

echo "Total Units Consumed: " . $test_units . " Units<br>";
echo "Total Electricity Bill: " . number_format($total_bill, 2) . " JOD";
 echo "<h5>============================= 6
 =============================</h5>";
 $age = 15;
echo ($age >= 18) ? 'is eligible to vote' : 'is no eligible to vote';
 echo "<h5>============================= 7
 =============================</h5>";
 function checkNumberSign($number) {
    if ($number > 0) {
        return 'Positive';
    } elseif ($number < 0) {
        return 'Negative';
    } else {
        return 'Zero';
    }
}
$number = -60;
echo checkNumberSign($number);
 echo "<h5>============================= 8
 =============================</h5>";
 function findGrade($grad){
    $gradLetter = "";
    if($grad>=90 && $grad <=100){
     $gradLetter ="A";
    }
    elseif($grad>=80 && $grad <90){
     $gradLetter ="B";
    }
    elseif($grad>=70 && $grad <80){
     $gradLetter ="C";
    }
    elseif($grad>=60 && $grad <70){
     $gradLetter ="D";
    }
    elseif($grad>=50 && $grad <60){
     $gradLetter ="F";
    }
    return $gradLetter;

 }
 $Grad = 50 ;
echo " <p> The grad is :".findGrade($Grad)."</p>";
echo "<h3>============================= Loops  =============================</h3>";
 echo "<h5>============================= 1
 =============================</h5>";
 for ($i = 1; $i <= 10; $i++) {
    if ($i === 1) {
        echo $i; 
    } else {
        echo "-" . $i;
    }
}
 echo "<h5>============================= 2
 =============================</h5>";
 $total = 0;

for ($i = 0; $i <= 30; $i++) {
    $total += $i; 
}

echo $total; 
 echo "<h5>============================= 3
 =============================</h5>";
 echo "<h5>============================= 4
 =============================</h5>";
 echo "<h5>============================= 5
 =============================</h5>";
 
for ($i = 1; $i <= 5; $i++) {

    for ($j = 1; $j <= 5; $j++) {

        if ($i == $j) {
            echo $i . " ";
        } else {
            echo "0 ";
        }
    }

    echo "<br>";
}


 echo "<h5>============================= 6
 =============================</h5>";
 $number = 5;
$factorial = 1;

for ($i = 1; $i <= $number; $i++) {
    $factorial *= $i;
}

echo $factorial;
 echo "<h5>============================= 7
 =============================</h5>";

echo "<table border='1' cellpadding='3px' cellspacing='0px'>";

for ($i = 1; $i <= 5; $i++) {

    echo "<tr>";

    for ($j = 1; $j <= 5; $j++) {
        echo "<td>$i x $j = " . ($i * $j) . "</td>";
    }

    echo "</tr>";
}

echo "</table>";
echo "<h3>============================= PHP String and String Functions   =============================</h3>";
 echo "<h5>============================= 1
 =============================</h5>";
 $string = "hello world from orange coding academy";

echo strtoupper($string);
echo "<br>";

echo strtolower($string);
echo "<br>";

echo ucfirst($string);
echo "<br>";

echo ucwords($string);
  echo "<h5>============================= 2
 =============================</h5>";
$string = "085119";

$time = substr($string, 0, 2) . ":"
      . substr($string, 2, 2) . ":"
      . substr($string, 4, 2);

echo $time;
  echo "<h5>============================= 3
 =============================</h5>";
 $$sentence = "I am a full stack developer at orange coding academy";
$word = "Orange";

if (stripos($sentence, $word) !== false) {
    echo "Word Found!";
} else {
    echo "Word Not Found!";
}
  echo "<h5>============================= 4
 =============================</h5>";
$url = "www.orange.com/index.php";

echo basename($url);
  echo "<h5>============================= 5
 =============================</h5>";

$email = "info@orange.com";

$username = strstr($email, "@", true);

echo $username;
  echo "<h5>============================= 6
 =============================</h5>";
 $string = "info@orange.com";

echo substr($string, -3);
  echo "<h5>============================= 7
 =============================</h5>";
$characters = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

$password = "";

$length = 10;

for ($i = 0; $i < $length; $i++) {
    $password .= $characters[random_int(0, strlen($characters) - 1)];
}

echo $password;
  echo "<h5>============================= 8
 =============================</h5>";
 $sentence = "Our new trainee is so genius.";

$newWord = "The";

$result = preg_replace(
    "/^Our\b/",
    $newWord,
    $sentence,
    1
);

echo $result;
?>