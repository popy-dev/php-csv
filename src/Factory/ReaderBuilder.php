<?php

namespace Popy\Csv\Factory;

use Popy\Csv\Reader;
use Popy\Csv\Factory\ReaderFactory;

/**
 * Provides a chainable access to the factory methods
 */
class ReaderBuilder
{

    /**
     * Factory
     * 
     * @var ReaderFactory
     */
    protected $factory;

    /**
     * Reader
     * 
     * @var Reader
     */
    protected $reader;

    /**
     * Class constructor
     * 
     * @param Factory $factory Related factory
     * @param Reader  $reader  Initially wrapped reader
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Instanciate a Csv Reader froma  file
     * @see ReaderFactory::fromFile
     * 
     * @param  string|SplFileInfo $input Input file
     * 
     * @return self
     */
    public function fromFile($input)
    {
        $this->reader = $this->factory->fromFile($input);

        return $this;
    }
    
    /**
     * Builds a Reader from a string (CSV content)
     * @see ReaderFactory::fromString
     * 
     * @param  scalar $input Input string
     *
     * @return self
     */
    public function fromString($input)
    {
        $this->reader = $this->factory->fromString($input);

        return $this;
    }
    
    /**
     * Builds a Reader from a stream
     * @see ReaderFactory::fromStream
     * 
     * @param  resource $input Input stream
     *
     * @throws FactoryInvalidArgumentException If input is not a valid parameter
     * @return self
     */
    public function fromStream($input)
    {
        $this->reader = $this->factory->fromStream($input);

        return $this;
    }

    /**
     * Wraps the reader into a charset converter reader
     * @see ReaderFactory::charsetConvert
     * 
     * @param  string $from   Original charset
     * @param  string $to     Destination charset
     * 
     * @return self
     */
    public function charsetConvert($from, $to)
    {
        $this->reader = $this->factory->charsetConvert($this->reader, $from, $to);

        return $this;
    }
    
    /**
     * Wraps the reader into a fixed naming reader
     * @see ReaderFactory::nameColumns
     * 
     * @param  array  $columns column names array
     * 
     * @return self
     */
    public function nameColumns(array $columns)
    {
        $this->reader = $this->factory->nameColumns($this->reader, $columns);

        return $this;
    }
    
    /**
     * Wraps the reader into an automatic column naming reader
     * @see ReaderFactory::autoNameColumns
     * 
     * @return self
     */
    public function autoNameColumns()
    {
        $this->reader = $this->factory->autoNameColumns($this->reader);

        return $this;
    }

    /**
     * Returns the final reader
     * 
     * @return Reader
     */
    public function build()
    {
        return $this->reader;
    }
}