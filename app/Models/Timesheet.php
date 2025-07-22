<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ApiResponser;
use App\Traits\BaseModel;
use App\Traits\PaginationTrait;
use App\Traits\ResourceFilterable;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\User;


class Timesheet extends Model
{
    use HasFactory,ApiResponser, BaseModel, PaginationTrait, ResourceFilterable, HasUuid;
    protected $table = 'project_logs';
    protected $fillable = [
        'project_id',
        'user_id',
        'approve',
        'approved_hours',
        'deleted_by',
        'log_date',
        'billable_hours',
        'created_by',
        'updated_by',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected function casts()
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public $queryable = [
        'id',
    ];
    protected $relationship = [
        'user' => [
            'model' => 'App\\Models\\User',
        ],
        'project' => [
            'model' => 'App\\Models\\Project',
        ],
    ];

    


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   

}
