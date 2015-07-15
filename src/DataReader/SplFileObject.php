<?php

namespace Popy\Csv\DataReader;

use SplFileObject as FileObject;
use Popy\Csv\DataReader;
use Popy\Csv\Exception\DataReader\SplFileObjectException;

/**
 * SplFileObject DataReader.
 */
class SplFileObject implements DataReader
{
    /**
     * Read file.
     *
     * @var FileObject
     */
    protected $file;

    /**
     * Class constructor.
     *
     * @param FileObject $file File to read
     */
    public function __construct(FileObject $file)
    {
        $this->file = $file;
    }

    /**
     * {@inheritDoc}
     */
    public function read($length = null)
    {
        $res = $this->file->fread($length);

        if ($res === false) {
            throw new SplFileObjectException(error_get_last());
        }

        return $res;
    }

    /**
     * {@inheritDoc}
     */
    public function getcsv($delimiter = ',', $enclosure = '"', $escape = '\\')
    {
        $res = $this->file->fgetcsv($delimiter, $enclosure, $escape);

        if ($res === false) {
            throw new SplFileObjectException(error_get_last());
        }

        return $res;
    }

    /**
     * {@inheritDoc}
     */
    public function eof()
    {
        return $this->file->eof();
    }

    /**
     * {@inheritDoc}
     */
    public function isSeekable()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        if ($this->file->fseek($offset, $whence) === -1) {
            throw new SplFileObjectException(error_get_last());
        }
    }
}
