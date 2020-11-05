<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    /**
     * Primary key of the table
     *
     * @var string
     */
    protected $primaryKey = 'note_id';

    /**
     * Relation between tables
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contacts()
    {
        return $this->belongsTo('App\Models\Contact', 'contact_id');
    }
}
