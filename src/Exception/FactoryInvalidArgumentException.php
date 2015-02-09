<?php

namespace Popy\Csv\Exception;

use InvalidArgumentException, Exception;

class FactoryInvalidArgumentException extends InvalidArgumentException implements FactoryException
{
    /**
     * Parameter name
     * 
     * @var string
     */
    protected $name;

    /**
     * Expected parameter type
     * 
     * @var string
     */
    protected $expected;

    /**
     * Received parameter
     * 
     * @var mixed
     */
    protected $received;

    /**
     * Class constructor
     *
     * @param string         $name     Parameter name
     * @param string         $expected Expected parameter type
     * @param mixed          $received Received parameter
     * @param integer        $code     Exception code
     * @param Exception|null $previous Previous exception
     */
    public function __construct($name, $expected, $received, $code = 0, Exception $previous = null)
    {
        $this->name     = $name;
        $this->expected = $expected;
        $this->received = $received;

        parent::__construct(
            sprintf(
                'Invalid argument received. Expected "%s", received "%s"',
                $expected,
                is_object($received) ? get_class($received) : gettype($received)
            ),
            $code,
            $previous
        );
    }

    /**
     * Get parameter name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get expected parameter type
     * 
     * @return string
     */
    public function getExpected()
    {
        return $this->expected;
    }

    /**
     * Get received parameter
     * 
     * @return mixed
     */
    public function getReceived()
    {
        return $this->received;
    }

}