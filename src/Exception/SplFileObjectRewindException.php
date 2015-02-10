<?php

namespace Popy\Csv\Exception;

use Exception, RuntimeException;
use Popy\Csv\Reader;
use Popy\Csv\Reader\NamedColumnReader;

/**
 * Read operation exception raised by NamedColumnReader
 */
class SplFileObjectRewindException extends RuntimeException implements ReadException
{
    
    /**
     * Csv reader triggering the exception
     * @var Reader
     */
    protected $reader;

    /**
     * Exception constructor
     * 
     * @param Reader         $reader   Csv reader triggering the exception
     * @param integer        $code     Exception code
     * @param Exception|null $previous Previous exception
     */
    public function __construct(Reader $reader, $code = 0, Exception $previous = null)
    {
        $this->reader = $reader;

        parent::__construct('Error while rewinding SplFileObject', $code, $previous);
    }

    /**
     * Get reader
     * 
     * @return Reader
     */
    public function getReader()
    {
        return $this->reader;
    }
}