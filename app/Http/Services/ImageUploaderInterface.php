<?php

interface ImageUploaderInterface
{

    public function upload($image, $destination, $size=[150,150]) : string;
    public function createDirecrotory($dir) : bool;

}
