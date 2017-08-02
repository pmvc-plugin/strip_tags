<?php
namespace PMVC\PlugIn\strip_tags;

use PHPUnit_Framework_TestCase;

class Strip_tagsTest extends PHPUnit_Framework_TestCase
{
    private $_plug = 'strip_tags';
    function testPlugin()
    {
        ob_start();
        print_r(\PMVC\plug($this->_plug));
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertContains($this->_plug,$output);
    }

    /**
     * @dataProvider stripProvider 
     */
    function testStripScriptStyle($text, $expected)
    {
        $p = \PMVC\plug($this->_plug);
        $actual = $p->strip($text);
        $this->assertEquals($expected, $actual );
    }

    function stripProvider()
    {
        return [
            [
                '<script>123</script><style>456</style><div>789</div>',
                '789',
            ],
            [
                '<style>456</style><div>789</div><script>123</script>',
                '789',
            ],
            [
                '<style>456</style>'.PHP_EOL.'<div>789</div>'.PHP_EOL.'<script>123</script>',
                PHP_EOL.'789'.PHP_EOL,
            ]
        ];
    }
}
