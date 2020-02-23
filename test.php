<?php
session_start();
//This is the Main class
$searchedItem=$_POST['searchedItem'];
require_once('NodeParent.php');
require_once('NodeChild.php');
require_once('ParentsList.php');
require_once('searchObject.php');
$con=new mysqli('127.0.0.1', 'root', '', 'testjob');
echo($searchedItem);
if($con ->connect_error){
	echo ("<h1> <font color='red'>Failed to connect to the database server</font></h1>");
}
else{
	echo("<h1><font color='green'>Connected successfully to the database server</font></h1>");
}
$file = fopen("inputFile.txt" , "r"); //the file we get our input from
$stack = new ParentsList(3); //creating the stack;
$parents= array(); // the array of rooot nodes

while(! feof($file)){
	$size = $stack->getSize(); // the size of the stack
	$line=fgets($file); //reading the file line by line
	$posRed= strpos($line, "Red"); //checking if we have a "Red" in the line
	$posBlue= strpos($line, "Blue"); //checking if we have a "Blue" in the line
	
	if($posRed != false){ //if the new line contains the substring Red
		
		$beggining_of_line= substr($line,0,1);
		
		//Creating a NodeParent object (directory)
		if($beggining_of_line == " "){
			$name= substr($line,5); // the name of the parent
			
			/*
			If the stack is empty and we add a new NodeParent object (directory) it means that this object is the root of the tree.
			If the stack is not empty and we add a new NodeParent object (directory)it means that this object is a subtree of the root(the first element from the stack).
			If the line is "/Red" it means that we need to exit the current directory, i.e. pop() the stack.
			*/
			if(($stack->isEmpty())){			
				$parent = new NodeParent();
				$parent -> setName($name);
				$stack->push($parent);
				array_push($parents,$parent);
				$sql="INSERT INTO root (name_of_root) VALUES ('$name')"; //creating the SQL syntax for inserting
		echo("Created a new parent with the name of <font color ='red'> ". $stack->peek()->getName()."</font> <br />");
			
			/*
			if(!$con->query($sql)){ //inserting the name of the parent
				echo ("<font color='red'>Failed inserting the parent" ."<b>".$parent->getName()."</b>"."</font> <br />");
			}
			else{
				echo ("<font color='red'>Inserted successfully the parent "."<b>". $parent->getName()."</b>"."</font> <br />");
			}
				$lastId= $con-> insert_id;
				$_SESSION["last_id"] = $lastId;
				
			*/

			}
			else{
			//	echo($_SESSION["last_id"]. "<br />");
				$size = $stack->getSize();
				$subParent = new NodeParent();
				$subParent -> setName($name);
				$parent = $stack->peek();	
				$parent -> addParent($subParent);
				echo("ADDED " . $subParent->getName() . " TO " . $parent->getName() . "<br />");			
				/*
				if($size == 1){
					$value = $_SESSION["last_id"];
					$sql="INSERT INTO Directories (id_of_root, name_of_dir) VALUES ('$value','$name')";
					
					if(!$con->query($sql)){ //inserting the name of the subParent
				echo ("<font color='red'>Failed inserting the parent" ."<b>".$subParent->getName()."</b> error: ".$con->error."</font> <br />");
			}
			else{
				echo ("<font color='red'>Inserted successfully the parent "."<b>". $subParent->getName()."</b>"."</font> <br />");
			}
				
				$_SESSION["last_Pid"] = $con -> insert_id;
				}
				
				else if($size ==2){
					
							$value = $_SESSION["last_Pid"];
					$sql="INSERT INTO Contents (id_of_dir, name_of_file,is_dir) VALUES ('$value','$name',TRUE)";
					
					if(!$con->query($sql)){ //inserting the name of the subParent
				echo ("<font color='red'>Failed inserting the parent" ."<b>".$subParent->getName()."</b> error: ".$con->error."</font> <br />");
			}
			else{
				echo ("<font color='red'>Inserted successfully the parent "."<b>". $subParent->getName()."</b>"."</font> <br />");
			}
					
				}
				$_SESSION["last_Sid"] = $con -> insert_id;
				*/
				$stack -> push($subParent);
		echo("Created a new parent  named <font color ='red'>" .$subParent->getName() . " </font> within the parent <font color ='red'>" .$parent->getName(). "</font> <br />");
			}
		}
		else if ($beggining_of_line == "/"){
			$stack->pop();
		}
		/*
		If the line starts with "Blue" it means it is a file that is in the directory that is the last element added in the stack, so we peek() to get the directory from the stack.
		*/
		}
	if($posBlue != false){ 
		$sizeStack= $stack->getSize();
		
		$size=strlen($line)-14;
		$name=substr($line,6,$size);
		$child= new NodeChild();
		$child->setName($name);
		$parent=$stack->peek();
		$parent->addChild($child);
		/*
		if($sizeStack==2){
			$value = $_SESSION["last_Sid"];
				$sql="INSERT INTO Contents (id_of_dir, name_of_file,is_dir) VALUES ('$value','$name',False)";
					
					if(!$con->query($sql)){ //inserting the name of the subParent
				echo ("<font color='blue'>Failed inserting the child" ."<b>".$child->getName()."</b> error: ".$con->error."</font> <br />");
			}
			else{
				echo ("<font color='blue'>Inserted successfully the child "."<b>". $child->getName()."</b>"."</font> <br />");
			}
			
		}
		else if($sizeStack==3){
			$valueP = $_SESSION["last_Sid"];
			
				$sql="INSERT INTO NewTable1 (name_of_file,is_dir) VALUES ('$name',False)";
					
					if(!$con->query($sql)){ //inserting the name of the subParent
				echo ("<font color='blue'>Failed inserting the child" ."<b>".$child->getName()."</b> error: ".$con->error."</font> <br />");
			}
			else{
				echo ("<font color='blue'>Inserted successfully the child "."<b>". $child->getName()."</b>"."</font> <br />");
			}
			$_SESSION["last_Cid"] = $con -> insert_id;
		$valueC= $_SESSION["last_Cid"];
		$sql="INSERT INTO Intermediary1 (id_of_content, id_of_newTable_element) VALUES ('$valueP', '$valueC')";
		$con->query($sql);
		}
		*/

		echo("Created a new child named <font color='blue'>" . $child->getName() . "</font> within the the directory <font color = 'red'>" . $parent->getName(). "</font><br />");
	}
}
$search = new searchObject($searchedItem, $parents);
echo("<h1>". $search->findMatch($parents, $searchedItem) ."</h1>");
fclose($file);
?>