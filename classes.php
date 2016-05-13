<?php
/*
Lab Number: 7
Program Name: classes.php
Author name and email address: Melissa Page - miss.melissa.page@gmail.com
Date of submission: Tues Feb 23
Time estimated to complete the lab: 5 hours
Actual time taken to complete the lab: 4 hours
Description of the program and how to run it: Draws several shapes on a canvas
Files/networks/data/html required to run the program: You need an internet
connection and a web browser to run this program.
*/
class Circle {
  // set up member variables
  private $location;
  private $fgColor = array('r' => 10, 'g' => 100, 'b' => 220);
  private $bgColor = array('r' => 0, 'g' => 0, 'b' => 0);
  private $size;
  private $canvasHeight;
  private $canvasWidth;
  private $im;

  // construct the object, including the canvas
  public function __construct($size, $location, $canvasHeight, $canvasWidth) {
    $this->size = $size;
    $this->location = $location;
    $this->canvasHeight = $canvasHeight;
    $this->canvasWidth = $canvasWidth;
    $this->im = imagecreatetruecolor($this->canvasWidth, $this->canvasHeight) or die('Cannot Initialize new GD image stream');
  }

  public function draw() {
    /* Define the foreground and background colours and fill the image with the bacground colour.
    The foreground colour is passed as a parameter, the background colour is white */
    $bgcolor = imagecolorallocate($this->im,
                                  $this->bgColor['r'],
                                  $this->bgColor['g'],
                                  $this->bgColor['b']);

    $fgcolor = imagecolorallocate($this->im,
                                  $this->fgColor['r'],
                                  $this->fgColor['g'],
                                  $this->fgColor['b']);

    imagefill($this->im, 0, 0, $bgcolor); 

    // Check to make sure the shape isn't off the screen, adjust if needed
    if ($this->location['x'] < 0) {
      $this->location['x'] = 0;
    }
    if ($this->location['x'] > $canvasWidth) {
      $this->location['x'] = $canvasWidth;
    }

    if ($this->location['y'] < 0) {
      $this->location['y'] = 0;
    }
    if ($this->location['y'] > $canvasHeight) {
      $this->location['y'] = $canvasHeight;
    }

    // draw the circle
    imageellipse($this->im,
                 $this->location['x'],
                 $this->canvasHeight - $this->location['y'],
                 $this->size,
                 $this->size,
                 $fgcolor);
  }

  // display the image that has been drawn
  public function display() {
    header ('Content-type: image/png');

    /* Write the image to standard out - in the case of the web server to the network to the browser
    and free up any memory used by the image */
    imagepng($this->im);
    imagedestroy($this->im);
  }

  // multiply the circle bigger by X amount
  public function bigger($big) {
    $this->size *= $big;
  }

  // divide by X to make the shape smaller
  public function smaller($small) {
    $this->size /= $small;
  }

  // subtract pixels on the horizontal plane to go left
  public function left($left) {
    $this->location['x'] -= $left;
  }

  // add pixels on the horizontal plane to go right
  public function right($right) {
    $this->location['x'] += $right;
  }

  // add pixels on the vertical plane to go up
  public function up($up) {
    $this->location['y'] += $up;
  }

  // subtract pixels on the vertical plane to go down
  public function down($down) {
    $this->location['y'] -= $down;
  }
}

class Square {
  // set up member variables
  private $location;
  private $fgColor = array('r' => 255, 'g' => 255, 'b' => 255);
  private $bgColor = array('r' => 240, 'g' => 10, 'b' => 200);
  private $canvasHeight;
  private $canvasWidth;
  private $im;

  // construct the object, including the canvas
  public function __construct($location, $canvasHeight, $canvasWidth) {
    $this->location = $location;
    $this->canvasHeight = $canvasHeight;
    $this->canvasWidth = $canvasWidth;
    $this->im = imagecreatetruecolor($this->canvasWidth, $this->canvasHeight) or die('Cannot Initialize new GD image stream');
  }

  public function draw() {
    /* Define the foreground and background colours and fill the image with the bacground colour.
    The foreground colour is passed as a parameter, the background colour is white */
    $bgcolor = imagecolorallocate($this->im,
                                  $this->bgColor['r'],
                                  $this->bgColor['g'],
                                  $this->bgColor['b']);

    $fgcolor = imagecolorallocate($this->im,
                                  $this->fgColor['r'],
                                  $this->fgColor['g'],
                                  $this->fgColor['b']);

    imagefill($this->im, 0, 0, $bgcolor); 

    // Check to make sure the shape isn't off the screen, adjust if needed
    $tmpWidth = $this->location['x2']-$this->location['x'];
    $tmpHeight = $this->location['y2']-$this->location['y'];

    if ($this->location['x'] < 0 || $this->location['y'] < 0) {
      $this->location['x'] = 0;
      $this->location['y'] = 0;
    }
    if ($this->location['x2'] < 0 || $this->location['y2'] < 0) {
      $this->location['x2'] = 0;
      $this->location['y2'] = 0;
    }
    if ($this->location['x'] > $canvasWidth || $this->location['y'] > $canvasHeight) {
      $this->location['x'] = $canvasWidth;
      $this->location['y'] = $canvasHeight;
    }
    if ($this->location['x2'] > $canvasWidth || $this->location['y2'] > $canvasHeight) {
      $this->location['x2'] = $canvasWidth;
      $this->location['y2'] = $canvasHeight;
    }

    if ($this->location['x'] == 0 && $this->location['x'] == 0) {
      $this->location['x'] = $tmpWidth;
      $this->location['y'] = $tmpHeight;
    }

    if ($this->location['x'] == $canvasWidth && $this->location['x'] == $canvasWidth) {
      $this->location['x'] = $this->canvasWidth-$tmpWidth;
      $this->location['y'] = $this->canvasHeight-$tmpHeight;
    }

    // Draw a rectangle
    imagerectangle($this->im,
                 $this->location['x'],
                 $this->canvasHeight - $this->location['y'],
                 $this->location['x2'],
                 $this->canvasHeight - $this->location['y2'],
                 $fgcolor);
  }

  public function display() {
    // Output the header telling the browser this is a png image.
    header ('Content-type: image/png');

    /* Write the image to standard out - in the case of the web server to the network to the browser
    and free up any memory used by the image */
    imagepng($this->im);
    imagedestroy($this->im);
  }

  // add to the coordinates to make larger
  public function bigger($big) {
    $this->location['x'] -= $big;
    $this->location['x2'] += $big;
    $this->location['y'] -= $big;
    $this->location['y2'] += $big;
  }

  // divide by X to make the shape smaller
  public function smaller($small) {
    foreach (array_keys($this->location) as $key) {
      $this->location[$key] /= $small;
    }
  }

  // subtract pixels on the horizontal plane to go left
  public function left($left) {
    foreach (array_keys($this->location) as $key) {
      if ($key == 'x' || $key == 'x2') {
        $this->location[$key] = $this->location[$key]-$left;
      }
    }
  }

  // add pixels on the horizontal plane to go right
  public function right($right) {
    foreach (array_keys($this->location) as $key) {
      if ($key == 'x' || $key == 'x2') {
        $this->location[$key] = $this->location[$key]+$right;
      }
    }
  }

  // add pixels on the vertical plane to go up
  public function up($up) {
    foreach (array_keys($this->location) as $key) {
      if ($key == 'y' || $key == 'y2') {
        $this->location[$key] = $this->location[$key]+$up;
      }
    }
  }

  // subtract pixels on the vertical plane to go down
  public function down($down) {
    foreach (array_keys($this->location) as $key) {
      if ($key == 'y' || $key == 'y2') {
        $this->location[$key] = $this->location[$key]-$down;
      }
    }
  }
}


class Triangle {
  // set up member variables
  private $location;
  private $fgColor = array('r' => 155, 'g' => 64, 'b' => 25);
  private $bgColor = array('r' => 25, 'g' => 64, 'b' => 155);
  private $canvasHeight;
  private $canvasWidth;
  private $im;

  // construct the object, including the canvas
  public function __construct($location, $canvasHeight, $canvasWidth) {
    $this->location = $location;
    $this->canvasHeight = $canvasHeight;
    $this->canvasWidth = $canvasWidth;
    $this->im = imagecreatetruecolor($this->canvasWidth, $this->canvasHeight) or die('Cannot Initialize new GD image stream');
  }

  public function draw() {    

    /* Define the foreground and background colours and fill the image with the bacground colour.
    The foreground colour is passed as a parameter, the background colour is white */
    $bgcolor = imagecolorallocate($this->im,
                                  $this->bgColor['r'],
                                  $this->bgColor['g'],
                                  $this->bgColor['b']);

    $fgcolor = imagecolorallocate($this->im,
                                  $this->fgColor['r'],
                                  $this->fgColor['g'],
                                  $this->fgColor['b']);

    imagefill($this->im, 0, 0, $bgcolor); 

    // loop through the y coordinates and compensates
    for ($i = 1; $i < count($this->location); $i += 2) {
      $this->location[$i] = $this->canvasHeight - $this->location[$i];
    }

    // Check to make sure each vertex isn't off the screen, adjust if needed
    if ($this->location[0] < 0 || $this->location[1] < 0) {
      $this->location[0] = 0;
      $this->location[1] = 0;
    }
    if ($this->location[2] < 0 || $this->location[3] < 0) {
      $this->location[2] = 0;
      $this->location[3] = 0;
    }
    if ($this->location[4] < 0 || $this->location[5] < 0) {
      $this->location[4] = 0;
      $this->location[5] = 0;
    }
    if ($this->location[0] > $canvasWidth || $this->location[1] > $canvasHeight) {
      $this->location[0] = $canvasWidth;
      $this->location[1] = $canvasHeight;
    }
    if ($this->location[2] > $canvasWidth || $this->location[3] > $canvasHeight) {
      $this->location[2] = $canvasWidth;
      $this->location[3] = $canvasHeight;
    }

    if ($this->location[4] > $canvasWidth || $this->location[5] > $canvasHeight) {
      $this->location[4] = $canvasWidth;
      $this->location[5] = $canvasHeight;
    }

    // draw a triangle
    imagepolygon($this->im,
                 $this->location,
                 3,
                 $fgcolor);
  }

  public function display() {
    // Output the header telling the browser this is a png image.
    header ('Content-type: image/png');

    /* Write the image to standard out - in the case of the web server to the network to the browser
    and free up any memory used by the image */
    imagepng($this->im);
    imagedestroy($this->im);
  }

  // add to the coordinates to make larger
  public function bigger($big) {
    $this->location[0] -= $big;
    $this->location[1] -= $big;
    $this->location[2] += $big;
    $this->location[3] += $big;
    $this->location[4] += $big;
    $this->location[5] += $big;
  }

  // divide by X to make the shape smaller
  public function smaller($small) {
    foreach (array_keys($this->location) as $key) {
      $this->location[$key] /= $small;
    }
  }

  // subtract pixels on the horizontal plane to go left
  public function left($left) {
    for ($i = 0; $i < count($this->location); $i += 2) {
      $this->location[$i] = $this->location[$i]-$left;
    }
  }

  // add pixels on the horizontal plane to go right
  public function right($right) {
    for ($i = 0; $i < count($this->location); $i += 2) {
      $this->location[$i] = $this->location[$i]+$right;
    }
  }

  // add pixels on the vertical plane to go up
  public function up($up) {
    for ($i = 1; $i < count($this->location); $i += 2) {
      $this->location[$i] = $this->location[$i]+$up;
    }
  }

  // subtract pixels on the vertical plane to go down
  public function down($down) {
    for ($i = 1; $i < count($this->location); $i += 2) {
      $this->location[$i] = $this->location[$i]-$down;
    }
  }
}
?>