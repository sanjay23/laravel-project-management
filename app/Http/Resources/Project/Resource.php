<?php

namespace App\Http\Resources\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProjectUser\Resource as ProjectUserResource;

class Resource extends JsonResource
{

     use ResourceFilterable;
     protected $model = Project::class;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       $data = $this->fields();
       $data['project_users'] = $this->whenLoaded('projectUsers');
       return $data;
    }
}
