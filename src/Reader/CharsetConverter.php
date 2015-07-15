<?php

namespace Popy\Csv\Reader;

use Iterator;

/**
 * CharsetConverter Reader : wraps a Csv reader in order ton convert the readed charset into another.
 */
class CharsetConverter extends AbstractIteratorWrapper
{
    /**
     * Input reader/file charset.
     *
     * @var string
     */
    protected $from;

    /**
     * Output charset.
     *
     * @var string
     */
    protected $to;

    /**
     * Class constructor.
     *
     * @param Iterator $internal Internal iterator
     * @param string   $from     Input charset
     * @param string   $to       Output charset
     */
    public function __construct(Iterator $internal, $from, $to = 'utf-8')
    {
        $this->internal = $internal;
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
