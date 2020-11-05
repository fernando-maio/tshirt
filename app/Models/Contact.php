<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * Primary key of the table
     *
     * @var string
     */
    protected $primaryKey = 'contact_id';

    /**
     * Relation between tables
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function companies()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    /**
     * Relation between tables
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('App\Models\Note', 'note_id');
    }
}
