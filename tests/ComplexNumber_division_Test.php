<?php 
declare(strict_types=1);

namespace ComplexMath\Tests;

use ComplexMath\ComplexNumberCalculator;
use ComplexMath\Exception\DivisionByZeroException;
use PHPUnit\Framework\TestCase;
use ComplexMath\ComplexNumber;

final class ComplexNumber_division_Test extends TestCase
{

    /**
     * @dataProvider getComplexNumbersParams
     *
     * @param array $firstComplexNumberParams
     * @param array $secondComplexNumberParams
     * @param int $calculatingScale
     * @param array $expectedResFirstDivSecond
     * @param array $expectedResSecondDivFirst
     * @return void
     * @throws DivisionByZeroException
     */
    public function testDivComplexNumbers(
        array $firstComplexNumberParams,
        array $secondComplexNumberParams,
        int $calculatingScale,
        array $expectedResFirstDivSecond,
        array $expectedResSecondDivFirst
    ) {
        $complexNumberCalculator = new ComplexNumberCalculator();
        $firstComplexNumber = new ComplexNumber($firstComplexNumberParams['real'], $firstComplexNumberParams['imaginary']);
        $secondComplexNumber = new ComplexNumber($secondComplexNumberParams['real'], $secondComplexNumberParams['imaginary']);
        $resFirstDivSecond = $complexNumberCalculator->div(
            $firstComplexNumber,
            $secondComplexNumber,
            $calculatingScale
        );

        // проверка что получили то, что ожидали
        $this->assertEquals($expectedResFirstDivSecond['real'], $resFirstDivSecond->getReal());
        $this->assertEquals($expectedResFirstDivSecond['imaginary'], $resFirstDivSecond->getImaginary());

        // ловим исключение, если указано в dataProvider
        if (!empty($expectedResSecondDivFirst['exception'])) {
            $this->expectException($expectedResSecondDivFirst['exception']);
        }
        $resSecondDivFirst = $complexNumberCalculator->div(
            $secondComplexNumber,
            $firstComplexNumber,
            $calculatingScale
        );
        if (!isset($expectedResSecondDivFirst['exception'])) {
            $this->assertEquals($expectedResSecondDivFirst['real'], $resSecondDivFirst->getReal());
            $this->assertEquals($expectedResSecondDivFirst['imaginary'], $resSecondDivFirst->getImaginary());
        }
    }

    /**
     * It's dataProvider
     *
     * @return array[]
     */
    public function getComplexNumbersParams(): array
    {
        return [
            [
                'firstComplexNumberParams' => ['real' => '0', 'imaginary' => '0'],
                'secondComplexNumberParams' => ['real' => '3', 'imaginary' => '4'],
                'calculatingScale' => 2,
                'expectedResFirstDivSecond' => ['real' => '0.00', 'imaginary' => '0.00'],
                'expectedResSecondDivFirst' => ['exception' => DivisionByZeroException::class],
            ],
            [
                'firstComplexNumberParams' => ['real' => '1', 'imaginary' => '2'],
                'secondComplexNumberParams' => ['real' => '3', 'imaginary' => '4'],
                'calculatingScale' => 2,
                'expectedResFirstDivSecond' => ['real' => '0.44', 'imaginary' => '0.08'],
                'expectedResSecondDivFirst' => ['real' => '2.20', 'imaginary' => '-0.40'],
            ],
            [
                'firstComplexNumberParams' => ['real' => '5.555', 'imaginary' => '6.666'],
                'secondComplexNumberParams' => ['real' => '7.777', 'imaginary' => '8.888'],
                'calculatingScale' => 2,
                'expectedResFirstDivSecond' => ['real' => '0.73', 'imaginary' => '0.01'],
                'expectedResSecondDivFirst' => ['real' => '1.36', 'imaginary' => '-0.03'],
            ],
            [
                'firstComplexNumberParams' => ['real' => '5.555', 'imaginary' => '6.666'],
                'secondComplexNumberParams' => ['real' => '7.777', 'imaginary' => '8.888'],
                'calculatingScale' => 3,
                'expectedResFirstDivSecond' => ['real' => '0.734', 'imaginary' => '0.017'],
                'expectedResSecondDivFirst' => ['real' => '1.360', 'imaginary' => '-0.032'],
            ],
        ];
    }
}
