<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ApiResponser;
use App\Traits\BaseModel;
use App\Traits\BootModel;
use App\Traits\PaginationTrait;
use App\Traits\ResourceFilterable;
use App\Traits\HasUuid;
use App\Traits\HasUserAction;
use Illuminate\Database\Eloquent\Model;
use App\Models\Timesheet;
use App\Models\User;

class ProjectUser extends Model
{
    use HasFactory, SoftDeletes, ApiResponser, BaseModel, PaginationTrait;


    protected $fillable = [
        'project_id',
        'user_id',
    ];

    protected $hidden = [];

    public $queryable = [
        'id', 'user_id','project_id',
    ];


}
