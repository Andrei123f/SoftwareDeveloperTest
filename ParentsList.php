<?php
class ParentsList
{
    public $stack;
    private $limit;
    
    public function __construct($limit) {
        $this->stack = array();
        $this->limit = $limit;
    }

    public function push($item) {
        if (count($this->stack) < $this->limit) {
            array_unshift($this->stack, $item);
        } else {
            throw new RunTimeException('Stack is full!'); 
        }
    }

    public function pop() {
        if ($this->isEmpty()) {
	      throw new RunTimeException('Stack is empty!');
	  } else {
             array_shift($this->stack);
        }
    }

    public function peek() {
        return current($this->stack);
    }

    public function isEmpty() {
        return empty($this->stack);
    }
}
?>