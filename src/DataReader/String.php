<?php

namespace Popy\Csv\DataReader;

/**
 * String DataReader.
 */
class String extends Stream
{
    /**
     * Class constructor : initialize a stream in memory containing the string to read.
     *
     * @param string $string Input string/data
     */
    public function __construct($string)
    {
        $stream = fopen('php://temp', 'r+');

        fwrite($stream, $string);

        parent::__construct($stream);

        $this->seek(0);
    }
}
