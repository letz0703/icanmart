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
            self::recordsActivity($event);
        }
    }

    public static function recordableEvents()
    {
        if (isset(static::$eventToRecord)) {
            return static::$eventToRecord;
        }

        return ['created', 'updated', 'deleted'];
    }

    protected static function recordsActivity($event)
    {
        static::$event(function ($model) use ($event){
            $modelOld = $model;
            //
            if (class_basename($model) !== 'Project'){
                $model = $model->project;
            }

            $model->activities()->create([
                'project_id'  => class_basename($model) == 'Project' ?? $model->project->id,
                'description' => self::formatActivityDescription($event, $modelOld)
            ]);
        });
    }

    protected static function formatActivityDescription($event, $model)
    {
        return strtolower("{$event}_" . class_basename($model));
    }

}
