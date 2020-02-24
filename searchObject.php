<?php
//The class for the object that searches
require_once('NodeParent.php');
require_once('NodeChild.php');
class searchObject
{
	private $searchedItem;
	private $parents = array();
	/*
	current($parents)->getName() //for getting the first element of the queue.
	array_shift($parents); //for popping the first element of the queue.
	*/
	function findMatch($parents, $searchedItem){
		if(empty($searchedItem))
			return("Invalid input: only spaces!");
		$finalOutput="";
		$wasFound=false;
		while(!empty($parents)){
			$currentParent=current($parents);
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
	I will use the Breadth-first search algorithm to traverse the tree with a custom adaptation. 
	Whenever I see a possible match for the word there are 2 cases:
	If that node is a NodeChild, I print the path from the root to that node.
	If that node is a NodeParent, I print the path from the root to that node.Now I have 3 cases:
	The node NodeParent has no other NodeParent nodes, in this case I iterate through the children of that node, creating a path for each one of them.
	The node NodeParent has no NodeChild nodes and it has only NodeParents nodes, in this case I will print the paths to each NodeParents nodes.
	The node NodeParent has NodeParent nodes and NodeChildren nodes in this case I print all the path of NodeChildren and then I iterate through all the NodeParent nodes and I print the path to each subparent NodeParent node. 
	*/
	
	function recursiveSearch($parent,$searchedItem){
		$queue=array();
		$start=$parent;
		$start->setSearched();
		array_push($queue,$start);
		
		while(!empty($queue)){
			$current = array_shift($queue);
			$name=$current->getName();
			
			$foundIt=strpos($name,$searchedItem);
			
			if($foundIt !==false){
					$output="";
				if($current instanceof NodeChild)
							return $this->getPath($current);
						
				else{ //printing the path from root to the NodeParent node
					$output.=$this->getPath($current)."<br />";
					$children=$current->getChildren();
					$subParents=$current->getSubParents();
					
					if(!empty($children)){
						$childrenPath="";
					foreach($children as $child)
						$childrenPath.=$this->getPath($child) . "<br />";
						$output.=$childrenPath;
					}
					
					if(!empty($subParents)){
						$subParentsPath="";
					foreach($subParents as $subParent)
						$subParentsPath.=$this->getPath($subParent) . "<br />";
						$output.=$subParentsPath;
					}
					
				return $output;
				}
				
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
	
	//Tis function will return the path of the given Node starting from the root.
	function getPath($node){
	$output="C:'\'";
	$output=str_replace("'","",$output);
	$path=array();
	$next = $node->getParent();
	array_push($path,$node);
	
	while($next != null){
		array_push($path,$next);
		$next=$next->getParent();
	}
	
	for($x=sizeof($path)-1;$x>=0;$x--){
		$intNode=$path[$x];
		$intOutput=$intNode->getName()."'\'";
		$intOutput=str_replace("'","",$intOutput);
		$output.=$intOutput;
	}
	$output=substr($output,0,-1);
	return $output;
	}
}
?>