<?php

namespace App\Models;

use App\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Form extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the template associated with the Form
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }
}
