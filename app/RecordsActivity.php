<?php
/**
 * Created by rainskiss.
 * User: rainskiss
 * Date: 2020/05/07
 * Time: 7:03 오후
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use function class_basename;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event){
            static::$event(function ($model) use ($event){
                $model->recordsActivity($event);
            });
        }
    }

    public static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }

        return ['created', 'updated'];
    }

    public function recordsActivity($event)
    {
        $this->activities()->create([
            'project_id'  => $this->projectId(),
            'description' => $this->activityDescription($event),
        ]);
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
    /**
     * @param $event
     *
     * @return string
     */
    protected function activityDescription($event): string
    {
        return strtolower("{$event}_" . class_basename($this));
    }

}
