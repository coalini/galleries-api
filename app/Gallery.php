<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';
    
    protected $fillable = [
        'title', 
        'description',
        'user_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function images() 
    {
        return $this->hasMany(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function filter($term, $userId = null)
    { 
        $query = Gallery::query();

        $query->with(['images', 'user']);

        if($userId) {
            $query->where('user_id', '=', $userId);
        }

        if($term) {
            $query->where(function($que) use ($term){
                $que->where('title', 'like', '%'.$term.'%')
                  ->orWhere('description','like', '%'.$term.'%')
                  ->orWhereHas('user', function($q) use ($term){
                      $q->where('first_name', 'like', '%'.$term.'%')
                        ->orWhere('last_name','like', '%'.$term.'%');    
                  }); 
                });
        }
        
        return response()->json([
            'galleries' =>  $query->latest()->paginate(10)
        ]);
    }
}
