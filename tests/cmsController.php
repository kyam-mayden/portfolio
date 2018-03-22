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
        $input=[['title'=>'test']];
        $expected= '<option value="test">test</option>';
        $case= makeDropDown($input);
        $this->assertEquals($case, $expected);
    }

    //failure
    public function testDropDownFailure ()
    {
        $input=[['title'=>'test']];
        $expected='<option value="test">test</option>';
        $case=makeDropDown($input);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testDropDownMalformed ()
    {
        $input1='title';
        $this->expectException(TypeError::class);
        makeDropDown($input1);
    }

//    makeImgDropDown
//    success

    public function testImgDropDownSuccess ()
    {
        $input1= [['id'=>'0', 'name'=> 'Pilot Shop'],['id'=>'1', 'name'=> 'Jumbotron']];
        $expected='<option value="0">Pilot Shop</option><option value="1">Jumbotron</option>';
        $case= makeImgDropDown($input1);
        $this->assertEquals($case, $expected);
    }

    //failure

    public function testImgDropDownFailure ()
    {
        $input1= [['id'=>'0', 'name'=> 600000]];
        $expected='<option value="0">600000</option>';
        $case= makeImgDropDown($input1);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testImgDropDownMalformed ()
    {
        $input1='name=>Pilot Shop';
        $this->expectException(TypeError::class);
        makeImgDropDown($input1);
    }
}

