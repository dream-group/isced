<?php

use Dream\Isced;

class IscedTest extends PHPUnit_Framework_TestCase
{
	
    public function testCodeValidation()
    {
        $this->assertEquals(Isced::isCode('01015', Isced::VERSION_2011), true);
        $this->assertEquals(Isced::isCode('6', Isced::VERSION_2011), true);
        $this->assertEquals(Isced::isCode('010151', Isced::VERSION_2011), false);
        $this->assertEquals(Isced::isCode('011', Isced::VERSION_2011), false);

        $this->assertEquals(Isced::isCode('0213', Isced::VERSION_2013), true);
        $this->assertEquals(Isced::isCode('011', Isced::VERSION_2013), true);
        $this->assertEquals(Isced::isCode('311', Isced::VERSION_2013), false);
        $this->assertEquals(Isced::isCode('720', Isced::VERSION_2013), false);
    }
	
    public function testNameByCode()
    {
        $this->assertEquals(Isced::fetchNameByCode('01015', Isced::VERSION_2011), 'Religion/Ethics');
        $this->assertEquals(Isced::fetchNameByCode('1422', Isced::VERSION_2011), 'Education science 05.7');
        $this->assertEquals(Isced::fetchNameByCode('7', Isced::VERSION_2011), 'Health and Welfare');

        $this->assertEquals(Isced::fetchNameByCode('0113', Isced::VERSION_2013), 'Teacher training without subject specialization');
        $this->assertEquals(Isced::fetchNameByCode('061', Isced::VERSION_2013), 'Information and Communication Technologies (ICTs)');
        $this->assertEquals(Isced::fetchNameByCode('0917', Isced::VERSION_2013), 'Traditional and complementary medicine and therapy');
    }
	
    public function testCrumbsByCode()
    {

    }
	
    public function testFullList()
    {

    }
	
}