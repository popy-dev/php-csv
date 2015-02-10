<?php

namespace Popy\Csv\Writer;

use Popy\Csv\WritableWriter;

/**
 * Wraps a WritableWriter in order to enforce UTF8 charset usage by prepending a BOM
 */
class Utf8EnforcerWriter extends AbstractWriterWrapper implements WritableWriter
{
    const UTF8_BOM = "\xEF\xBB\xBF";

    /**
     * True if the BOM has been writted
     * 
     * @var boolean
     */
    protected $prepended = false;

    /**
     * Class constructor
     * 
     * @param WritableWriter $writer The wrapped writer
     */
    public function __construct(WritableWriter $writer)
    {
        $this->internal = $writer;
    }

    /**
     * {@inheritDoc}
     */
    public function appendRow($row)
    {
        $this->writeBomIfNeeded();
        $this->internal->appendRow($row);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function write($data)
    {
        $this->writeBomIfNeeded();
        $this->internal->write($data);

        return $this;
    }

    /**
     * Will write BOM into the wrapped writer on first call
     */
    protected function writeBomIfNeeded()
    {
        if (!$this->prepended) {
            $this->prepended = true;
            $this->internal->write(static::UTF8_BOM);
        }
    }
}