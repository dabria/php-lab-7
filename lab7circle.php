<?php
/*
Lab Number: 7
Program Name: lab7circle.php
Author name and email address: Melissa Page - miss.melissa.page@gmail.com
Date of submission: Tues Feb 23
Time estimated to complete the lab: 5 hours
Actual time taken to complete the lab: 4 hours
Description of the program and how to run it: Draws several shapes on a canvas
Files/networks/data/html required to run the program: You need an internet
connection and a web browser to run this program.
*/
include "classes.php";

// create the object and draw the circles
$circle = new Circle(100, array('x' => 250, 'y' => 150), 300, 500);
$circle->draw();
$circle->bigger(1.25);
$circle->up(50);
$circle->left(110);
$circle->draw();
$circle->smaller(2.60);
$circle->right(180);
$circle->down(90);
$circle->draw();
$circle->display();

?>
