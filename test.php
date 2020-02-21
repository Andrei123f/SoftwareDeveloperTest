<?php
require_once('NodeParent.php');
require_once('NodeChild.php');
require_once('ParentsList.php');

$file = fopen("inputFile.txt" , "r"); //the file we get our input from

while(! feof($file)){
	$line=fgets($file); //reading the file line by line
	$posRed= strpos($line, "Red"); //checking if we have a "Red" in the line
	$posBlue= strpos($line, "Blue"); //checking if we have a "Blue" in the line
	
	if($posRed != false){
		
		$beggining_of_line= substr($line,0,1);
		if($beggining_of_line == " "){
			$name= substr($line,5); // the name of the parent
			echo(" NEWPARENT<font color='red'>". $name . "</font> <br />");
			
		}
		else if ($beggining_of_line == "/"){
			
			echo ("<font color='red'> CLOSEPARENT</font>  ". $line . "<br />");
		}
		
		}
	if($posBlue != false){
		$size=strlen($line)-14;
		$name=substr($line,6,$size); // the name of the child
		echo("NEWCHILD<font color='blue'>" . $name . "</font><br />");
	}
}
fclose($file);
?>