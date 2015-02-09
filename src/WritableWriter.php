<?php

namespace Popy\Csv;

/**
 * Writable writer
 */
interface WritableWriter extends Writer {
    /**
     * Writes raw data into the CSV stream/whatever
     * 
     * @param  string $data Raw data
     * 
     * @return self
     */
    public function write($data);
}