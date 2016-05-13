<?php
/*
Lab Number: 7
Program Name: lab7tri.php
Author name and email address: Melissa Page - miss.melissa.page@gmail.com
Date of submission: Tues Feb 23
Time estimated to complete the lab: 5 hours
Actual time taken to complete the lab: 4 hours
Description of the program and how to run it: Draws several shapes on a canvas
Files/networks/data/html required to run the program: You need an internet
connection and a web browser to run this program.
*/
include "classes.php";

// create the object and draw the triangles
$coords = array(150, 100, 280, 230, 280, 100);
$triangle = new Triangle($coords, 300, 500);
$triangle->draw();
$triangle->down(80);
$triangle->right(180);
$triangle->bigger(20);
$triangle->draw();
$triangle->up(180);
$triangle->left(250);
$triangle->smaller(1.8);
$triangle->draw();
$triangle->display();

?>