<?php

namespace Popy\Csv\Reader;

use Popy\Csv\Reader;

/**
 * Utf8 bom remover
 */
class Utf8BomRemoverReader extends AbstractReaderWrapper
{
    const UTF8_BOM = "\xEF\xBB\xBF";

    /**
     * Used to know if the first line has already been processed
     * 
     * @var boolean
     */
    protected $firstLinePassed;

    /**
     * Class constructor
     * 
     * @param Reader $reader Wrapped CSV reader
     */
    public function __construct(Reader $reader)
    {
        $this->internal = $reader;
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->firstLinePassed = false;
        return $this->internal->rewind();
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        $row = $this->internal->current();

        if (!$this->firstLinePassed) {
            $value = reset($row);

            if (substr($value, 0, 3) === static::UTF8_BOM) {
                $this->firstLinePassed = true;
                $value = substr($value, 3);
                $row[key($row)] = $value;
            }
        }

        return $row;
    }
}

