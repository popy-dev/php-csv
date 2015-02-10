<?php

namespace Popy\Csv\Writer;

use Popy\Csv\WritableWriter;

/**
 * StreamWriter
 */
class StreamWriter extends AbstractWriter implements WritableWriter
{
    /**
     * Output stream
     * 
     * @var resource
     */
    protected $stream;

    /**
     * Class constructor
     * 
     * @param resource $stream Output stream/handle
     */
    public function __construct($stream)
    {
        $this->stream = $stream;
        parent::__construct();
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->stream = null;
        parent::__destruct();
    }

    /**
     * {@inheritDoc}
     */
    public function doAppendRow(array $row)
    {
        $res = fputcsv(
            $this->stream,
            $row,
            $this->options->getDelimiter(),
            $this->options->getEnclosure()
        );

        if ($res === false) {
            throw new StreamWriteException($this, error_get_last());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function write($data)
    {
        $res = fwrite($this->stream, $data);

        if ($res === false) {
            throw new StreamWriteException($this, error_get_last());
        }

        return $this;
    }
}