<?php

require_once('classes.php');

fwrite(STDOUT, 'What is your name?' . PHP_EOL);

fwrite(STDOUT, '-> ');

$player = new Awesome(trim(fgets(STDIN)));

sleep(1);
 
echo "Welcome $player->name!" . PHP_EOL;

sleep(1);

echo "You have $player->health health!" . PHP_EOL;

$event = new Event($player);

$event->encounter();

