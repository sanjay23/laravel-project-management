<?php

namespace App\Http\Resources\Timesheet;

use App\Models\Timesheet;
use Illuminate\Http\Request;
use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\Resource as UserResource;
use App\Http\Resources\Project\Resource as ProjectResource;

class Resource extends JsonResource
{

     use ResourceFilterable;
     protected $model = Timesheet::class;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       $data = $this->fields();
       $data['user'] = new UserResource($this->whenLoaded('user'));
       $data['project'] = new ProjectResource($this->whenLoaded('project'));
       return $data;
    }
}
