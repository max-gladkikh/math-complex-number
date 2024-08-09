<?php

namespace ComplexMath\Tests;

use ComplexMath\ComplexNumberCalculator;
use PHPUnit\Framework\TestCase;
use ComplexMath\ComplexNumber;

final class ComplexNumber_multiplication_Test extends TestCase
{
    /**
     * @dataProvider getComplexNumbersParams
     *
     * @param array $firstComplexNumberParams
     * @param array $secondComplexNumberParams
     * @param int $calculatingScale
     * @param array $expectedResFirstMulSecond
     * @return void
     */
    public function testMulComplexNumbers(
        array $firstComplexNumberParams,
        array $secondComplexNumberParams,
        int $calculatingScale,
        array $expectedResFirstMulSecond
    ) {
        $complexNumberCalculator = new ComplexNumberCalculator();
        $firstComplexNumber = new ComplexNumber($firstComplexNumberParams['real'], $firstComplexNumberParams['imaginary']);
        $secondComplexNumber = new ComplexNumber($secondComplexNumberParams['real'], $secondComplexNumberParams['imaginary']);

        $resFirstMulSecond = $complexNumberCalculator->mul(
            $firstComplexNumber,
            $secondComplexNumber,
            $calculatingScale
        );
        $resSecondMulFirst = $complexNumberCalculator->mul(
            $secondComplexNumber,
            $firstComplexNumber,
            $calculatingScale
        );

        // проверка что получили то, что ожидали
        $this->assertEquals($expectedResFirstMulSecond['real'], $resFirstMulSecond->getReal());
        $this->assertEquals($expectedResFirstMulSecond['imaginary'], $resFirstMulSecond->getImaginary());

        // проверка коммутативности
        $this->assertEquals($resSecondMulFirst->getReal(), $resFirstMulSecond->getReal());
        $this->assertEquals($resSecondMulFirst->getImaginary(), $resFirstMulSecond->getImaginary());
    }

    public function getComplexNumbersParams()
    {
        return [
            [ // свойство нуля
                'firstComplexNumberParams' => ['real' => '0', 'imaginary' => '0'],
                'secondComplexNumberParams' => ['real' => '3', 'imaginary' => '4'],
                'calculatingScale' => 2,
                'expectedResFirstMulSecond' => ['real' => '0.00', 'imaginary' => '0.00'],
            ],
            [
                'firstComplexNumberParams' => ['real' => '1', 'imaginary' => '2'],
                'secondComplexNumberParams' => ['real' => '3', 'imaginary' => '4'],
                'calculatingScale' => 2,
                'expectedResFirstMulSecond' => ['real' => '-5.00', 'imaginary' => '10.00'],
            ],
            [
                'firstComplexNumberParams' => ['real' => '5.555', 'imaginary' => '6.666'],
                'secondComplexNumberParams' => ['real' => '7.777', 'imaginary' => '8.888'],
                'calculatingScale' => 2,
                'expectedResFirstMulSecond' => ['real' => '-16.04', 'imaginary' => '101.21'],
            ],
            [
                'firstComplexNumberParams' => ['real' => '5.555', 'imaginary' => '6.666'],
                'secondComplexNumberParams' => ['real' => '7.777', 'imaginary' => '8.888'],
                'calculatingScale' => 3,
                'expectedResFirstMulSecond' => ['real' => '-16.046', 'imaginary' => '101.213'],
            ],
        ];
    }
}
