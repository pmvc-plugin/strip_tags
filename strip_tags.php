<?php

namespace PMVC\PlugIn\strip_tags;

use PMVC\PlugIn;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\strip_tags';

class strip_tags extends PlugIn
{
    public function init()
    {
        if ($this['stripSpace']) {
            $this['strip'] = function($s) {
                return $this->stripTagsAndSpace($s);
            };
        } else {
            $this['strip'] = function($s) {
                return $this->stripTags($s);
            };
        }
    }

    public function stripSpace($s)
    {
        return \PMVC\plug('utf8')->eregReplace('[\s\s]+', ' ', $s);
    }

    public function stripTagsAndSpace($s)
    {
        return $this->stripSpace($this->stripTags($s));
    }

    public function stripTags($s)
    {
        return strip_tags($this->stripScriptStyle($s));
    }

    public function stripScriptStyle($s)
    {
        return preg_replace('/<(script|style)[^>]*?>(.*?)<\/\\1>/si', '', $s);
    }
}
