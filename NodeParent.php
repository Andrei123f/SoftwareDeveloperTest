<?php
//The class that represents the directory for this problem.
class NodeParent{
	 private $name;
	 private $subParents=array();
	 private $children=array();
	 
	 function setName($name){
		 $this->name=$name;
	 }
	 function addChild($child){
		 $this->children = $child;
	 }
	 function addParent($parent){
		 $this->subParents = $parent;
	 }
	 function getName(){
		 return $this->name;
	 }
 }
?>