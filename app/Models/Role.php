<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseModel;
use App\Traits\BootModel;
use App\Traits\PaginationTrait;
use App\Traits\ResourceFilterable;
use App\Traits\HasUuid;
use App\Traits\HasUserAction;
use App\models\Project;
use App\models\Timesheet;
use Laravel\Sanctum\HasApiTokens;

class Role extends Model
{
    use BaseModel, PaginationTrait, ResourceFilterable, HasUuid, HasApiTokens;

    protected $fillable = ['name'];

    public $queryable = [
        'id',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
