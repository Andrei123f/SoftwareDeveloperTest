<?php
require_once('NodeParent.php');
require_once('NodeChild.php');
require_once('ParentsList.php');

$file = fopen("inputFile.txt" , "r"); //the file we get our input from
$stack = new ParentsList(10); //creating the stack;

while(! feof($file)){
	$line=fgets($file); //reading the file line by line
	$posRed= strpos($line, "Red"); //checking if we have a "Red" in the line
	$posBlue= strpos($line, "Blue"); //checking if we have a "Blue" in the line
	
	if($posRed != false){ //if the new line contains the substring Red
		
		$beggining_of_line= substr($line,0,1);
		if($beggining_of_line == " "){
			$name= substr($line,5); // the name of the parent
			
			if(($stack->isEmpty())){ //checking if the stack is empty
				$parent = new NodeParent();
				$parent -> setName($name);
				$stack->push($parent);
		echo("Created a new parent with the name of <font color ='red'> ". $stack->peek()->getName()."</font> <br />");
			}
			else{
				$subParent = new NodeParent();
				$subParent -> setName($name);
				$parent = $stack->peek();
				$parent -> addParent($subParent);
				$stack -> push($subParent);
		echo("Created a new parent  named <font color ='red'>" .$subParent->getName() . " </font> within the parent <font color ='red'>" .$parent->getName(). "</font> <br />");
			}
		}
		else if ($beggining_of_line == "/"){
			$stack->pop();
		}
		
		}
	if($posBlue != false){
		$size=strlen($line)-14;
		$name=substr($line,6,$size); // the name of the child
		$child= new NodeChild();
		$child->setName($name);
		$parent=$stack->peek();
		$parent->addChild($child);
		
		echo("Created a new child named <font color='blue'>" . $child->getName() . "</font> within the the directory <font color = 'red'>" . $parent->getName(). "</font><br />");
	}
}
fclose($file);
?>