<?php

declare(strict_types=1);

namespace app\services;

use yii\base\DynamicModel;
use yii\base\InvalidConfigException;
use yii\web\BadRequestHttpException;

class EvenNumbersValidationService
{
    /**
     * @param array $data
     * @return void
     * @throws BadRequestHttpException
     * @throws InvalidConfigException
     */
    public function validate(array $data): void
    {
        $model = DynamicModel::validateData($data, [
            [['numbers'], 'required'],
            [['numbers'], 'each', 'rule' => ['integer']],
        ]);

        if ($model->hasErrors()) {
            throw new BadRequestHttpException(
                'Invalid input format. ' . implode(' ', array_column($model->getErrors(), 0))
            );
        }
    }
}
