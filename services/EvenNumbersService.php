<?php

declare(strict_types=1);

namespace app\services;

use app\dto\SumNumbersDTO;
use yii\base\Component;
use yii\base\InvalidArgumentException;

class EvenNumbersService extends Component
{
    /**
     * @param SumNumbersDTO $dto
     * @return int
     */
    public function calculateSum(SumNumbersDTO $dto): int
    {
        if (empty($dto->getNumbers())) {
            throw new InvalidArgumentException('The numbers array cannot be empty.');
        }

        $sum = 0;
        foreach ($dto->getNumbers() as $number) {
            if ($number % 2 === 0) {
                $sum += $number;
            }
        }

        return $sum;
    }
}
