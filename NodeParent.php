<?php
//The class that represents the directory for this problem.
class NodeParent{
	 private $name;
	 private $subParents=array();
	 private $children=array();
	 private $searched=false;
	 private $nodeParent=null;
	 
	 function setName($name){
		 $this->name = $name;
	 }
	 function addChild($child){
		 $this->children[] = $child;
	 }
	 function addParent($parent){
		 $this->subParents[] = $parent;
	 }
	 function setSearched(){
		 $this->searched = true;
	 }
	 function isSearched(){
		 return $this->searched;
	 }
	 function setParent($parent){
		 $this->nodeParent = $parent;
	 }
	 function getParent(){
		 return $this->nodeParent;
	 }
	 function getName(){
		 return $this->name;
	 }
	 function getSubParents(){
		 return $this->subParents;
	 }
	 function getChildren(){
		 return $this->children;
	 }
	 
 }
?>