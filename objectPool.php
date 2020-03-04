<?php
class Shoes {
     private $id;
     private $name;       

     public function __construct($id, $name) {
          $this->id = $id;
          $this->name = $name;
     }

     public function getId() {
          return $this->id;
     }

     public function getName() {
          return $this->name;
     }

     public function getInfo()
     {
          return "ID = " . $this->id . "; Name = " . $this->name;
     }
}

class ShoesPool
{
     private $occupiedShoess;
     private $freeShoess;
     private $names = [ 'Colores', 'Oscuros', 'Festival', 'Verano', 'Blancos' ];

     public function __construct()
     {
          $this->occupiedShoess = [];
          $this->freeShoess = [];
     }

     public function getReusable()
     {
          if (count($this->freeShoess) == 0)
          {
              $id = count($this->occupiedShoess) + count($this->freeShoess) + 1;
              $randomName = array_rand($this->names, 1);
              $shoes = new Shoes($id, $this->names[$randomName]);
          }
          else  $shoes = array_pop($this->freeShoess);
        
          $this->occupiedShoess[$shoes->getId()] = $shoes;
          return $shoes;
     }

     public function releaseReusable($shoes)
     {
          $id = $shoes->getId();
          if (isset($this->occupiedShoess[$id])){
               unset($this->occupiedShoess[$id]);
               $this->freeShoess[$id] = $shoes;
          }
     }

     public function getOccupiedShoess()
     {
          $shoess = null;
          if (count($this->occupiedShoess) > 0) {
               foreach ($this->occupiedShoess as $shoes){
                    $shoess = $shoess . $shoes->getName() . ', ';
               }
          }
          if(is_null($shoess)) $shoess = 'No existe zapatos ocupados.';
          return $shoess;
     }

     public function getFreeShoess()
     {
          $shoess = null;
          if (count($this->freeShoess) > 0) {
               foreach ($this->freeShoess as $shoes){
                    $shoess = $Shoess . $shoes->getName(). ', ';
               }
          }
          if(is_null($shoess)) $shoess = 'No existe zapatos libres';
          return $shoess;
     }
}

$pool = new ShoesPool();

$shoes1 = $pool->getReusable();
$shoes2 = $pool->getReusable();
//$pool->releaseReusable($Shoes2); //Para borrar al empleado

echo "Zapato 1: " .$shoes1->getInfo(). "\n";
echo "Zapato 2: " .$shoes2->getInfo(). "\n";
echo "Lista de zapatos ocupados: " .$pool->getOccupiedShoess(). "\n";
echo "Lista de zapatos libres: " .$pool->getFreeShoess(). "\n";
?>