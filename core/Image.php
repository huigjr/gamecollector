<?php

class Image
{
    private $image;
    private $width;
    private $height;
    private $mime;

    public function __construct($path=null)
    {
        if($path) $this->load($path);
    }
    
    public function getFiles($dir)
    {
        return array_diff(scandir($dir), ['.', '..']);
    }

    public function scale($percent)
    {
        $width = round($this->width * ($percent / 100));
        $height = round($this->height * ($percent / 100));
        $this->resize($width, $height);
    }
    
    public function scaleToHeight($height)
    {
        $width = round(($this->width / $this->height) * $height);
        $this->resize($width, $height);
    }
    
    public function scaleToWidth($width)
    {
        $height = round(($this->height / $this->width) * $width);
        $this->resize($width, $height);
    }
    
    public function load($path)
    {
        $info = getimagesize($path);
        $this->width = $info[0];
        $this->height = $info[1];
        $this->mime = $info['mime'];
        return ($this->height > 0) ? $this->import($path) : 0;
    }

    public function save($path, $quality=80)
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if($extension === 'webp') return imagewebp($this->image, $path, $quality);
        elseif($extension === 'jpg') return imagejpeg($this->image, $path, $quality);
        elseif($extension === 'png') return imagepng($this->image, $path, $quality);
        elseif($extension === 'gif') return imagegif($this->image, $path, $quality);
        else return false;
    }
    
    public function output($quality=80)
    {
        header("Content-Type: image/webp");
        imagewebp($this->image, null, $quality);
        exit;
    }
    
    public function resize($width, $height)
    {
        $canvas = imagecreatetruecolor($width, $height);
        imagecopyresampled($canvas, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
        $this->image = $canvas;
        
    }

    private function import($path) {
    	if($this->mime === 'image/jpeg') $this->image = imagecreatefromjpeg($path);
    	if($this->mime === 'image/gif') $this->image = imagecreatefromgif($path);
    	if($this->mime === 'image/png') $this->image = imagecreatefrompng($path);
    	if($this->mime === 'image/webp') $this->image = imagecreatefromwebp($path);
    	return !empty($this->image);
    }
}