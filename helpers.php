<?php

/**
 * Generate an random image from unsplash.
 *
 * @param integer $width
 * @param integer $height
 * @param string|null $category
 * @return string
 */
function unsplash($width = 720, $height = 640, $category = null)
{
    return "https://source.unsplash.com/random/{$width}x{$height}/?{$category}&id=" . rand();
}
