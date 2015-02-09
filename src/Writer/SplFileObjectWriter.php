<?php

namespace Popy\Csv\Writer;

use SplFileObject;
use Popy\Csv\WritableWriter;

/**
 * SplFileObjectWriter
 */
class SplFileObjectWriter extends AbstractWriter implements WritableWriter {
    /**
     * Output stream
     * 
     * @var SplFileObject
     */
    protected $internal;

    /**
     * Class constructor
     * 
     * @param SplFileObject $file Output file
     */
    public function __construct($internal)
    {
        $this->internal = $internal;
        parent::__construct();
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->internal = null;
        parent::__destruct();
    }

    /**
     * {@inheritDoc}
     */
    public function doAppendRow(array $row)
    {
        $res = $this->internal->fputcsv(
            $row,
            $this->options->getDelimiter(),
            $this->options->getEnclosure()
        );

        if ($res === false) {
            throw new ReadStreamException($this, error_get_last());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function write($data)
    {
        $res = $this->internal->fwrite($data);

        if ($res === false || $res === null) {
            throw new ReadStreamException($this, error_get_last());
        }

        return $this;
    }
}