<?php

namespace Popy\Csv;

/**
 * CSV Base/abstract interface
 */
interface Csv {
    /**
     * Set CSV options
     * 
     * @param Options $options CSV option container
     *
     * @return self
     */
    public function setOptions(Options $options);

    /**
     * Get CSV Options
     * 
     * @return Options CSV option container
     */
    public function getOptions();
}