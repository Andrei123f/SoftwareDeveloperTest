<?php
class NodeParent{
	 private $name;
	 private $subParents=array();
	 private $children=array();
	 
	 function setName($name){
		 $this->$name=$name;
	 }
	 function addChild($child){
		 $this->children = $child;
	 }
	 function addParent($parent){
		 $this->subParents = $parent;
	 }
 }
?>