<?php

namespace Popy\Csv\Exception;

use Exception, InvalidArgumentException;
use Popy\Csv\Writer;

/**
 * Exception thrown when a non array/traversable row is given to a Writer
 */
class InvalidInputRow extends InvalidArgumentException implements WriteException
{
    
    /**
     * Writer triggering the exception
     * 
     * @var Writer
     */
    protected $writer;

    /**
     * The invalid row
     * 
     * @var mixed
     */
    protected $row;

    /**
     * Class constructor
     * 
     * @param Writer         $writer   Writer triggering the exception
     * @param mixed          $row      The invalid row
     * @param integer        $code     Exception code
     * @param Exception|null $previous Previous exception
     */
    public function __construct(Writer $writer, $row, $code = 0, Exception $previous = null)
    {
        $this->writer = $writer;
        $this->row = $row;

        parent::__construct(
            sprintf(
                'Invalid row supplied to "%s" writer. Array/Iterable expected, got "%s"',
                get_class($writer),
                is_object($row) ? get_class($row) : gettype($row)
            ),
            $code,
            $previous
        );
    }

    /**
     * Get writer
     * 
     * @return Writer
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * Get row
     * 
     * @return mixed
     */
    public function getRow()
    {
        return $this->row;
    }

}