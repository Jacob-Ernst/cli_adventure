<?php


class Character{
    public $name;
    public $max_health;
    public $health;
    public $atk;
    public $inventory = [];
    public $type;
    public $potion_num = 5;
    public $level = 1;
    
    public function __construct($name){
        $this->name = $name;
    }
    
    public function take_damage($amount){
        $this->health -= $amount;
    }
    
    public function do_damage($target){
        $target->take_damage($this->atk);
    }
    
    public function heal($target){
        if(($target->potion_num > 0) && ($target->health != $target->max_health)){
            $target->health += 20;
            $target->potion_num--;
            fwrite(STDOUT, "$target->name gained 20 health" . PHP_EOL);
            fwrite(STDOUT, "$target->name has $target->potion_num potions left" . PHP_EOL);
        }
    }
}

class HealingItem{
    public $heal_num;
    
    public function __construct($heal_num){
        $this->heal_num = $heal_num;
    }
}

class Event{
    
    public $player;
    public function __construct($player){
        $this->player = $player;
    }
    
    function monsta_maker($name){
        $rand = mt_rand(1, 3);
        if ($rand == 1) {
            return $pick = new Awesome($name);
        }
        elseif ($rand == 2) {
            return $pick = new Troll($name);
        } 
        elseif ($rand == 3) {
            return $pick = new Slime($name);
        }
    }
    
    public function options_show($player, $monsta){
        do {
        
        fwrite(STDOUT, '+-----------------+' . PHP_EOL);
        fwrite(STDOUT, '|Options:         |' . PHP_EOL);
        fwrite(STDOUT, '|-----------------|' . PHP_EOL);
        fwrite(STDOUT, '|(A)ttack         |' . PHP_EOL);
        fwrite(STDOUT, '|(H)eal           |' . PHP_EOL);
        fwrite(STDOUT, '|(N)ada           |' . PHP_EOL);
        fwrite(STDOUT, '+-----------------+' . PHP_EOL);
        fwrite(STDOUT, '-> ');
        $choice = strtolower(trim(fgets(STDIN)));
        
        } while (($choice != 'n') && ($choice != 'h') && ($choice != 'a'));

        if ($choice == 'a') {
                $player->do_damage($monsta);
                
                sleep(1);
                
                fwrite(STDOUT, 'BOOOM BABY' . PHP_EOL);
        }
        elseif ($choice == 'h') {
               sleep(1);
               $player->heal($player);
               fwrite(STDOUT, PHP_EOL);
        }
        else{
                
                sleep(1);
                
                fwrite(STDOUT, 'BOOO' . PHP_EOL);
        }
    }
    
    public function encounter(){
        $monsta = $this->monsta_maker("Trollololol");
        sleep(2);

        fwrite(STDOUT, "You've encountered $monsta->name the $monsta->type" . PHP_EOL);

        sleep(1);

        fwrite(STDOUT, "$monsta->name has $monsta->health health" . PHP_EOL);
        do {
            sleep(2);
            
            
            $this->options_show($this->player, $monsta);
            
            sleep(1);
    
            echo "$monsta->name has $monsta->health health" . PHP_EOL;
            fwrite(STDOUT, PHP_EOL);
            
            if ($monsta->health > 0) {
                
                $monsta->do_damage($this->player);
                
                echo "$monsta->name does $monsta->atk damage to you" . PHP_EOL;
                $health = $this->player->health;
                echo "You have $health health" . PHP_EOL;
            }
            
        } while (($monsta->health > 0) || ($player->heal > 0));
        fwrite(STDOUT, 'HE DEAD' . PHP_EOL);
    }
}

class Awesome extends Character{
    
    function __construct($name)
    {
        parent::__construct($name);
        $this->type = 'Awesome';
        $this->max_health = 999;
        $this->health = 999;
        $this->atk = 500;
    }
}

class Troll extends Character{
    
    function __construct($name)
    {
        parent::__construct($name);
        $this->type = 'Troll';
        $this->max_health = 100;
        $this->health = 100;
        $this->atk = 10;
    }
}

class Slime extends Character{
    
    function __construct($name)
    {
        parent::__construct($name);
        $this->type = 'Slime';
        $this->max_health = 10;
        $this->health = 10;
        $this->atk = 5;
    }
}

?>
