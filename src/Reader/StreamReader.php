<?php

namespace Popy\Csv\Reader;

use Popy\Csv\Exception\ReadException;
use Popy\Csv\Reader;
use Popy\Csv\AbstractCsv;
use Popy\Csv\Exception\ReadException;
use Popy\Csv\Exception\ReadStreamException;

/**
 * Reads a stream
 */
class StreamReader extends AbstractCsv implements Reader
{
    /**
     * Stream
     * 
     * @var resource
     */
    protected $stream;

    /**
     * internal row counter
     * 
     * @var integer
     */
    protected $key;

    /**
     * Current row
     * 
     * @var array|null
     */
    protected $current;

    /**
     * Class constructor
     * 
     * @param SplFileInfo $file The file to read
     */
    public function __construct($stream)
    {
        $this->stream = $stream;
        parent::__construct();
    }

    /**
     * Class destructor
     */
    public function __destruct()
    {
        $this->stream = null;
        parent::__destruct();
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $meta = stream_get_meta_data($stream);
        $this->current = null;
        $this->key = -1;

        if ($meta['seekable']) {
            if (fseek($this->stream, 0) === -1) {
                throw new StreamReadException($this, error_get_last());
            }
        }

        // Initialize first line
        $this->next();
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        $this->current = null;

        while (!feof($this->stream) && $this->current === null) {
            $this->current = fgetcsv(
                $this->stream,
                0,
                $this->options->getDelimiter(),
                $this->options->getEnclosure(),
                $this->options->getEscape()
            );

            if ($this->current === false || $this->current === null) {
                throw new StreamReadException($this, error_get_last());
            }

            if (count($this->current) === 1 && reset($this->current) === null) {
                $this->current = null;
            }
        }

        $this->key++;
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return $this->current !== null;
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        $row = $this->current;
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->key;
    }
}

