<?php

namespace App\Traits;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

trait BaseModel
{
    public function getQueryFields(): array
    {
        $_this = new self();
        $fields = [];

        $default = $this->getQueryable();
        foreach ($default as $field) {
            $fields[] = $field;
        }

        foreach ($_this->getFillable() as $field) {
            $fields[] = $field;
        }

        return $fields;
    }

    public function getQueryFieldsWithRelationship(): array
    {
        $fields = $this->getQueryFields();
        $relationships = $this->getRelationship();
        // dd($relationships);
        foreach ($relationships as $relationship) {
            $relationshipObj = new $relationship['model']();
            $tableName = $relationshipObj->getTable();
            foreach ($relationshipObj->getFillable() as $field) {
                $fields[] = $tableName . '.' . $field;
            }
            foreach ($relationshipObj->queryable as $field) {
                $fields[] = $tableName . '.' . $field;
            }
        }

        return $fields;
    }

    public function getRelationship(): array
    {
        $relationship = $this->relationship;

        return $relationship ? $relationship : [];
    }

    public function getIncludes(): array
    {
        return array_keys($this->getRelationship());
    }

    public function getQB(): QueryBuilder
    {
        // $this->addMediaToIncludes();

        $queryBuilder = QueryBuilder::for(self::class)
            ->allowedFields($this->getQueryFieldsWithRelationship())
            ->allowedIncludes($this->getIncludes());
        $filters = $this->getQueryFields();
        if (isset($this->scopedFilters)) {
            foreach ($this->scopedFilters as $key => $value) {
                array_push($filters, AllowedFilter::scope($value));
            }
        }
        if (isset($this->exactFilters)) {
            foreach ($this->exactFilters as $key => $value) {
                array_push($filters, AllowedFilter::exact($value));
            }
        }
        // dd($this->defaultSort);
        if (isset($this->defaultSort)) {
            $queryBuilder->defaultSort($this->defaultSort);
        }
        $queryBuilder->allowedFilters($filters);

        return $queryBuilder;
    }

    private function getQueryable()
    {
        return ! empty($this->queryable) ? $this->queryable : ['id'];
    }

    /**
     * 
     * GET /users?append=display_status,display_name
     * This will append this attributes to the response.
     * 
     * If you define a protected property in model : protected $appends = ['display_status'];
     * Then 'display_status' will be appended to the response by default.
     */
    public function getAppends(): array
    {
        $appendParam = request()->get('append', '');
        $appendArray = is_string($appendParam) ? explode(',', $appendParam) : [];
        $allowedAppends = array_filter($appendArray, fn($value) => !empty($value));
        return array_merge($allowedAppends, $this->appends ?? []);
    }
}
