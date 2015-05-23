<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model {

	protected $fillable = [

		'title',
		'body',
		'published_at', //Temporary

	];

	protected $dates = ['published_at'];

	public function setPublishedAtAttribute($date)
	{
		$this->attributes['published_at'] = Carbon::parse($date);
	}



    public function getPublishedAtAttribute($date)
    {
        return new Carbon($date);
    }

	public function scopePublished($query)
	{
		$query->where('published_at', '<=', Carbon::now());
	}


    /**
     * An article belongs to an user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }


    /**
     * Get a list of tag ids associated with the current article
     *
     * @return array
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }


}
