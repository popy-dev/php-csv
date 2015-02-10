<?php

namespace Popy\Csv\Writer;

use Traversable;
use Popy\Csv\Writer;

/**
 * Wraps a Writer in order to convert the data charset
 */
class CharsetConverterWriter extends AbstractWriterWrapper
{
    /**
     * Input reader/file charset
     * 
     * @var string
     */
    protected $from;

    /**
     * Output charset
     * 
     * @var string
     */
    protected $to;

    /**
     * Class constructor
     * 
     * @param Reader $reader Wrapper reader
     * @param string $from   Input charset
     * @param string $to     Output charset
     */
    public function __construct(Writer $writer, $from, $to = 'utf-8')
    {
        $this->internal = $writer;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * {@inheritDoc}
     */
    public function appendRow($row)
    {
        if ($row implements Traversable) {
            $row = iterator_to_array($row);
        }

        if ($this->from !== $this->to && is_array($row)) {
            if (function_exists('mb_convert_encoding')) {
                foreach ($row as $key => $value) {
                    $row[$key] = mb_convert_encoding($value, $this->to, $this->from);
                }
            } else {
                foreach ($row as $key => $value) {
                    $row[$key] = iconv($this->from, $this->to, $str);
                }
            }
        }

        $this->internal->appendRow($row);

        return $this;
    }

}