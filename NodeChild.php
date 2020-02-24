<?php
//The class that represents the file from this problem.
class NodeChild{
	 private $name;
	 private $searched=false;
	 private $parentNode=null;
	 
	 function setName($name){
		 $this->name=$name;
	 }
	function getName(){
		return $this->name;
	}
	function setSearched(){
		$this->searched=true;
	}
	function setParent($parent){
		$this->parentNode=$parent;
	}
	function isSearched(){
		return $this->searched;
	}
	function getParent(){
		return $this->parentNode;
	}
 }
?>