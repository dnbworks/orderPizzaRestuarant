<?php

namespace app\helpers;

class Graph {

    public int $width;
    public int $height;
    public array $graphData;
    public int $max;
    public string $filename;

    public function __construct($width, $height, $data, $max_value, $filename)
    {
        $this->width = $width;
        $this->height = $height;
        $this->graphData = $data;
        $this->max = $max_value;
        $this->filename = $filename;
    }

    public function createGraph(){
            // Create the empty graph image
        $img = imagecreatetruecolor($this->width, $this->height);

        // Set a white background with black text and gray graphics
        $bg_color = imagecolorallocate($img, 255, 255, 255);       // white
        $text_color = imagecolorallocate($img, 255, 255, 255);     // white
        $bar_color = imagecolorallocate($img, 0, 0, 0);            // black
        $border_color = imagecolorallocate($img, 192, 192, 192);   // light gray

        // Fill the background
        imagefilledrectangle($img, 0, 0, $this->width, $this->height, $bg_color);

        // Draw the bars
        $bar_width = $this->width / ((count($this->graphData) * 2) + 1);
        for ($i = 0; $i < count($this->graphData); $i++) {
        imagefilledrectangle($img, ($i * $bar_width * 2) + $bar_width, $this->height,
            ($i * $bar_width * 2) + ($bar_width * 2), $this->height - (($this->height / $this->max) * $this->graphData[$i][1]), $bar_color);
        imagestringup($img, 5, ($i * $bar_width * 2) + ($bar_width), $this->height - 5, $this->graphData[$i][0], $text_color);
        }

        // Draw a rectangle around the whole thing
        imagerectangle($img, 0, 0, $this->width - 1, $this->height - 1, $border_color);

        // Draw the range up the left side of the graph
        for ($i = 1; $i <= $this->max; $i++) {
        imagestring($img, 5, 0, $this->height - ($i * ($this->height / $this->max)), $i, $bar_color);
        }

        // Write the graph image to a file
        imagepng($img, $this->filename, 5);
        imagedestroy($img);
    }
}

// self::$draw_bar_graph(480, 240, $category_totals, 5, location . Application::$app->user->user_id . '-mymismatchgraph.png');
