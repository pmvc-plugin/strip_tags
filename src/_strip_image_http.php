<?php

namespace PMVC\PlugIn\strip_tags;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\strip_image_http';

class strip_image_http
{
    function __invoke($html)
    {
        $reg = '/(\\<img)([^\\>]*)(\\>)/';
        $html = preg_replace_callback (
           $reg,
           function($matchs) {
              $reg = '/((src)\\=\")([^\"]*)(\")/'; 
              preg_match($reg, $matchs[0], $src);
              if (isset($src[3])) {
                  $src = preg_replace('/^(http|https):\/\//','//',$src[3]);
                  return '<img src="'.$src.'" />';
              } else {
                  return '';
              }
           },
           $html
        );
        return $html;
    }
}
