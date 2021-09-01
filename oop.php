<?php

class Fruit{
    //Properties
    public $name;
    public $color;

    function __construct($name, $color){
        $this->name = $name;
        $this->color = $color;
    }

    //Method
    function get_name(){
        return $this->name;
    }

    function get_color(){
        return $this->color;
    }
}


//Create objects
$apple = new Fruit("Apple", "Red");

echo $apple->get_name();
echo "<br>";
echo $apple->get_color();

?>