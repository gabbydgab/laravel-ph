<?php

/**
 * Get all timezones.
 *
 * @return array
 */
function timezones()
{
    return DateTimeZone::listIdentifiers(DateTimeZone::ALL);
}

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

/**
 * Generate a google map embeddable iframe.
 *
 * @return string
 */
function google_map_embed($width = '100%', $height = 320)
{
    return <<<EOD
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3863.1608892915024!2d121.19283431496427!3d14.475449184011854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTTCsDI4JzMxLjYiTiAxMjHCsDExJzQyLjEiRQ!5e0!3m2!1sen!2sph!4v1579798444195!5m2!1sen!2sph"
    width="$width"
    height="$height"
    frameborder="0"
    style="border:0;"
    allowfullscreen="">
</iframe>
EOD;
}
