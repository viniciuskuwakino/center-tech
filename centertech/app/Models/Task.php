<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cen_tasks';


    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cen_client_id',
        'device',
        'brand',
        'model',
        'serial_number',
        'description',
        'price',
        'status'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'cen_client_id');
    }
}
