<?php
/**
 * Created by rainskiss.
 * User: rainskiss
 * Date: 2020/05/07
 * Time: 7:03 오후
 */

namespace App;


use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use function class_basename;

trait RecordsActivity
{
    public $old = [];

    protected static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event){
            static::$event(function ($model) use ($event){
                $model->recordsActivity($model->activityDescription($event));
            });

            static::updating(function ($model) use ($event){
                $model->old = $model->getOriginal();
            });
        }
    }

    public function serializeDate(DateTimeInterface $date)
    {
        return $date->format("Y-m-d H:i:s");
    }


    public function activityDescription($description)
    {
        return $description = strtolower("{$description}_" . class_basename($this));
    }

    public static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }

        return ['created', 'updated'];
    }

    public function recordsActivity($description)
    {
        $this->activities()->create([
            'project_id'  => $this->projectId(),
            'user_id'  => $this->activityOwner()->id,
            'description' => $description,
            'changes'     => $this->wasChanged() ?
                [
                    'before' => array_diff($this->old, $this->getAttributes()),
                    'after'  => $this->getChanges(),
                ]
                : null,
        ]);
    }

    public function activityOwner()
    {
        $project = $this->project ?? $this;
        return $project->owner;
    }


    public function activities()
    {
        if (get_class($this) === Project::class) {
            return $this->hasMany(ProjectActivity::class)->latest();
        }

        return $this->morphMany(ProjectActivity::class, 'subject')->latest();
    }
    /**
     * @return mixed
     */
    protected function projectId()
    {
        return class_basename($this) === 'Project' ? $this->id : $this['project_id'];
    }

}
