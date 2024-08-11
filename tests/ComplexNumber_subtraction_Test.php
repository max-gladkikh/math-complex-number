<?php

namespace ComplexMath\Tests;

use ComplexMath\ComplexNumberCalculator;
use PHPUnit\Framework\TestCase;
use ComplexMath\ComplexNumber;

final class ComplexNumber_subtraction_Test extends TestCase
{
    /**
     * @dataProvider getComplexNumbersParams
     *
     * @param array $firstComplexNumberParams
     * @param array $secondComplexNumberParams
     * @param int $calculatingScale
     * @param array $expectedResFirstSubSecond
     * @param array $expectedResSecondSubFirst
     * @return void
     */
    public function testSubComplexNumbers(
        array $firstComplexNumberParams,
        array $secondComplexNumberParams,
        $calculatingScale,
        array $expectedResFirstSubSecond,
        array $expectedResSecondSubFirst
    ) {
        $complexNumberCalculator = new ComplexNumberCalculator();
        $firstComplexNumber = new ComplexNumber($firstComplexNumberParams['real'], $firstComplexNumberParams['imaginary']);
        $secondComplexNumber = new ComplexNumber($secondComplexNumberParams['real'], $secondComplexNumberParams['imaginary']);

        $resFirstSubSecond = $complexNumberCalculator->sub(
            $firstComplexNumber,
            $secondComplexNumber,
            $calculatingScale
        );
        $resSecondSubFirst = $complexNumberCalculator->sub(
            $secondComplexNumber,
            $firstComplexNumber,
            $calculatingScale
        );

        // проверка что получили то, что ожидали
        $this->assertEquals($expectedResFirstSubSecond['real'], $resFirstSubSecond->getReal());
        $this->assertEquals($expectedResFirstSubSecond['imaginary'], $resFirstSubSecond->getImaginary());
        $this->assertEquals($expectedResSecondSubFirst['real'], $resSecondSubFirst->getReal());
        $this->assertEquals($expectedResSecondSubFirst['imaginary'], $resSecondSubFirst->getImaginary());
    }

    /**
     * It's dataProvider
     *
     * @return array[]
     */
    public function getComplexNumbersParams()
    {
        return [
            [
                'firstComplexNumberParams' => ['real' => '0', 'imaginary' => '0'],
                'secondComplexNumberParams' => ['real' => '3', 'imaginary' => '4'],
                'calculatingScale' => 2,
                'expectedResFirstSubSecond' => ['real' => '-3.00', 'imaginary' => '-4.00'],
                'expectedResSecondSubFirst' => ['real' => '3.00', 'imaginary' => '4.00'],
            ],
            [
                'firstComplexNumberParams' => ['real' => '1', 'imaginary' => '2'],
                'secondComplexNumberParams' => ['real' => '3', 'imaginary' => '4'],
                'calculatingScale' => 2,
                'expectedResFirstSubSecond' => ['real' => '-2.00', 'imaginary' => '-2.00'],
                'expectedResSecondSubFirst' => ['real' => '2.00', 'imaginary' => '2.00'],
            ],
            [
                'firstComplexNumberParams' => ['real' => '5.555', 'imaginary' => '6.666'],
                'secondComplexNumberParams' => ['real' => '7.777', 'imaginary' => '8.888'],
                'calculatingScale' => 2,
                'expectedResFirstSubSecond' => ['real' => '-2.22', 'imaginary' => '-2.22'],
                'expectedResSecondSubFirst' => ['real' => '2.22', 'imaginary' => '2.22'],
            ],
            [
                'firstComplexNumberParams' => ['real' => '5.555', 'imaginary' => '6.666'],
                'secondComplexNumberParams' => ['real' => '7.777', 'imaginary' => '8.888'],
                'calculatingScale' => 3,
                'expectedResFirstSubSecond' => ['real' => '-2.222', 'imaginary' => '-2.222'],
                'expectedResSecondSubFirst' => ['real' => '2.222', 'imaginary' => '2.222'],
            ],
        ];
    }
}
