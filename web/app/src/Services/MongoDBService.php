<?php

namespace App\Services;

use MongoDB\Driver\Query;
use MongoDB\Driver\Manager;

class MongoDBService
{
    private ?Manager $connection = null;
    private array $filters = [];
    private array $options = [
        'limit' => 15
    ];

    public function filters(mixed $filters): self
    {
        $this->filters[] = $filters;
        return $this;
    }

    public function options(mixed $options): self
    {
        $this->options[] = $options;
        return $this;
    }

    public function query(string $collection)
    {
        $dbCollection = \env('MONGO_DATABASE') . '.' . $collection;

        $query = new Query($this->filters, $this->options);
        return $this->getConnection()->executeQuery($dbCollection, $query);
    }

    public function getConnection(): Manager
    {
        if (null === $this->connection) {
            $connection = sprintf(
                'mongodb://%s:%s@%s:%s',
                \env('MONGO_USER'),
                \env('MONGO_PASSWORD'),
                \env('MONGO_HOST'),
                \env('MONGO_PORT'),
            );
            $this->connection = new Manager($connection);
        }

        return $this->connection;
    }
}
