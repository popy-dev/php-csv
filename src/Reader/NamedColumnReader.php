<?php

namespace Popy\Csv\Reader;

use Popy\Csv\Reader;
use Popy\Csv\Options;
use Popy\Csv\Exception\WrongColumnCountException;

/**
 * "Named column" reader : wraps a Reader and name the resulting rows
 */
class NamedColumnReader extends AbstractReaderWrapper implements Reader {
    /**
     * Column headers
     * 
     * @var array
     */
    protected $headers;

    /**
     * Class constructor
     * 
     * @param Reader $reader  Wrapped CSV reader
     * @param array  $headers Column headers
     */
    public function __construct(Reader $reader, array $headers)
    {
        $this->internal = $reader;
        $this->headers = $headers;
    }

    /**
     * Class destructor
     */
    public function __destruct()
    {
        $this->internal = null;
        $this->headers = null;
    }

    /**
     * Get headers
     * 
     * @return array<string>
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        $row = $this->internal->current();

        if (count($this->headers) != count($row)) {
            throw new WrongColumnCountException($this, $this->headers, $row);
        }

        return array_combine($this->headers, $row);
    }
}

