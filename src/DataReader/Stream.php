<?php

namespace Popy\Csv\DataReader;

use Popy\Csv\DataReader;
use Popy\Csv\Exception\DataReader\StreamException;

/**
 * Stream DataReader.
 */
class Stream implements DataReader
{
    /**
     * Stream.
     *
     * @var resource
     */
    protected $stream;

    /**
     * Stores the seekable attributes of the stream.
     *
     * @var boolean
     */
    protected $seekable;

    /**
     * Class constructor.
     *
     * @param resource $stream The stream to read
     */
    public function __construct($stream)
    {
        $this->stream = $stream;

        $meta = stream_get_meta_data($this->stream);

        $this->seekable = (bool) $meta['seekable'];
    }

    /**
     * {@inheritDoc}
     */
    public function read($length = null)
    {
        $res = fread($this->stream, $length);

        if ($res === false) {
            throw new StreamException(error_get_last());
        }

        return $res;
    }

    /**
     * {@inheritDoc}
     */
    public function getcsv($delimiter = ',', $enclosure = '"', $escape = '\\')
    {
        $res = fgetcsv($this->stream, 0, $delimiter, $enclosure, $escape);

        if ($res === false || $res === null) {
            throw new StreamException(error_get_last());
        }

        return $res;
    }

    /**
     * {@inheritDoc}
     */
    public function eof()
    {
        return feof($this->stream);
    }

    /**
     * {@inheritDoc}
     */
    public function isSeekable()
    {
        return $this->seekable;
    }

    /**
     * {@inheritDoc}
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        if (!$this->seekable) {
            throw new StreamException('This stream is not seekable.');
        }
        if (fseek($this->stream, $offset, $whence) === -1) {
            throw new StreamException(error_get_last());
        }
    }
}
