<?php
declare(strict_types=1);

namespace unit\controllers;

use app\controllers\EvenNumbersController;
use Yii;
use yii\web\BadRequestHttpException;
use Codeception\Test\Unit;

/**
 * @group evenNumbersGroup
 */
class EvenNumbersControllerTest extends Unit
{
    private EvenNumbersController $controller;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->controller = new EvenNumbersController('even-numbers', null);
        $this->controller->init();
    }

    /**
     * @return void
     * @throws BadRequestHttpException
     */
    public function testSumEvenValidInput()
    {
        Yii::$app->request->setRawBody(json_encode(['numbers' => [1, 2, 3, 4, 5, 6]]));
        Yii::$app->request->headers->set('Accept', 'application/json');

        $result = $this->controller->actionSumEven();
        $this->assertEquals(['sum' => 12], $result);
    }

    /**
     * @return void
     * @throws BadRequestHttpException
     */
    public function testSumEvenInvalidInput()
    {
        Yii::$app->request->setRawBody(json_encode(['numbers' => 'some_strings']));
        Yii::$app->request->headers->set('Accept', 'application/json');

        $this->expectException(BadRequestHttpException::class);
        $this->controller->actionSumEven();
    }

    /**
     * @return void
     * @throws BadRequestHttpException
     */
    public function testSumEvenMissingNumbersKey()
    {
        Yii::$app->request->setRawBody(json_encode([]));
        Yii::$app->request->headers->set('Accept', 'application/json');

        $this->expectException(BadRequestHttpException::class);
        $this->controller->actionSumEven();
    }
}
