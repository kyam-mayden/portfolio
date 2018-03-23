<?php

use PHPUnit\Framework\TestCase;

require_once('../cmsController.php');
require_once('../portfolioLogic.php');

class StackTest extends TestCase
{
    //makeDropDown
    //success

    public function testDropDownSuccess ()
    {
        $input = [['title' => 'test']];
        $expected = '<option value="test">test</option>';
        $case = makeDropDown($input);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testDropDownMalformed ()
    {
        $input1 = 'title';
        $this->expectException(TypeError::class);
        makeDropDown($input1);
    }

}