<?php

namespace Popy\Csv\Tests\Reader;

use Popy\Csv\Reader\AutoNamedColumnReader;
use Popy\Csv\Reader\SplFileInfoReader;
use SplFileObject;
use Popy\Csv\Exception\ReadException;
use PHPUnit_Framework_TestCase;

class AutoNamedColumnReaderTest extends PHPUnit_Framework_TestCase {
    public function getReader()
    {
        return new SplFileInfoReader(new SplFileObject('tests/data/sample-01.csv'));
    }

    public function testSampleFile()
    {
        $reader = new AutoNamedColumnReader($this->getReader());
        $c = 0;

        foreach ($reader as $key => $value) {
            $this->assertArrayHasKey('Column 1', $value);
            $this->assertArrayHasKey('Column 2 "heyhey"', $value);
            $this->assertCount(2, $value);
            $this->assertEquals($c + 1, $key);

            $c++;
        }

        $this->assertEquals(1, $c);
    }
}
