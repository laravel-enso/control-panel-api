<?php

namespace LaravelEnso\StatisticsManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Jenssegers\Date\Date;
use LaravelEnso\ActionLogger\app\Models\ActionLog;
use LaravelEnso\Core\app\Models\Login;
use LaravelEnso\Helpers\Classes\Object;
use LaravelEnso\LogManager\app\Http\Controllers\LogManagerController;

class StatisticsController extends Controller
{
    public function clearLaravelLog()
    {
        $logManagerController = new LogManagerController();

        return $logManagerController->destroy('laravel.log');
    }

    /** Valid calls are:
     * (api token) http://enso.dev/api/statistics?api_token=abc&startDate=2017-01-01&endDate=2017-12-01
     * (passport) http://enso.dev/api/statistics?startDate=2017-01-01&endDate=2017-12-01
     * For passport you need to pass the bearer in the header.
     *
     * @param Request $request
     *
     * @return array
     */
    public function getStatistics(Request $request)
    {
        $startDate = Date::parse($request->get('startDate'))->format('Y-m-d');
        $endDate = Date::parse($request->get('endDate'))->format('Y-m-d');
        $dataTypes = $request->get('dataTypes');

        $response = $this->gatherStatistics($startDate, $endDate, $dataTypes);

        return json_encode($response);
    }

    private function gatherStatistics($startDate, $endDate, $dataTypes)
    {
        $response = [];

        if (in_array('logins', $dataTypes)) {
            $logins = $this->getLoginsCount($startDate, $endDate);
            $response[] = $logins;
        }

        if (in_array('actions', $dataTypes)) {
            $actions = $this->getActionsCount($startDate, $endDate);
            $response[] = $actions;
        }

        if (in_array('failedJobs', $dataTypes)) {
            $failedJobs = $this->getFailedJobsCount($startDate, $endDate);
            $response[] = $failedJobs;
        }

        if (in_array('activeSessions', $dataTypes)) {
            $activeSessions = $this->getActiveSessionsCount();
            $response[] = $activeSessions;
        }

        if (in_array('serverTime', $dataTypes)) {
            $serverTime = $this->getServerTime();
            $response[] = $serverTime;
        }

        if (in_array('logSize', $dataTypes)) {
            $logFileSize = $this->getLogFileSize();
            $response[] = $logFileSize;
        }

        return $response;
    }

    private function getLoginsCount($startDate, $endDate)
    {
        $tmp = new Object();
        $tmp->key = 'logins';
        $tmp->value = Login::where('created_at', '>', $startDate)->where('created_at', '<', $endDate)->count();

        return $tmp;
    }

    private function getActionsCount($startDate, $endDate)
    {
        $tmp = new Object();
        $tmp->key = 'actions';
        $tmp->value = ActionLog::where('created_at', '>', $startDate)->where('created_at', '<', $endDate)->count();

        return $tmp;
    }

    private function getFailedJobsCount($startDate, $endDate)
    {
        $tmp = new Object();
        $tmp->key = 'failedJobs';
        $tmp->value = DB::table('failed_jobs')
            ->select(DB::raw('*'))
            ->where('failed_at', '>', $startDate)
            ->where('failed_at', '<', $endDate)
            ->count();

        return $tmp;
    }

    private function getActiveSessionsCount()
    {
        $tmp = new Object();
        $tmp->key = 'activeSessions';
        $tmp->value = DB::table('sessions')
            ->select(DB::raw('*'))
            ->count();

        return $tmp;
    }

    private function getServerTime()
    {
        $tmp = new Object();
        $tmp->key = 'serverTime';
        $tmp->value = Carbon::now()->toTimeString();

        return $tmp;
    }

    private function getLogFileSize($filename = 'laravel.log')
    {
        $file = storage_path('logs/'.$filename);

        $tmp = new Object();
        $tmp->key = 'logSize';
        $tmp->value = round((int) File::size($file) / 1048576, 2).' MB';

        return $tmp;
    }
}
