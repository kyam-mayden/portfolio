<?php

use PHPUnit\Framework\TestCase;

require('../cmsController.php');

class StackTest extends TestCase
{
    //makeDropDown
    //success


    public function testDropDownSuccess ()
    {
        $input1=["title"=>"test"];
        $expected="<option value='test'>test<option>";
        $case= makeDropDown($input1);
        $this->assertEquals($case, $expected);
    }

    //failure
    public function testDropDownFailure ()
    {
        $input1=['title'=>'test'];
        $expected="<option value='test'>test<option>";
        $case= makeDropDown($input1);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testDropDownMalformed ()
    {
        $input1='title';
        $this->expectException(TypeError::class);
        makeDropDown($input1);
    }

}