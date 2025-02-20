<?php
declare(strict_types=1);

namespace unit\services;

use app\services\EvenNumbersValidationService;
use yii\base\InvalidConfigException;
use yii\web\BadRequestHttpException;
use PHPUnit\Framework\TestCase;

/**
 * @group evenNumbersGroup
 */
class EvenNumbersValidationServiceTest extends TestCase
{
    private EvenNumbersValidationService $service;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new EvenNumbersValidationService();
    }

    /**
     * @return void
     * @throws InvalidConfigException
     */
    public function testValidateValidData(): void
    {
        $data = [
            'numbers' => [2, 4, 6, 8],
        ];

        try {
            $this->service->validate($data);
            $this->assertTrue(true);  // Если валидация прошла, то тест успешен
        } catch (BadRequestHttpException $e) {
            $this->fail('Validation failed unexpectedly');
        }
    }

    /**
     * @return void
     * @throws BadRequestHttpException
     * @throws InvalidConfigException
     */
    public function testValidateMissingNumbers(): void
    {
        $data = [];

        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage('Invalid input format. Numbers cannot be blank.');

        $this->service->validate($data);
    }

    /**
     * @return void
     * @throws BadRequestHttpException
     * @throws InvalidConfigException
     */
    public function testValidateNonIntegerValues(): void
    {
        $data = [
            'numbers' => [2, 4, 'invalid'],
        ];

        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage('Invalid input format.');

        $this->service->validate($data);
    }

    /**
     * @return void
     * @throws BadRequestHttpException
     * @throws InvalidConfigException
     */
    public function testValidateEmptyNumbersArray(): void
    {
        $data = [
            'numbers' => [],
        ];

        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage('Invalid input format.');

        $this->service->validate($data);
    }
}
