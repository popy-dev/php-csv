<?php

namespace Popy\Csv\Tests\Reader;

use Popy\Csv\Reader\SplFileInfoReader;
use RuntimeException, SplFileObject, SplFileInfo;
use PHPUnit_Framework_TestCase;

class SplFileInfoReaderTest extends PHPUnit_Framework_TestCase {
    public function getMockedSplFileObject()
    {
        $file = $this
            ->getMockBuilder('SplFileObject')
            ->setConstructorArgs(array('.')) // as disableOriginalConstructor does not seems to work
            ->getMock()
        ;

        $file->expects($this->once())->method('setCsvControl');
        $file->expects($this->once())->method('setFlags');

        return $file;
    }

    public function testSplFileInfoInitialisation()
    {
        $fileInfo = $this
            ->getMockBuilder('SplFileInfo')
            ->setConstructorArgs(array('.')) // as disableOriginalConstructor does not seems to work
            ->setMethods(array('openFile'))
            ->getMock()
        ;

        $fileInfo
            ->expects($this->once())
            ->method('openFile')
            ->will($this->returnValue($this->getMockedSplFileObject()))
        ;

        $reader = new SplFileInfoReader($fileInfo);
        $reader->rewind();
    }

    public function testSplFileObjectInitialisation()
    {
        $reader = new SplFileInfoReader($this->getMockedSplFileObject());
        $reader->rewind();
    }


    public function testReadSampleSplFileObjectCsv()
    {
        $file = new SplFileObject('tests/data/sample-01.csv');
        $reader = new SplFileInfoReader($file);

        $this->assertSample1File($reader);
    }

    public function testReadSampleSpliFileInfoCsv()
    {

        $file = new SplFileInfo('tests/data/sample-01.csv');
        $reader = new SplFileInfoReader($file);

        $this->assertSample1File($reader);
    }

    protected function assertSample1File(SplFileInfoReader $reader)
    {
        $c = 0;

        foreach ($reader as $key => $value) {
            $this->assertEquals($c, $key);
            $this->assertCount(2, $value);

            $c++;
        }

        $this->assertEquals(2, $c);
    }

    /**
     * @expectedException Popy\Csv\Exception\ReadException
     */
    public function testErrorReadingFile()
    {
        $file = $this->getMockedSplFileObject();
        $file
            ->expects($this->once())
            ->method('rewind')
            ->will($this->throwException(new RuntimeException()))
        ;

        $reader = new SplFileInfoReader($file);
        $reader->rewind();
    }
}