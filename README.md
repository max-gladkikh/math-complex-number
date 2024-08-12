# math-complex-number
Library for working with complex numbers.

## Install

Via Composer

### Step 1

Adding this is repository in your composer.json

``` bash
$ composer config repositories.max-gladkikh vcs https://github.com/max-gladkikh/math-complex-number.git
```

### Step 2
Adding this is library in your composer.json

For php >= 7.0.0

``` bash
$ composer require "max-gladkikh/math-complex-number:v7.0.0.1"
```

Or for php >= 5.6.0

``` bash
$ composer require "max-gladkikh/math-complex-number:v5.6.0.1"
```

## Usage
Creating new complex number

``` php
$a = new ComplexMath\ComplexNumber('1', '2');
echo $a; // 1+2i

$b = new ComplexMath\ComplexNumber('3.45', '6.789');
echo $b; // 3.45+6.789i
```

Operations with complex numbers

``` php
$calc = new ComplexMath\ComplexNumberCalculator();

$c = $calc->add($a, $b);
echo $c; // 4.45+8.78i

$d = $calc->add($a, $b, 8);
echo $d; // 4.45000000+8.78900000i
```

The ComplexNumberCalculator currently provides the following operations:

- addition
- subtraction
- multiplication
- division