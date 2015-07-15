<?php

namespace Popy\Csv\Tests\Reader;

use PHPUnit_Framework_TestCase;
use Popy\Csv\Reader\Basic;

/**
 * Basic Reader test case
 */
class BasicTest extends PHPUnit_Framework_TestCase
{
    public function testRewindCallsSeekIfReaderIsSeekable()
    {
        $reader = $this->getMock('Popy\Csv\DataReader');
        $options = $this->getMock('Popy\Csv\Options');

        $reader
            ->expects($this->once())
            ->method('isSeekable')
            ->will($this->returnValue(true))
        ;

        $reader
            ->expects($this->once())
            ->method('seek')
            ->with($this->equalTo(0))
            ->will($this->returnValue(true))
        ;

        $reader = new Basic($reader, $options);
        $reader->rewind();
    }

    public function testRewindWithNonSeekableReader()
    {
        $reader = $this->getMock('Popy\Csv\DataReader');
        $options = $this->getMock('Popy\Csv\Options');

        $reader
            ->expects($this->once())
            ->method('isSeekable')
            ->will($this->returnValue(false))
        ;

        $reader = new Basic($reader, $options);
        $reader->rewind();
    }

    public function testNextWithEofReader()
    {
        $reader = $this->getMock('Popy\Csv\DataReader');
        $options = $this->getMock('Popy\Csv\Options');

        $reader
            ->expects($this->once())
            ->method('eof')
            ->will($this->returnValue(true))
        ;

        $reader = new Basic($reader, $options);
        $reader->next();

        $this->assertNull($reader->current());
        $this->assertNull($reader->key());
        $this->assertFalse($reader->valid());
    }

    public function testNextWithValidReader()
    {
        $reader = $this->getMock('Popy\Csv\DataReader');
        $options = $this->getMock('Popy\Csv\Options');

        $reader
            ->expects($this->once())
            ->method('eof')
            ->will($this->returnValue(false))
        ;

        $reader
            ->expects($this->once())
            ->method('getcsv')
            ->with($this->equalTo('a'), $this->equalTo('b'), $this->equalTo('c'))
            ->will($this->returnValue('whatever'))
        ;

        $options
            ->expects($this->once())
            ->method('getDelimiter')
            ->will($this->returnValue('a'))
        ;
        $options
            ->expects($this->once())
            ->method('getEnclosure')
            ->will($this->returnValue('b'))
        ;
        $options
            ->expects($this->once())
            ->method('getEscape')
            ->will($this->returnValue('c'))
        ;

        $reader = new Basic($reader, $options);
        $reader->next();

        $this->assertTrue($reader->valid());
        $this->assertSame('whatever', $reader->current());
        $this->assertSame(1, $reader->key());
    }
}
