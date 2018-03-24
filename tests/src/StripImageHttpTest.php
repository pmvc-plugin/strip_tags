<?php
namespace PMVC\PlugIn\strip_tags;

use PHPUnit_Framework_TestCase;

class StripImageHttpTest extends PHPUnit_Framework_TestCase
{

    private $_plug = 'strip_tags';

    function testStripHttp()
    {
        $text = '<img src="http://abc.com" />';
        $p = \PMVC\plug($this->_plug);
        $actual = $p->strip_image_http($text);
        $expected = '<img src="//abc.com" />';
        $this->assertEquals($expected, $actual);
    }

    function testStripHttps()
    {
        $text = '<img src="https://abc.com" />';
        $p = \PMVC\plug($this->_plug);
        $actual = $p->strip_image_http($text);
        $expected = '<img src="//abc.com" />';
        $this->assertEquals($expected, $actual);
    }
}
