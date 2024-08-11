<?php

/*
 * Класс сервис для операций с комплексными числами.
 *
 * (c) Gladkikh Maksim <max.gdkh@gmail.com>
 * 
 */

namespace ComplexMath;

use ComplexMath\Exception\DivisionByZeroException;

class ComplexNumberCalculator
{

    /**
     * Сложение комплексных чисел
     *
     * @param ComplexNumber $first
     * @param ComplexNumber $second
     * @param int $scale
     * @return ComplexNumber
     */
    public function add(ComplexNumber $first, ComplexNumber $second, $scale = 2)
    {
        return new ComplexNumber(
            bcadd($first->getReal(), $second->getReal(), $scale),
            bcadd($first->getImaginary(), $second->getImaginary(), $scale)
        );
    }

    /**
     * Вычитание комплексных чисел
     *
     * @param ComplexNumber $first
     * @param ComplexNumber $second
     * @param int $scale
     * @return ComplexNumber
     */
    public function sub(ComplexNumber $first, ComplexNumber $second, $scale = 2)
    {
        return new ComplexNumber(
            bcsub($first->getReal(), $second->getReal(), $scale),
            bcsub($first->getImaginary(), $second->getImaginary(), $scale)
        );
    }

    /**
     * Умножение комплексных чисел
     *
     * (a + bi) * (c + di)
     *
     * Раскрываем скобки, i^2 заменяем на -1
     * (a + bi) * (c + di) = ac + adi + bci + bd(i^2) =
     * = ac - bd + (ad + bc)i
     *
     * @param ComplexNumber $first
     * @param ComplexNumber $second
     * @param int $scale
     * @return ComplexNumber
     */
    public function mul(ComplexNumber $first, ComplexNumber $second, $scale = 2)
    {
        list($ac, $bd, $ad, $bc) = $this->getComplexNumberParams($first, $second, $scale);
        
        // $real это 'ac - bd'
        $real = bcsub($ac, $bd, $scale);
        // $imaginary это 'ad + bc'
        $imaginary = bcadd($ad, $bc, $scale);
        
        return new ComplexNumber($real, $imaginary);
    }

    /**
     * Деление комплексных чисел
     *
     * (a + bi) / (c + di)
     *
     * Умножаем числитель и знаменатель на сопряженное знаменателю выражение,
     * раскрываем скобки, i^2 заменяем на -1
     * (a + bi) / (c + di) = (a + bi) * (c - di) / (c + di) * (c - di) =
     * = (ac - adi + bci - bd(i^2))/(c^2 + d^2) =
     * = (ac - adi + bci + bd)/(c^2 + d^2) =
     * = ((ac + bd) + (bci - adi)) / (c^2 + d^2) =
     * = (ac + bd)/(c^2 + d^2) + ((bc - ad)/(c^2 + d^2)) * i
     *
     * @param ComplexNumber $first
     * @param ComplexNumber $second
     * @param int $scale
     * @return ComplexNumber
     * @throws DivisionByZeroException
     */
    public function div(ComplexNumber $first, ComplexNumber $second, $scale = 2)
    {
        if ((float)$second->getReal() === 0.00 && (float)$second->getImaginary() === 0.00) {
            throw new DivisionByZeroException();
        }

        list($ac, $bd, $ad, $bc) = $this->getComplexNumberParams($first, $second, $scale);

        //(ac + bd)
        $acADDbd = bcadd($ac, $bd, $scale);
        //(bc - ad)
        $bcSUBad = bcsub($bc, $ad, $scale);
        
        $c2 = bcmul($second->getReal(), $second->getReal(), $scale);
        $d2 = bcmul($second->getImaginary(), $second->getImaginary(), $scale);
        //(c^2 + d^2)
        $c2ADDd2 = bcadd($c2, $d2, $scale);

        //$real это (ac + bd)/(c^2 + d^2)
        $real = bcdiv($acADDbd, $c2ADDd2, $scale);
        //$imaginary это (bc - ad)/(c^2 + d^2)
        $imaginary = bcdiv($bcSUBad, $c2ADDd2, $scale);
        return new ComplexNumber($real, $imaginary);
    }

    /**
     * Возвращает перемноженные вещественные и мнимые части,
     * переданных комплексных чисел
     * ac, bd, ad, bc
     *
     * @param ComplexNumber $first
     * @param ComplexNumber $second
     * @param int $scale
     * @return array
     */
    private function getComplexNumberParams(ComplexNumber $first, ComplexNumber $second, $scale = 2)
    {
        $ac = bcmul($first->getReal(), $second->getReal(), $scale);
        $bd = bcmul($first->getImaginary(), $second->getImaginary(), $scale);
        $ad = bcmul($first->getReal(), $second->getImaginary(), $scale);
        $bc = bcmul($first->getImaginary(), $second->getReal(), $scale);
        
        return [$ac, $bd, $ad, $bc];
    }
}
