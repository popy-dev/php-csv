<?php

namespace Popy\Csv\Tests\Reader;

use Popy\Csv\Reader\NamedColumnReader;
use Popy\Csv\Reader\SplFileInfoReader;
use SplFileObject;
use Popy\Csv\Exception\ReadException;
use PHPUnit_Framework_TestCase;

class NamedColumnReaderTest extends PHPUnit_Framework_TestCase {
    public function getReader()
    {
        return new SplFileInfoReader(new SplFileObject('tests/data/sample-01.csv'));
    }

    public function testSampleFile()
    {
        $reader = new NamedColumnReader($this->getReader(), array('a', 'b'));

        foreach ($reader as $key => $value) {
            $this->assertArrayHasKey('a', $value);
            $this->assertArrayHasKey('b', $value);
            $this->assertCount(2, $value);
        }
    }


    /**
     * @expectedException Popy\Csv\Exception\ReadException
     */
    public function testWrongColumnCountFile()
    {
        $reader = new NamedColumnReader($this->getReader(), array('a', 'b', 'c'));

        foreach ($reader as $key => $value) {
        }
    }
}