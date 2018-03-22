<?php

use PHPUnit\Framework\TestCase;

require_once('../cmsController.php');
require_once('../portfolioLogic.php');

class StackTest extends TestCase
{
    //createfirstPfItem
    //success
    public function testCreateFirstPfItemSuccess ()
    {
        $input=[0=>['title'=>'test','description'=>'test','imgRef'=>'test','github'=>'test','projURL'=>'test','url'=>'test','altText'=>'test']];
        $expected= "<article class='primaryPfItem'>
				<section class='itemPic'>
					<img src=test alt=test/>
				</section>
				<section class='itemText'>
					<h3>
						<a href='test'>test</a>
					</h3>
					<p>test
					</p>
				</section>
			</article>";
        $case= createFirstPfItem($input);
        $this->assertEquals($case, $expected);
    }

    //failure
    public function testCreateFirstPfItemFailure ()
    {
        $input=[0=>['title'=>1,'description'=>1,'imgRef'=>1,'github'=>1,'projURL'=>1,'url'=>1,'altText'=>1]];
        $expected= "<article class='primaryPfItem'>
				<section class='itemPic'>
					<img src=1 alt=1/>
				</section>
				<section class='itemText'>
					<h3>
						<a href='1'>1</a>
					</h3>
					<p>1
					</p>
				</section>
			</article>";
        $case= createFirstPfItem($input);
        $this->assertEquals($case, $expected);
    }

//    malformed
    public function testCreateFirstPfItemMalformed ()
    {
        $input="'title'=>1,'description'=>1,'imgRef'=>1,'github'=>1,'projURL'=>1,'url'=>'1','altText'=>1";
        $this->expectException(TypeError::class);
        createFirstPfItem($input);
    }


        //createNonFirstPfItem
    //success
    public function testNonCreateFirstPfItemSuccess ()
    {
        $input=[0=>['title'=>'test','description'=>'test','imgRef'=>'test','github'=>'test','projURL'=>'test','url'=>'test','altText'=>'test']];
        $expected= "<article class='secondaryPfItem'>
				    <section class='itemPic'>
					    <img src=test alt=test/>
				    </section>
				    <section class='itemText'>
					    <h3>
						    <a href='test'>test</a>
					    </h3>
					    <p>test
					    </p>
				    </section>
			    </article>";
        $case= createNonFirstPfItem($input);
        $this->assertEquals($case, $expected);
    }

    public function testNonCreateFirstPfItemFailure ()
    {
        $input=[0=>['title'=>1,'description'=>1,'imgRef'=>1,'github'=>1,'projURL'=>1,'url'=>1,'altText'=>1]];
        $expected= "<article class='secondaryPfItem'>
				    <section class='itemPic'>
					    <img src=1 alt=1/>
				    </section>
				    <section class='itemText'>
					    <h3>
						    <a href='1'>1</a>
					    </h3>
					    <p>1
					    </p>
				    </section>
			    </article>";
        $case= createNonFirstPfItem($input);
        $this->assertEquals($case, $expected);
    }
//    malformed
    public function testCreateNonFirstPfItemMalformed ()
    {
        $input="'title'=>1,'description'=>1,'imgRef'=>1,'github'=>1,'projURL'=>1,'url'=>'1','altText'=>1";
        $this->expectException(TypeError::class);
        createNonFirstPfItem($input);
    }


    //CreateArticles
    //success
    public function testCreateArticlesSuccess () {
        $input =[0=>['title'=>'testTitle','description'=>'testDesc','url'=>'testURL']];
        $expected="<div class='blogs'>
				<a href='testURL'>testTitle</a>
				<p>testDesc</p>
			</div>";
        $case=createArticles($input);
        $this->assertEquals($case,$expected);
    }

    //success
    public function testCreateArticlesFailure() {
        $input =[0=>['title'=>1,'description'=>2,'url'=>3]];
        $expected="<div class='blogs'>
				<a href='3'>1</a>
				<p>2</p>
			</div>";
        $case=createArticles($input);
        $this->assertEquals($case,$expected);
    }

    //malformed
    public function testCreateArticleMalformed() {
        $input="'title'=>1,'description'=>2,'url'=>3";
        $this->expectException(TypeError::class);
        createArticles($input);
    }

}