<?php

namespace Popy\Csv\Reader;

/**
 * Reads a string as CSV
 */
class StringReader extends AbstractReaderWrapper
{
    /**
     * Class constructor : initialize a stream in memory containing the string to read
     * 
     * @param string $string Input string/data
     */
    public function __construct($string)
    {
        $stream = fopen('php://temp', 'r+');

        fwrite($stream, $string);

        $this->internal = new StreamReader($stream);
    }

}

