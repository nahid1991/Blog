<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {


    /**
     * Fillable field for tag
     *
     * @var array
     */
    protected $fillable=[
        'name',
    ];



    /**
     * Get the associated tags with the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }

}
