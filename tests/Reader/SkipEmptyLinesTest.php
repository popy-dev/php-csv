<?php

namespace Popy\Csv\Tests\Reader;

use PHPUnit_Framework_TestCase;
use Popy\Csv\Reader\SkipEmptyLines;

/**
 * SkipEmptyLines Reader test case
 */
class SkipEmptyLinesTest extends PHPUnit_Framework_TestCase
{
    public function testRewindWithNonEmptyLine()
    {
        $iterator = $this->getMock('Iterator');

        $iterator
            ->expects($this->once())
            ->method('rewind')
        ;

        $iterator
            ->expects($this->once())
            ->method('valid')
            ->will($this->returnValue(true))
        ;

        $iterator
            ->expects($this->once())
            ->method('current')
            ->will($this->returnValue(array('yolo')))
        ;

        $reader = new SkipEmptyLines($iterator);
        $reader->rewind();
    }

    public function testRewindWithEmptyFirstLine()
    {
        $iterator = $this->getMock('Iterator');

        $iterator
            ->expects($this->once())
            ->method('rewind')
        ;

        $iterator
            ->expects($this->exactly(2))
            ->method('valid')
            ->will($this->returnValue(true))
        ;

        $iterator
            ->expects($this->exactly(2))
            ->method('current')
            ->will($this->onConsecutiveCalls(array(null), array('yolo')))
        ;

        $iterator
            ->expects($this->once())
            ->method('next')
        ;


        $reader = new SkipEmptyLines($iterator);
        $reader->rewind();
    }
}
