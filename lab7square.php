<?php
/*
Lab Number: 7
Program Name: lab7square.php
Author name and email address: Melissa Page - miss.melissa.page@gmail.com
Date of submission: Tues Feb 23
Time estimated to complete the lab: 5 hours
Actual time taken to complete the lab: 4 hours
Description of the program and how to run it: Draws several shapes on a canvas
Files/networks/data/html required to run the program: You need an internet
connection and a web browser to run this program.
*/
include "classes.php";

// create the object and draw the squares
$coords = array('x' => 200, 'y' => 100, 'x2' => 300, 'y2' => 200);
$square = new Square($coords, 300, 500);
$square->draw();
$square->left(130);
$square->down(80);
$square->smaller(1.25);
$square->draw();
$square->right(320);
$square->up(160);
$square->bigger(20);
$square->draw();
$square->display();

?>