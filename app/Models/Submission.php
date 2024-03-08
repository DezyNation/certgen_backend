<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Submission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function formTemplate(): HasOneThrough
    {
        return $this->hasOneThrough(Template::class, Form::class, 'id', 'id', 'template_id', 'template_id');
    }

    /**
     * Get the form that owns the Submission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function template()
    {
        return $this->form->template;
    }
}
