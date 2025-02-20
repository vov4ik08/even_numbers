<?php

declare(strict_types=1);

namespace unit\services;

use app\dto\SumNumbersDTO;
use app\services\EvenNumbersService;
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;

/**
 * @group evenNumbersGroup
 */
class EvenNumbersServiceTest extends TestCase
{
    private EvenNumbersService $evenNumbersService;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->evenNumbersService = new EvenNumbersService();
    }

    /**
     * @return void
     */
    public function testCalculateSumWithValidData()
    {
        $numbers = new SumNumbersDTO([1, 2, 3, 4, 5, 6]);
        $sum = $this->evenNumbersService->calculateSum($numbers);

        $this->assertEquals(12, $sum);
    }

    /**
     * @return void
     */
    public function testCalculateSumWithEmptyArray()
    {
        $numbers = new SumNumbersDTO([]);
        $this->expectException(InvalidArgumentException::class);
        $this->evenNumbersService->calculateSum($numbers);
    }

    /**
     * @return void
     */
    public function testCalculateSumWithSingleEvenNumber()
    {
        $numbers = new SumNumbersDTO([2]);
        $sum = $this->evenNumbersService->calculateSum($numbers);

        $this->assertEquals(2, $sum);
    }

    /**
     * @return void
     */
    public function testCalculateSumWithSingleOddNumber()
    {
        $numbers = new SumNumbersDTO([3]);
        $sum = $this->evenNumbersService->calculateSum($numbers);

        $this->assertEquals(0, $sum);
    }

    /**
     * @return void
     */
    public function testCalculateSumWithAllEvenNumbers()
    {
        $numbers = new SumNumbersDTO([2, 4, 6, 8]);
        $sum = $this->evenNumbersService->calculateSum($numbers);

        $this->assertEquals(20, $sum);
    }

    /**
     * @return void
     */
    public function testCalculateSumWithAllOddNumbers()
    {
        $numbers = new SumNumbersDTO([1, 3, 5, 7]);
        $sum = $this->evenNumbersService->calculateSum($numbers);

        $this->assertEquals(0, $sum);
    }

    /**
     * @return void
     */
    public function testCalculateSumWithLargeArray()
    {
        $numbers = new SumNumbersDTO(array_fill(0, 1000, 2));

        $sum = $this->evenNumbersService->calculateSum($numbers);

        $this->assertEquals(2000, $sum);
    }

}
