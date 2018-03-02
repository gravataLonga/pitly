<?php

namespace gravatalonga;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Illuminate\Contracts\Pagination;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Collection;
use Illuminate\Database\Eloquent\Builder;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class ApiResponse
{
    /* @var $scope League\Fractal\Scope */
    protected $scope;

    protected $rows;

    protected $object;

    public function __construct($object, $rows = null)
    {
        $this->object = $object;
        $this->rows = $rows;
    }

    public function fractal()
    {
        $results = $this->getResults();
        return $this->boot($results);
    }

    protected function boot($results = null)
    {
        $model = $this->getModel();
        $fractal = new Manager();
        if ($this->rows) {
            $paginator = $results->getCollection();
            $resource = new Collection($results, $this->resolve($model), $model);
            $resource->setPaginator(new IlluminatePaginatorAdapter($results));
        } else {
            $resource = new Item($results, $this->resolve($model), $model);
        }
        return $fractal->createData($resource);
    }

    protected function getResults()
    {
        if ($this->object instanceof Builder) {
            return $this->object->paginate($this->rows);
        } elseif ($this->object instanceof Model) {
            return $this->object;
        }
    }

    protected function getModel()
    {
        return str_singular($this->getTable());
    }

    protected function getTable()
    {
        return $this->object->newModelInstance()->getTable();
    }

    protected function resolve($model)
    {
        $model = $this->getClass($model);
        return new $model();
    }

    protected function getClass($model)
    {
        return 'App\Http\Controllers\Resources\\'.ucfirst($model).'Transform';
    }
}