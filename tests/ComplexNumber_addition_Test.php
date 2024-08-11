<?php

namespace ComplexMath\Tests;

use ComplexMath\ComplexNumberCalculator;
use PHPUnit\Framework\TestCase;
use ComplexMath\ComplexNumber;

final class ComplexNumber_addition_Test extends TestCase
{
    /**
     * @dataProvider getComplexNumbersParams
     *
     * @param array $firstComplexNumberParams
     * @param array $secondComplexNumberParams
     * @param int $calculatingScale
     * @param array $expectedResFirstAddSecond
     * @return void
     */
    public function testAddComplexNumbers(
        array $firstComplexNumberParams,
        array $secondComplexNumberParams,
        $calculatingScale,
        array $expectedResFirstAddSecond
    ) {
        $complexNumberCalculator = new ComplexNumberCalculator();
        $firstComplexNumber = new ComplexNumber($firstComplexNumberParams['real'], $firstComplexNumberParams['imaginary']);
        $secondComplexNumber = new ComplexNumber($secondComplexNumberParams['real'], $secondComplexNumberParams['imaginary']);

        $resFirstAddSecond = $complexNumberCalculator->add(
            $firstComplexNumber,
            $secondComplexNumber,
            $calculatingScale
        );
        $resSecondAddFirst = $complexNumberCalculator->add(
            $firstComplexNumber,
            $secondComplexNumber,
            $calculatingScale
        );

        // проверка что получили то, что ожидали
        $this->assertEquals($expectedResFirstAddSecond['real'], $resFirstAddSecond->getReal());
        $this->assertEquals($expectedResFirstAddSecond['imaginary'], $resFirstAddSecond->getImaginary());

        // проверка коммутативности
        $this->assertEquals($resSecondAddFirst->getReal(), $resFirstAddSecond->getReal());
        $this->assertEquals($resSecondAddFirst->getImaginary(), $resFirstAddSecond->getImaginary());
    }

    /**
     * It's dataProvider
     * @return array[]
     */
    public function getComplexNumbersParams()
    {
        return [
            [   // свойство нуля
                'firstComplexNumberParams' => ['real' => '0', 'imaginary' => '0'],
                'secondComplexNumberParams' => ['real' => '3', 'imaginary' => '4'],
                'calculatingScale' => 2,
                'expectedResFirstAddSecond' => ['real' => '3.00', 'imaginary' => '4.00'],
            ],
            [
                'firstComplexNumberParams' => ['real' => '1', 'imaginary' => '2'],
                'secondComplexNumberParams' => ['real' => '3', 'imaginary' => '4'],
                'calculatingScale' => 2,
                'expectedResFirstAddSecond' => ['real' => '4.00', 'imaginary' => '6.00'],
            ],
            [
                'firstComplexNumberParams' => ['real' => '5.555', 'imaginary' => '6.666'],
                'secondComplexNumberParams' => ['real' => '7.777', 'imaginary' => '8.888'],
                'calculatingScale' => 2,
                'expectedResFirstAddSecond' => ['real' => '13.33', 'imaginary' => '15.55'],
            ],
            [
                'firstComplexNumberParams' => ['real' => '5.555', 'imaginary' => '6.666'],
                'secondComplexNumberParams' => ['real' => '7.777', 'imaginary' => '8.888'],
                'calculatingScale' => 3,
                'expectedResFirstAddSecond' => ['real' => '13.332', 'imaginary' => '15.554'],
            ],
        ];
    }
}
