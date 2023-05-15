<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ModelChangeObserver
{
    public function created(Model $model)
    {
        $this->log('created', $model);
    }

    public function updated(Model $model)
    {
        $this->log('updated', $model);
    }

    public function deleted(Model $model)
    {
        $this->log('deleted', $model);
    }

    protected function log($action, Model $model)
    {
        $logData = sprintf(
            "[%s] %s: %s - %s\n",
            now()->toDateTimeString(),
            $action,
            get_class($model),
            json_encode($model->getAttributes())
        );

        Log::channel('model_changes')->info($logData);
    }
}
