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
        $this->assertEquals(Isced::fetchCrumbsByCode('01015', Isced::VERSION_2011), [
            '01015' => 'Religion/Ethics',
            '010'   => 'Basic/broad, general programmes',
            '01'    => 'Basic/broad, general programmes',
            '0'     => 'General Programmes'
        ]);
        $this->assertEquals(Isced::fetchCrumbsByCode('1422', Isced::VERSION_2011), [
            '1422'  => 'Education science 05.7',
            '142'   => 'Education science',
            '14'    => 'Teacher training and education science',
            '1'     => 'Education'
        ]);
        $this->assertEquals(Isced::fetchCrumbsByCode('7', Isced::VERSION_2011), [
            '7'     => 'Health and Welfare'
        ]);

        $this->assertEquals(Isced::fetchCrumbsByCode('0113', Isced::VERSION_2013), [
            '0113'  => 'Teacher training without subject specialization',
            '011'   => 'Education 011',
            '01'    => 'Education'
        ]);
        $this->assertEquals(Isced::fetchCrumbsByCode('061', Isced::VERSION_2013), [
            '061'   => 'Information and Communication Technologies (ICTs)',
            '06'    => 'Information and Communication Technologies (ICTs)'
        ]);
        $this->assertEquals(Isced::fetchCrumbsByCode('0917', Isced::VERSION_2013), [
            '0917'  => 'Traditional and complementary medicine and therapy',
            '091'   => 'Health',
            '09'    => 'Health and welfare'
        ]);
    }

    public function testFullList()
    {

    }
	
}