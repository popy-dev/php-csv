<?php

namespace Popy\Csv\Reader;

use Iterator;
use Popy\Csv\Exception\Reader\WrongColumnCountException;

/**
 * "Named column" Reader : will re-index CSV columns on a specified set of keys.
 */
class NamedColumn extends AbstractIteratorWrapper
{
    /**
     * Column headers.
     *
     * @var array
     */
    protected $headers;

    /**
     * Class constructor.
     *
     * @param Iterator $internal Internal iterator
     * @param array    $headers  Column headers
     */
    public function __construct(Iterator $internal, array $headers)
    {
        $this->internal = $internal;
        $this->headers = $headers;
    }

    /**
     * Get headers.
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
