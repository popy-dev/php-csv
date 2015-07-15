<?php

namespace Popy\Csv;

use Popy\Csv\Exception\DataReadException;

/**
 * Data Reader interface.
 */
interface DataReader
{
    /**
     * Reads the given number of bytes from the stream.
     *
     * @param integer $length Byte count
     *
     * @throws DataReadException If an error occurs
     *
     * @return string
     */
    public function read($length = null);

    /**
     * Gets a line from the file which is in CSV format and returns an array containing the fields read.
     *
     * @throws DataReadException If an error occurs
     *
     * @return array
     */
    public function getcsv($delimiter = ',', $enclosure = '"', $escape = '\\');

    /**
     * Determine whether the end of file has been reached.
     *
     * @throws DataReadException If an error occurs
     *
     * @return boolean
     */
    public function eof();

    /**
     * Determine if the Reader is seekable (move reading cursor to a specified byte index).
     *
     * @throws DataReadException If an error occurs
     *
     * @return boolean
     */
    public function isSeekable();

    /**
     * Seek to a position in the file measured in bytes from the beginning of the file, obtained by
     *     adding offset to the position specified by whence.
     *
     * @throws DataReadException If an error occurs
     */
    public function seek($offset, $whence = SEEK_SET);
}
