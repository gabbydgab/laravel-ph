<?php

namespace App;

trait HasExcerpt
{
    /**
     * Boot the trait.
     */
    public static function bootHasExcerpt()
    {
        foreach(['creating', 'updating', 'saving'] as $event) {
            static::{$event}(function ($model) {
                $model->excerpt ??= $model->getExcerptFromBody();
            });
        }
    }

    /**
     * Get the excerpt of an article.
     *
     * @param integer $length
     * @return string
     */
    public function getExcerptFromBody($length = 255)
    {
        if ($this->excerpt) {
            return $this->excerpt;
        }

        $content = preg_split('/<!-- more -->/m', $this->body, 2);
        $cleaned = trim(
            strip_tags(
                preg_replace(['/<pre>[\w\W]*?<\/pre>/', '/<h\d>[\w\W]*?<\/h\d>/'], '', $content[0]),
                '<code>'
            )
        );

        if (count($content) > 1) {
            return $content[0];
        }

        $truncated = substr($cleaned, 0, $length);

        if (substr_count($truncated, '<code>') > substr_count($truncated, '</code>')) {
            $truncated .= '</code>';
        }

        return strlen($cleaned) > $length
            ? preg_replace('/\s+?(\S+)?$/', '', $truncated) . '...'
            : $cleaned;
    }
}
