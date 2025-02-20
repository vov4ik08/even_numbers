<?php
declare(strict_types=1);

namespace app\dto;

readonly class SumNumbersDTO
{
    /**
     * @param array $numbers
     */
    public function __construct(private array $numbers)
    {
    }

    /**
     * @return array
     */
    public function getNumbers(): array
    {
        return $this->numbers;
    }
}
