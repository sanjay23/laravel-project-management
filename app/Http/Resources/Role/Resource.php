<?php

namespace App\Http\Resources\Role;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\Resource as UserResource;

class Resource extends JsonResource
{

     use ResourceFilterable;
     protected $model = Role::class;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       $data = $this->fields();
       return $data;
    }
}
