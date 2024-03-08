<?php

namespace App\Models;

use App\Models\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Template extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the form that owns the Template
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forms(): HasMany
    {
        return $this->hasMany(Form::class);
    }

    /**
     * Get all of the submissions for the Template
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function fromSubmission(): HasManyThrough
    {
        return $this->hasManyThrough(Submission::class, Form::class);
    }
}
