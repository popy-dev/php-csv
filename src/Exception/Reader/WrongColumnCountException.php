<?php

namespace Popy\Csv\Exception\Reader;

use Exception;
use RuntimeException;
use Popy\Csv\Reader;
use Popy\Csv\Exception\ReaderException;

/**
 * Read operation exception raised by Popy\Csv\Reader\NamedColumn.
 */
class WrongColumnCountException extends RuntimeException implements ReaderException
{
    /**
     * Csv reader triggering the exception.
     *
     * @var Reader
     */
    protected $reader;

    /**
     * Csv headers.
     *
     * @var array
     */
    protected $headers;

    /**
     * Csv row.
     *
     * @var array
     */
    protected $row;

    /**
     * Exception constructor.
     *
     * @param Reader         $reader   Csv reader triggering the exception
     * @param array          $headers  Csv headers
     * @param array          $row      Csv row
     * @param integer        $code     Exception code
     * @param Exception|null $previous Previous exception
     */
    public function __construct(Reader $reader, array $headers, array $row, $code = 0, Exception $previous = null)
    {
        $this->reader = $reader;
        $this->headers = $headers;
        $this->row = $row;

        parent::__construct(
            sprintf(
                'CSV : Wrong column count ! Expected : %s, found : %s (row : %s) at line %s',
                count($headers),
                count($row),
                json_encode($row),
                $reader->key()
            ),
            $code,
            $previous
        );
    }

    /**
     * Get reader.
     *
     * @return Reader
     */
    public function getReader()
    {
        return $this->reader;
    }

    /**
     * Get headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Get row.
     *
     * @return array
     */
    public function getRow()
    {
        return $this->row;
    }
}
