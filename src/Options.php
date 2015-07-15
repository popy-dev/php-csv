<?php

namespace Popy\Csv;

/**
 * CSV Options container.
 */
class Options
{
    /**
     * CSV delimiter control char.
     *
     * @var string
     */
    protected $delimiter = ',';

    /**
     * CSV enclosure control char.
     *
     * @var string
     */
    protected $enclosure = '"';

    /**
     * Set delimiter option value.
     *
     * @param string $delimiter delimiter option value
     *
     * @return self [description]
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    /**
     * Get delimiter option value.
     *
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * Set enclosure option value.
     *
     * @param string $enclosure enclosure option value
     *
     * @return self [description]
     */
    public function setEnclosure($enclosure)
    {
        $this->enclosure = $enclosure;

        return $this;
    }

    /**
     * Get enclosure option value.
     *
     * @return string
     */
    public function getEnclosure()
    {
        return $this->enclosure;
    }

    /**
     * Get escape option value
     * /!\ This method is here only to have consistency with php fgetcsv strange signature/behaviour
     *     The CSV RFC tells that there is no escape char, as the enclosure is meant to be escaped
     *     by itself. Moreover, the $escape parameter does not seems to be used at all by fputcsv,
     *     and is not correctly stripped by php when used.
     *
     * @return string
     */
    public function getEscape()
    {
        return $this->enclosure;
    }
}
