<?php

namespace common\components;

use yii\filters\ContentNegotiator;
use yii\web\Response;

abstract class RestController extends \yii\web\Controller
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        return $behaviors;
    }

    public function response(array $data = []): array
    {
        $this->response->format = Response::FORMAT_JSON;

        return [
            'code' => 200,
            'data' => $data,
        ];
    }
}
