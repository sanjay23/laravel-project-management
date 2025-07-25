<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\BaseModel;
use App\Traits\BootModel;
use App\Traits\PaginationTrait;
use App\Traits\ResourceFilterable;
use App\Traits\HasUuid;
use App\Traits\HasUserAction;
use App\models\Project;
use App\models\Timesheet;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, BaseModel, PaginationTrait, ResourceFilterable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $queryable = [
        'id',
    ];

    protected $relationship = [
        'projects' => [
            'model' => 'App\\Models\\Project',
        ],
        'projectUsers' => [
            'model' => 'App\\Models\\ProjectUser'
        ],
        'role' => [
            'model' => 'App\\Models\\Role',
        ],
    ];

    public $exactFilters = [
        'status',
    ];

    public $scopedFilters = [
        'search',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class,'project_users');
    }

    public function timeLogs()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function scopeSearch(object $query, string $value)
    {
        return $query->Where('name', 'LIKE', "%$value%")
            ->orWhere('email', 'LIKE', "%$value%");
    }
}
