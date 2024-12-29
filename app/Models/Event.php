<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'start_date', 'body', 'slug'];

    //    protected $dates = ['start_date'];

    protected $casts = ['start_date' => 'datetime:Y-m-d H:i:s'];

    // Accessors
    public function getTitleAttribute()
    {
        return strtoupper($this->attributes['title']);
    }

    public function getOwnerNameAttribute()
    {
        return !$this->owner ? "Organizador não informado" : $this->owner->name;
    }

    // Mutators
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
    
    public function setTitleAttribute($value)
    {
//        $this->attributes['slug'] = Str::slug($value);
//        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['title'] = Str::ucfirst($value);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = (\DateTime::createFromFormat('d/m/Y H:i', $value))->format('Y-m-d H:i');
    }
    
    // -------------------
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }


    public function getEventsHome($byCategory = null)
    {
        $events = $byCategory 
            ? $byCategory 
            : $this->orderBy('start_date', 'DESC');

        $events->when($search = request()->query('s'), function($queryBuilder) use ($search) {
            return $queryBuilder->where('title', 'LIKE', '%' . $search . '%');
        });
        
//        $events->whereRaw('DATE(start_date) >= DATE(NOW())');
        
        $events->whereDate('start_date', '>=', now());
        
        return $events;
    }
    
}
