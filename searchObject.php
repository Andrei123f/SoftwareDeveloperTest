<?php
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
		while(!empty($parents)){
			$currentParent=current($parents);
			$output= $this->recursiveSearch($currentParent,$searchedItem,0);
			if(strcmp($output,"NOTFOUND") == 0)
				$array_shift($parents);
			else{
				$finalOutput.=$output;
				break;
			}				
		}
		
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
	
	function recursiveSearch($parent,$searchedItem,$foundIt){
		$output="";
	return output;
	}
}
?>