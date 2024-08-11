<?php

/*
 * Класс объект-значение комплексного числа.
 *
 * (c) Gladkikh Maksim <max.gdkh@gmail.com>
 * 
 */

namespace ComplexMath;

class ComplexNumber
{
    private $real;
    private $imaginary;
    
    /**
     * Комплексное число
     * 
     * @param string $real      - вещественная часть числа
     * @param string $imaginary - мнимая часть числа
     */
    public function __construct($real, $imaginary)
    {
        $this->real = $real;
        $this->imaginary = $imaginary;
    }

    /**
     * Метод возвращает вещественную часть числа
     *
     * @return string
     */
    public function getReal()
    {
        return $this->real;
    }

    /**
     * Метод возвращает мнимую часть числа
     *
     * @return string
     */
    public function getImaginary()
    {
        return $this->imaginary;
    }
}
