<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
  protected $dates = ['published_at'];

  public function author()
  {
    return $this->belongsTo(User::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function getImageUrlAttribute($value)
  {
    $imageUrl = "";
    if( ! is_null($this->image) )
    {
      $imagePath = public_path().'/img/'.$this->image;
      if(file_exists($imagePath)) $imageUrl = asset('img/'.$this->image);
    }

    return $imageUrl;
  }

  public function getDateAttribute($value)
  {
    return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
  }

  public function getBodyHtmlAttribute($value)
  {
    return $this->body ? @markdown(e($this->body)) : NULL;
  }

  public function getExcerptHtmlAttribute($value)
  {
    return $this->excerpt ? @markdown(e($this->excerpt)) : NULL;
  }

  public function scopeLatestFirst($query)
  {
    return $query->orderBy('created_at', 'desc');
  }

  public function scopePublished($query)
  {
    return $query->where('published_at', '<=', Carbon::now());
  }
}
