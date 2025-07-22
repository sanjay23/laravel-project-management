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

class Project extends Model
{
    use HasFactory, SoftDeletes, ApiResponser, BaseModel, PaginationTrait, ResourceFilterable, HasUuid;


    protected $fillable = [
        'name',
        'slug',
        'description',
        'start_date',
        'end_date',
        'status',
        'deleted_by',
        'created_by',
        'updated_by',
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected function casts()
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public $queryable = [
        'id',
    ];
    
    protected $scopedFilters = [
        'search',
    ];

    protected $relationship = [
        'users' => [
            'model' => User::class,
        ],
        'timeLogs' => [
            'model' => Timesheet::class,
        ],
        'projectUsers' => [
            'model' => ProjectUser::class,
            'pivot' => true,
        ],
    ];

    public function scopeSearch(object $query, string $value)
    {
        return $query->where('name', 'LIKE', "%$value%");
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(ProjectUser::class);
    }

    public function timeLogs()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function projectUsers()
    {
        return $this->belongsToMany(User::class, 'project_users');
    }

    

}
