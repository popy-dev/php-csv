<?php

namespace Popy\Csv\Reader;

use Popy\Csv\Reader;

/**
 * CharsetConverterReader : wraps a Csv reader in order ton convert the readed charset into another
 */
class CharsetConverterReader extends AbstractReaderWrapper
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
    public function __construct(Reader $reader, $from, $to = 'utf-8')
    {
        $this->internal = $reader;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        $row = $this->internal->current();

        if ($this->from !== $this->to) {
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

        return $row;
    }
}

