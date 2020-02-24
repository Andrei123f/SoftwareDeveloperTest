<?php
//The class that is creating the stack.
require_once('NodeParent.php');
require_once('NodeChild.php');
class searchObject
{
	private $searchedItem;
	private $parents = array();
	/*
	current($parents)->getName() //for getting the first element of the stack.
	array_shift($parents); //for popping the first element of the stack.
	*/
	function findMatch($parents, $searchedItem){
		$finalOutput="";
		$wasFound=false;
		while(!empty($parents)){
			$currentParent=current($parents);
			echo("Current parent:" . $currentParent->getName() ."<br />");
			$output= $this->recursiveSearch($currentParent,$searchedItem);
			$compare=strcmp($output,"NOTFOUND");
			
			if($compare == 0){
				array_shift($parents);
			}
			else{
				$finalOutput.=$output;
				$wasFound=true;
				break;
			}				
		}
		if(!$wasFound)
			return("The searched Item ". $searchedItem ." was not found");
		else
			return($finalOutput);
	}
	/*
	The function will output "NOTFOUND" if the searched item is not in that specific tree.
	The function will output the path to that specific searched item if it is found in that tree.
	The basecase: when we have no more subParents and we have not found the file.
	The idea: the function returns the full all below levels(including children) if it is called on foundit =1
	
	if children are 0 and we have not found, we pop the first el of the stack
	when we pop and lvl is 3( sizeof(subParents)+1) we add that name of the dir in the output and
	then we append the recursiveSearch for each of its subParents
	*/
	
	function recursiveSearch($parent,$searchedItem){
		
		$queue=array();
		$start=$parent;
		$start->setSearched();
		array_push($queue,$start);
		
		while(!empty($queue)){
			$current = array_shift($queue);
			echo("Looking at:" . $current->getName()."<br />");
			$name=$current->getName();
			
			$foundIt=strpos($name,$searchedItem);
			if($foundIt !==false){
				return("FOUND IT:". $current->getName());
			}
			if($current instanceof NodeParent){
			$nodes= array_merge($current->getSubParents(), $current->getChildren());
			}
			foreach($nodes as $node){
				if(!$node->isSearched()){
					$node->setSearched();
					array_push($queue,$node);
				}
			}
			
		}
		return "NOTFOUND";
	}
}
?>