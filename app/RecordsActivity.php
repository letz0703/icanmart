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
        foreach (static::recordableEvents() as $event){
            static::$event(function ($model) use ($event){
                self::recordsActivity($model, $event);
            });
        }
    }

    public static function recordableEvents()
    {
        if (isset(static::$eventToRecord)) {
            return static::$eventToRecord;
        }

        return ['created', 'updated', 'deleted'];
    }

    protected static function recordsActivity($model, $event)
    {
        if (class_basename($model) == 'Project') {
            $model->activities()->create([
                'project_id'  => class_basename($model) === 'Project' ? $model->id : $model['project_id'],
                'description' => strtolower("{$event}_" . class_basename($model)),
            ]);
        } else {
            $model->project->activities()->create([
                'project_id'  => class_basename($model) === 'Project' ? $model->id : $model['project_id'],
                'description' => strtolower("{$event}_" . class_basename($model)),
            ]);
        }
    }

}
