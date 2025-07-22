<?php

namespace App\Http\Resources\ProjectUser;

use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{

     use ResourceFilterable;
     protected $model = ProjectUser::class;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      // dd($this->fields());
       $data = $this->fields();
       return $data;
    }
}
