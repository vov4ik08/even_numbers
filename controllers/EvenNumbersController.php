<?php

namespace app\controllers;

use app\dto\SumNumbersDTO;
use app\services\EvenNumbersService;
use app\services\EvenNumbersValidationService;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class EvenNumbersController extends Controller
{
    private EvenNumbersService $evenNumbersService;
    private EvenNumbersValidationService $validationService;


    /**
     * @return void
     */
    public function init(): void
    {
        $this->evenNumbersService = new EvenNumbersService();
        $this->validationService = new EvenNumbersValidationService();
        parent::init();
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionSumEven(): array
    {
        try {
            $body = \Yii::$app->request->getRawBody();
            $data = json_decode($body, true);
            if (!empty($data) && is_array($data)) {
                $this->validationService->validate($data);
                $dto = new SumNumbersDTO($data['numbers']);
                $sum = $this->evenNumbersService->calculateSum($dto);
                return ['sum' => $sum];
            } else {
                throw new BadRequestHttpException(
                    'Invalid input format.'
                );
            }
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
}
