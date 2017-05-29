<?php

include_once ('../NiceClass.php');
include_once ('../MegaDB.php');
include_once ('../vendor/autoload.php');

use PHPUnit\Framework\TestCase;

class NiceThingTest extends TestCase {
	
	public function testGetFullName() {
		$niceThingRow = ['firstName'=>'Horse', 'surName'=>'Face'];

		$expected = 'Horse Face';
		
		$DB = NULL;

		$niceClass = new NiceClass($DB);

		$name = $niceClass->getFullName($niceThingRow);

		$this->assertEquals(
			$expected,
			$name,
			"Could not put name together properly"
		);
	}
	
	public function testGetNiceThing() {
		
		$niceThingRow = [
			'firstName'=>'Horse',
			'surName'=>'Face',
			'data'=>'blah blah',
			'otherStuff'=>123
		];
		
		$expected = [
			'firstName'=>'Horse',
			'surName'=>'Face',
			'data'=>'blah blah',
			'otherStuff'=>123,
			'fullName'=>"Horse Face",
			'isFine'=>true
		];

		$DB = $this->getMockBuilder('MegaDB')
			->getMock();

		$DB->expects($this->once())
			->method('GetRow')
			->will($this->returnValue($niceThingRow));

		$niceClass = new NiceClass($DB);

		$return = $niceClass->getNiceThing(123);

		$this->assertEquals(
			$expected,
			$return,
			"Could not fetch a nice thing"
		);
	}

	public function testGetNoNiceThing() {
		$DB = NULL;

		$niceClass = new NiceClass($DB);

		$return = $niceClass->getNiceThing(false);

		$this->assertFalse(
			$return,
			"Could not return an empty nice thing"
		);
	}	
}

