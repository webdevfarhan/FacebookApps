<?php 
include("AppsData.php");

function UniqueRandomNumbersWithinRange($min, $max, $quantity) 
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}
$var1 = count($data);
$var = $var1-1;
$RandomNumbers = UniqueRandomNumbersWithinRange(0, $var, $var1) ;


$abc = $_SERVER[REQUEST_URI];
$abc = stripslashes($abc);
if ((strpos($abc, 'login.php') !== false) || (strpos($abc, 'result.php') !== false) )
$applimit = 12;
else
$applimit = count($data);

echo '<div class="w3-row w3-center">';   
for($i=0; $i<$applimit; $i++)
{
$x = $RandomNumbers[$i];
  
  $j=$i+1;
    
echo '<center>
<div class="w3-col s12 m12 l4 w3-padding">
  <a style="text-decoration:none;" href="'.$data[$x][2].'"><img class="w3-col s12 m12" src="'.$data[$x][1].'" />
  <div class="w3-container w3-white w3-col s12 m12">
  <p>'.$data[$x][0].'</p>
  </div></a>
</div></center>
';

  if($j!= 0)
  {
    if($j % 3 == 0)
    {
      echo '</div>';  
      echo '<div class="w3-row">';   
    }
    
  }
  

}
echo '';
?>