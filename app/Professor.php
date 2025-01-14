<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Nicolaslopezj\Searchable\SearchableTrait;

/**
 * @property string name
 * @property string title
 * @property int gender
 * @property string univis_id
 * @property string univis_key
 * @property string univis_hash
 * @property int chair_id
 */
class Professor extends Model
{

    use SearchableTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'professors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'title',
        'gender',
        'chair_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['univis_id', 'univis_key', 'univis_hash', 'chair_id', 'pivot'];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name' => 100
        ],
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chair() {
        return $this->belongsTo('App\Chair');
    }

    /**
     * @return BelongsToMany
     */
    public function courses() {
        return $this->belongsToMany('App\Course',
            'course_professor', 'prof_id', 'course_id');
    }

    /**
     * @return BelongsToMany
     */
    public function tags() {
        return $this->belongsToMany('App\CourseTag',
            'tag_course', 'course_id', 'tag_id');
    }
}
