<?php

namespace Popy\Csv\Exception;

use Exception;
use Popy\Csv\Reader;
use Popy\Csv\Reader\NamedColumnReader;

/**
 * Read operation exception raised by NamedColumnReader
 */
class ReadStreamException extends ReadException implements IOException {
    
    /**
     * Csv reader triggering the exception
     * 
     * @var Reader
     */
    protected $reader;
    
    /**
     * Last error
     * 
     * @var array
     */
    protected $error;

    /**
     * Exception constructor
     * 
     * @param Reader         $reader           Csv reader triggering the exception
     * @param array          $error            error_get_last return value
     * @param integer        $code             Exception code
     * @param Exception|null $previous         Previous exception
     */
    public function __construct(Reader $reader, array $error, $code = 0, Exception $previous = null)
    {
        $this->reader = $reader;
        $this->error = $error;
        $this->row = $row;

        parent::__construct(
            sprintf(
                'An error occured while manipulating a stream : "%s"',
                $error['message'],
            ),
            $code,
            $previous
        );
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
    
    /**
     * Get error
     * 
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }
}