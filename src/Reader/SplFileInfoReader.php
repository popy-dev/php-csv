<?php

namespace Popy\Csv\Reader;

use SeekableIterator;
use RuntimeException;
use SplFileInfo, SplFileObject;
use Popy\Csv\Exception\SplFileObjectRewindException;

/**
 * SplFileInfo CSV Reader (wraps a SplFileInfo instance)
 */
class SplFileInfoReader extends AbstractIteratorWrapper implements SeekableIterator
{
    /**
     * Class constructor
     * 
     * @param SplFileInfo $file The file to read
     */
    public function __construct(SplFileInfo $file)
    {
        $this->internal = $file;

        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->initializeInternalFileObject();

        try {
            parent::rewind();
        } catch (RuntimeException $e) {
            throw new SplFileObjectRewindException($this, 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function seek($position)
    {
        return parent::seek($position);
    }

    /**
     * Initialization of internal file object
     */
    protected function initializeInternalFileObject()
    {
        // Open file if needed
        if (! $this->internal instanceof SplFileObject) {
            $this->internal = $this->internal->openFile();
        }

        // Set options
        $this->internal->setCsvControl(
            $this->options->getDelimiter(),
            $this->options->getEnclosure(),
            $this->options->getEscape()
        );

        $this->internal->setFlags(
            SplFileObject::DROP_NEW_LINE | SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY    | SplFileObject::READ_CSV
        );
    }
}

