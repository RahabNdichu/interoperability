<?php

namespace App;

use App\Observers\KpaApplicationObserver;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class NSSF extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable;

    protected $connection = 'mysql1';

    public $table = 'records';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'kpa_amount',
        'description',
        'analyst_id',
        'cfo_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
        'status_id',
    ];

    // protected static function booted()
    // {
    //     self::observe(KpaApplicationObserver::class);
    // }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // public function status()
    // {
    //     return $this->belongsTo(Status::class, 'status_id');
    // }

    // public function analyst()
    // {
    //     return $this->belongsTo(User::class, 'analyst_id');
    // }

    // public function cfo()
    // {
    //     return $this->belongsTo(User::class, 'cfo_id');
    // }

    public function record()
    {
        return $this->belongsTo(User::class);
    }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }

    // public function logs()
    // {
    //     return $this->morphMany(AuditLog::class, 'subject');
    // }
}
