<?php
/**
 * Created by rainskiss.
 * User: rainskiss
 * Date: 2020/04/29
 * Time: 3:05 오전
 */

namespace App;


use Illuminate\Support\Arr;
use function class_basename;
use function strtolower;

trait RecordsActivity
{
    public $oldAttributes = [];

    public static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event){
            static::$event(function($model) use ($event){
                $model->recordActivity($model->activityDescription($event));
            });

            static::updating(function ($model){
                $model->oldAttributes = $model->getOriginal();
            });
        }
    }

    public function activityDescription($description)
    {
        return $description = "{$description}_".strtolower(class_basename($this));
    }

    protected static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return  static::$recordableEvents;
        }
        return ['created', 'updated'];
    }

    public function recordActivity($description)
    {
        $this->activities()->create([
            'user_id' => $this->activityOwner()->id,
            'project_id'  => class_basename($this) === 'Project' ? $this->id : $this['project_id'],
            'description' => $description,
            'changes'     => $this->getActivityChanges($description),
        ]);
    }

    public function activityOwner()
    {
        return $this->owner ?? $this->project->owner;
    }


    public function activities()
    {
        if (get_class($this) === Project::class) {
            return $this->hasMany(ProjectActivity::class)->latest();
        }

        return $this->morphMany(ProjectActivity::class, 'subject')->latest();
    }

    /**
     * @param $description
     *
     * @return array
     */
    protected function getActivityChanges($description)
    {
        if ($this->wasChanged()) {
            return [
                'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after'  => Arr::except($this->getChanges(), 'updated_at'),
            ];
        }
    }
}
