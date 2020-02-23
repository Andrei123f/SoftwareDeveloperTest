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
	The basecase: when we have no more subParents and we have not found the file.
	The idea: the function returns the full all below levels(including children) if it is called on foundit =1
	
	if children are 0 and we have not found, we pop the first el of the stack
	when we pop and lvl is 3( sizeof(subParents)+1) we add that name of the dir in the output and
	then we append the recursiveSearch for each of its subParents
	*/
	
	function recursiveSearch($parent,$searchedItem,$foundIt){
		$output="";
		
		$children=$parent->getChildren();
		$subParents=$parent->getSubParents();
		$childrenPQ=array();
		$ParentsPQ=array();
		array_push($ParentsPQ,$parent);
		
		//for each parent I will create a priority queue for children and subParents that contains the parent as well
		if(!empty($children)){
		foreach($children as $child)
			array_push($childrenPQ,$child);
		}
		if((sizeof($ParentsPQ)-1)==2){
			foreach($subParents as $subParent)
			array_push($subParentsPQ,$subParent);
		}
		$foundDir=strpos($parent->getName(),$searchedItem);
		//case1: when the root dir is searched
		
		if($foundDir!=false && sizeof(ParentsPQ)==3){
			$output.="C:'\'" . $parent->getName()."<br />";
			if(!empty($ChildrenPQ)){
				while(!empty(ChildrenPQ)){
					$child=current($childrenPQ);
					$output.="C:'\'" . $parent->getName()."'\'".$child->getName()."<br />";
					array_shift($childrenPQ);
				}
			}
			else{
				if(!empty(subParentsPQ)){
					while(!empty(subParentsPQ)){
						$subParent=current($subParentsPQ);
						$output.="C:'\'" . $parent->getName()."'\'".$subParent->getName()."'\'";
						$output.=recursiveSearch($subParent,$searchedItem,1);
						array_shift($subParentsPQ);
					}
				}
			}
			
		}
		else{
			$output.="C:'\'" . $parent->getName()."'\'";
			array_shift($subParentsPQ);
			$subParent=current($subParentsPQ);
			$output.=recursiveSearch($subParent,$searchedItem,1);
		}
		if($foundIt==1){
			if(empty($ParentsPQ)){
				while(!empty($ChildrenPQ)){
					$child=current(ChildrenPQ);
					return($child->getName());
					array_shift($childrenPQ);
				}
			}
		}
		
		
		//if subParents==0 && found==0 output="NOTFOUND";
	return output;
	}
}
?>