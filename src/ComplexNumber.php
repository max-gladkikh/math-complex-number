<?php

namespace ComplexMath;

/**
 * Объект-значение комплексного числа.
 */
class ComplexNumber
{
    private $real;
    private $imaginary;
    
    /**
     * @param string $real      - вещественная часть числа
     * @param string $imaginary - мнимая часть числа
     */
    public function __construct(string $real, string $imaginary)
    {
        $this->real = $real;
        $this->imaginary = $imaginary;
    }

    /**
     * Метод возвращает вещественную часть числа
     *
     * @return string
     */
    public function getReal():string
    {
        return $this->real;
    }

    /**
     * Метод возвращает мнимую часть числа
     *
     * @return string
     */
    public function getImaginary():string
    {
        return $this->imaginary;
    }

    public function __toString():string
    {
        $sign = strpos($this->getImaginary(),'-') !== false ? '' : '+';
        return sprintf('%s%s%si', $this->getReal(), $sign, $this->getImaginary());
    }
}
