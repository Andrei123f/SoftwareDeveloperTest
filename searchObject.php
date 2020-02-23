<?php
//The class that is creating the stack.
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
			$output=recursiveSearch($parent,$searchedItem);
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
	
	function recursiveSearch($parent,$searchedItem){
		$interOutput="C:'\'" . $parent->getName ."'\'"; //not ok
		$output="";
		$children=$parent->getChildren();
		$subParents=$parent->getSubParents();
		$foundDir=$strpos($parent->getName(),$searchedItem);
		//if we did not find any dir with the searched value, we need to check if we have a child that satisfies
		//(e.g Letter.doc in Works)
		if($foundDir==false){
		//if there are no children, we are on level 2 of the tree, so we need to go deeper.
		if(empty($children){
			foreach($subParents as $subParent)
				recursiveSearch($subParent,$searchedItem);
		} //if there are children, we need to see if the searched file is in that parent.
		else{
			foreach($children as $child){
				$foundFile=$strpos($child->getName(),$searchedItem);
				if($foundFile != false)
				{
					return($output.=$interOutput . $child->getName()."<br />");
					
				}
			}
			
		}
		
		}
		else{
			$output.=$interOutput //output the parent
		}
	return output;
	}
	*/
}
?>