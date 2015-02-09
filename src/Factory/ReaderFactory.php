<?php

namespace Popy\Csv\Factory;

use SplFileInfo;
use Popy\Csv\Reader;
use Popy\Csv\Exception\FactoryException;
use Popy\Csv\Exception\FactoryInvalidArgumentException;
use Popy\Csv\Reader\SplFileInfoReader;
use Popy\Csv\Reader\StreamReader;
use Popy\Csv\Reader\StringReader;
use Popy\Csv\Reader\CharsetConverterReader;
use Popy\Csv\Reader\AutoNamedColumnReader;
use Popy\Csv\Reader\NamedColumnReader;

/**
 * Reader factory
 */
class ReaderFactory {
    /**
     * Builds a workbench instance
     * 
     * @return ReaderBuilder
     */
    public function build()
    {
        return new ReaderBuilder($this);
    }

    /**
     * Builds a Reader from a file path / SplFileInfo
     * 
     * @param  string|SplFileInfo $input Input file
     *
     * @throws FactoryInvalidArgumentException If input is not a valid parameter
     * @return Reader
     */
    public function fromFile($input)
    {
        if (is_string($input))  {
            $input = new SplFileInfo($input);
        }

        if (! $input instanceof SplFileInfo) {
            throw new FactoryInvalidArgumentException('$input', 'string|SplFileInfo', $input);
        }

        return new SplFileInfoReader($input);
    }

    /**
     * Builds a Reader from a string (CSV content)
     * 
     * @param  scalar $input Input string
     *
     * @throws FactoryInvalidArgumentException If input is not a valid parameter
     * @return Reader
     */
    public function fromString($input)
    {
        if (!is_string($input)) {
            throw new FactoryInvalidArgumentException('$input', 'string', $input);
        }

        return new StringReader($input);
    }

    /**
     * Builds a Reader from a stream
     * 
     * @param  resource $input Input stream
     *
     * @throws FactoryInvalidArgumentException If input is not a valid parameter
     * @return Reader
     */
    public function fromStream($input)
    {
        if (!is_resource($input)) {
            throw new FactoryInvalidArgumentException('$input', 'resource', $input);
        }

        return new StreamReader($input);
    }

    /**
     * Wraps a reader into a charset converter reader
     * 
     * @param  Reader $reader Original reader
     * @param  string $from   Original charset
     * @param  string $to     Destination charset
     * 
     * @return Reader
     */
    public function charsetConvert(Reader $reader, $from, $to)
    {
        return new CharsetConverterReader($reader, $from, $to);
    }

    /**
     * Wraps a reader into a fixed naming reader
     * 
     * @param  Reader $reader  Original reader
     * @param  array  $columns column names array
     * 
     * @return Reader
     */
    public function nameColumns(Reader $reader, array $columns)
    {
        return new NamedColumnReader($reader, $columns);
    }

    /**
     * Wraps a reader into an automatic column naming reader
     * 
     * @param  Reader $reader Original reader
     * 
     * @return Reader
     */
    public function autoNameColumns(Reader $reader)
    {
        return new AutoNamedColumnReader($reader);
    }
}