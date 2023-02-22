<?php

return [
    \Psr\SimpleCache\CacheInterface::class => static function () {
        $hostname = getenv('REDIS_HOSTNAME');
        $port = getenv('REDIS_PORT');

        /**
         * @psalm-suppress UndefinedClass
         */
        $redis = \Symfony\Component\Cache\Adapter\RedisAdapter::createConnection(
            "redis://{$hostname}:{$port}",
            [
                'persistent' => 1,
            ]
        );

        $psr6Cache = new \Symfony\Component\Cache\Adapter\RedisAdapter($redis);

        return new \Symfony\Component\Cache\Psr16Cache($psr6Cache);
    },
    \yii\redis\Connection::class => static function () {
        return new \yii\redis\Connection(
            [
                'hostname' => getenv('REDIS_HOSTNAME'),
                'port' => (int) getenv('REDIS_PORT'),
                'database' => (int) getenv('REDIS_DATABASE'),
                'retries' => getenv('REDIS_RETRIES') ?? 2,
                'socketClientFlags' => STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT,
            ]
        );
    },

    \common\services\AuctionService::class => \common\services\AuctionService::class,
    \common\services\ProductService::class => \common\services\ProductService::class,

    \common\repositories\AuctionsRepositoryInterface::class => \common\repositories\databases\AuctionsRepository::class,
    \common\repositories\AuctionUsersRepositoryInterface::class => \common\repositories\databases\AuctionUsersRepository::class,
    \common\repositories\ProductsRepositoryInterface::class => \common\repositories\databases\ProductsRepository::class,
    \common\repositories\CategoriesRepositoryInterface::class => \common\repositories\databases\CategoriesRepository::class,
];
