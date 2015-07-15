<?php

namespace Popy\Csv\Tests\DataReader;

use PHPUnit_Framework_TestCase;
use Popy\Csv\DataReader\SplFileObject;

/**
 * Popy\Csv\DataReader\SplFileObject test case
 */
class SplFileObjectTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Popy\Csv\Exception\DataReader\SplFileObjectException
     */
    public function testReadWithFreadReturnsFalseThrowsException()
    {
        $file = $this
            ->getMockBuilder('SplFileObject')
            ->setConstructorArgs(array('/dev/null'))
            //->disableOriginalConstructor()
            ->setMethods(array('fread'))
            ->getMock()
        ;

        $file
            ->expects($this->once())
            ->method('fread')
            ->with($this->equalTo(0))
            ->will($this->returnValue(false))
        ;

        $reader = new SplFileObject($file);
        $reader->read(0);
    }

    public function testReadReturnsFreadResult()
    {
        $file = $this
            ->getMockBuilder('SplFileObject')
            ->setConstructorArgs(array('/dev/null'))
            //->disableOriginalConstructor()
            ->setMethods(array('fread'))
            ->getMock()
        ;

        $file
            ->expects($this->once())
            ->method('fread')
            ->with($this->equalTo(0))
            ->will($this->returnValue('whatever'))
        ;

        $reader = new SplFileObject($file);
        $this->assertSame('whatever', $reader->read(0));
    }

    /**
     * @expectedException Popy\Csv\Exception\DataReader\SplFileObjectException
     */
    public function testGetCsvWithFgetcsvReturnsFalseThrowsException()
    {
        $file = $this
            ->getMockBuilder('SplFileObject')
            ->setConstructorArgs(array('/dev/null'))
            //->disableOriginalConstructor()
            ->setMethods(array('fgetcsv'))
            ->getMock()
        ;

        $file
            ->expects($this->once())
            ->method('fgetcsv')
            ->with($this->equalTo(','), $this->equalTo('"'), $this->equalTo('\\'))
            ->will($this->returnValue(false))
        ;

        $reader = new SplFileObject($file);
        $reader->getcsv();
    }

    public function testGetCsvReturnsFgetcsvResult()
    {
        $file = $this
            ->getMockBuilder('SplFileObject')
            ->setConstructorArgs(array('/dev/null'))
            //->disableOriginalConstructor()
            ->setMethods(array('fgetcsv'))
            ->getMock()
        ;

        $file
            ->expects($this->once())
            ->method('fgetcsv')
            ->with($this->equalTo(','), $this->equalTo('"'), $this->equalTo('\\'))
            ->will($this->returnValue(array('whatever')))
        ;

        $reader = new SplFileObject($file);
        $this->assertSame(array('whatever'), $reader->getcsv());
    }

    public function testEofCallsEof()
    {
        $file = $this
            ->getMockBuilder('SplFileObject')
            ->setConstructorArgs(array('/dev/null'))
            //->disableOriginalConstructor()
            ->setMethods(array('eof'))
            ->getMock()
        ;

        $file
            ->expects($this->once())
            ->method('eof')
            ->will($this->returnValue(true))
        ;

        $reader = new SplFileObject($file);
        $this->assertTrue($reader->eof());
    }

    public function testIsSeekableReturnsTrue()
    {

        $file = $this
            ->getMockBuilder('SplFileObject')
            ->setConstructorArgs(array('/dev/null'))
            //->disableOriginalConstructor()
            ->getMock()
        ;

        $reader = new SplFileObject($file);
        $this->assertTrue($reader->isSeekable());
    }

    /**
     * @expectedException Popy\Csv\Exception\DataReader\SplFileObjectException
     */
    public function testSeekWithFseekReturnsMinusOneThrowsException()
    {
        $file = $this
            ->getMockBuilder('SplFileObject')
            ->setConstructorArgs(array('/dev/null'))
            //->disableOriginalConstructor()
            ->setMethods(array('fseek'))
            ->getMock()
        ;

        $file
            ->expects($this->once())
            ->method('fseek')
            ->with($this->equalTo(42), $this->equalTo(SEEK_SET))
            ->will($this->returnValue(-1))
        ;

        $reader = new SplFileObject($file);
        $reader->seek(42);
    }

    public function testSeek()
    {
        $file = $this
            ->getMockBuilder('SplFileObject')
            ->setConstructorArgs(array('/dev/null'))
            //->disableOriginalConstructor()
            ->setMethods(array('fseek'))
            ->getMock()
        ;

        $file
            ->expects($this->once())
            ->method('fseek')
            ->with($this->equalTo(42), $this->equalTo(SEEK_SET))
            ->will($this->returnValue(null))
        ;

        $reader = new SplFileObject($file);
        $reader->seek(42);
    }
}
