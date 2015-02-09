<?php

namespace Popy\Csv\Exception;

use Exception, RuntimeException;
use Popy\Csv\Csv;

/**
 * Stream-related exception
 */
abstract class AbstractStreamException extends RuntimeException {
    
    /**
     * Csv triggering the exception
     * 
     * @var Csv
     */
    protected $csv;
    
    /**
     * Last error
     * 
     * @var array
     */
    protected $error;

    /**
     * Exception constructor
     * 
     * @param Csv            $csv              Csv triggering the exception
     * @param array          $error            error_get_last return value
     * @param integer        $code             Exception code
     * @param Exception|null $previous         Previous exception
     */
    public function __construct(Csv $csv, array $error, $code = 0, Exception $previous = null)
    {
        $this->csv = $csv;
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
     * Get Csv instance
     * 
     * @return Csv
     */
    public function getCsv()
    {
        return $this->csv;
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