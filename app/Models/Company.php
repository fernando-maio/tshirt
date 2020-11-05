<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    /**
     * Primary key of the table
     *
     * @var string
     */
    protected $primaryKey = 'company_id';
    
    /**
     * Relation between tables
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact', 'contact_id');
    }
}
