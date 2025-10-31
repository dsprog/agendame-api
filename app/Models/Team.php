<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(
            related: User::class,
            table: 'model_has_roles',
            foreignPivotKey: 'team_id',
            relatedPivotKey: 'model_id'
        );
    }
}
