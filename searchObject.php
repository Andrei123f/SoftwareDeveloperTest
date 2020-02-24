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
	I will use the Breadth-first search algorithm to traverse the tree with a custom adaptation. 
	Whenever I see a possible match for the word there are 2 cases:
	If that node is a NodeChild, I print the path from the root to that node.
	If that node is a NodeParent, I print the path from the root to that node.Now I have 3 cases:
	The node NodeParent has no other NodeParent nodes, in this case I iterate through the children of that node, creating a path for each one of them.
	The node NodeParent has no NodeChild nodes and it has only NodeParents Nodes, in this case I will print the whole subtree.
	The node NodeParent has NodeParent nodes and NodeChildren nodes in this case I print all the path of NodeChildren and then I iterate through all the NodeParent nodes and I continue the algorithm. 

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
				
				$output="C:'\'";
				$output=str_replace("'","",$output);
				$path=array();
				$next = $current->getParent();
				array_push($path,$current);
				
				if($current instanceof NodeChild){
				$output="C:'\'";
				$output=str_replace("'","",$output);
				$path=array();
				$next = $current->getParent();
				array_push($path,$current);
				$intOutput="";
				while($next != null){ //printing the path from the root to the NodeChild node
					array_push($path,$next);
					$next=$next->getParent();
				}
				for($x=sizeof($path)-1;$x>=0;$x--){
					$node=$path[$x];
					$intOutput=$node->getName()."'\'";
					$intOutput=str_replace("'","",$intOutput);
					$output.=$intOutput;
				}
				return $output;
				}
				else{ //printing the path from root to the NodeParent node
					$children=$current->getChildren();
					$subParents=$current->getSubParents();
					$parentsPath=array();
					
					while($next != null){
					array_push($path,$next);
					$next=$next->getParent();
				}
				for($x=sizeof($path)-1;$x>=0;$x--){
					$node=$path[$x];
					$intOutput=$node->getName()."'\'";
					$intOutput=str_replace("'","",$intOutput);
					$output.=$intOutput;
				}
				$output.="<br />";
				
				//printing out the path to all of its children
				if(!empty($children)){
					$finalChildOutput="";
					
					foreach($children as $child){
					$childrenPath=array();
					$childOutput="C:'\'";
					$childOutput=str_replace("'","",$childOutput);
					
					array_push($childrenPath,$child);
					$next=$child->getParent();					
					while($next != null){ //printing the path from the root to the NodeChild node
					array_push($childrenPath,$next);
					$next=$next->getParent();
				}
				
				for($x=sizeof($childrenPath)-1;$x>=0;$x--){
					$node=$childrenPath[$x];
					$intOutput=$node->getName()."'\'";
					$intOutput=str_replace("'","",$intOutput);
					$childOutput.=$intOutput;
				}
				$finalChildOutput.=$childOutput."<br />";
				

					}
					$output.=$finalChildOutput;
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
	
	
	function getPath($node){
	
	}
}
?>