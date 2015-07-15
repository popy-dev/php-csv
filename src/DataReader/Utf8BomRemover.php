<?php

namespace Popy\Csv\Reader;

use Popy\Csv\DataReader;

/**
 * Utf8 BOM remover.
 */
class Utf8BomRemover implements DataReader
{
    const UTF8_BOM = "\xEF\xBB\xBF";

    /**
     * internal Data reader.
     *
     * @var DataReader
     */
    protected $internal;

    /**
     * Class constructor.
     *
     * @param DataReader $reader Wrapped Data reader
     */
    public function __construct(DataReader $reader)
    {
        $this->internal = $reader;
    }

    /**
     * {@inheritDoc}
     */
    public function read($length = null)
    {
        $res = $this->internal->read($length);

        if (substr($res, 0, 3) === static::UTF8_BOM) {
            $res = substr($res, 3);
        }

        return $res;
    }

    /**
     * {@inheritDoc}
     */
    public function getcsv($delimiter = ',', $enclosure = '"', $escape = '\\')
    {
        return $this->internal->getcsv($delimiter, $enclosure, $escape);
    }

    /**
     * {@inheritDoc}
     */
    public function eof()
    {
        return $this->internal->eof();
    }

    /**
     * {@inheritDoc}
     */
    public function isSeekable()
    {
        return $this->internal->isSeekable();
    }

    /**
     * {@inheritDoc}
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        $this->internal->seek($offset, $whence);
    }
}
