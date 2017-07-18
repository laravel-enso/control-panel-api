<?php

namespace LaravelEnso\ControlPanelApi\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Jenssegers\Date\Date;
use LaravelEnso\ActionLogger\app\Models\ActionLog;
use LaravelEnso\ControlPanelApi\app\Enums\DataTypesEnum;
use LaravelEnso\Core\app\Models\Login;
use LaravelEnso\Helpers\Classes\Object;
use LaravelEnso\LogManager\app\Http\Controllers\LogController;
use Lcobucci\JWT\Parser;

class ApiController extends Controller
{
    public function setMaintenanceMode()
    {
        $exitCode = Artisan::call('down', []);

        \Log::debug('exit code: '.$exitCode);

        return $exitCode;
    }

    public function deleteOauthToken(Request $request)
    {
        $token = $request->bearerToken();
        $id = (new Parser())->parse($token)->getHeader('jti');

//        $sql= "DELETE FROM oauth_access_tokens where id='$id';";
//        DB::connection()->getPdo()->exec($sql);

        return response('Deleted');
    }

    public function clearLaravelLog()
    {
        $logManagerController = new LogController();

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

        if (!$this->areDataTypesValid($dataTypes)) {
            return response('Invalid dataType(s) requested', 400);
        }

        foreach ($dataTypes as $type) {
            $typeGetter = 'get'.ucfirst($type);
            $tmp = $this->{$typeGetter}($startDate, $endDate);
            $response[] = $tmp;
        }

        return $response;
    }

    private function getLoginsCount($startDate, $endDate)
    {
        $tmp = new Object();
        $tmp->key = 'loginsCount';
        $tmp->value = Login::where('created_at', '>', $startDate)->where('created_at', '<', $endDate)->count();

        return $tmp;
    }

    private function getActionsCount($startDate, $endDate)
    {
        $tmp = new Object();
        $tmp->key = 'actionsCount';
        $tmp->value = ActionLog::where('created_at', '>', $startDate)->where('created_at', '<', $endDate)->count();

        return $tmp;
    }

    private function getFailedJobsCount($startDate, $endDate)
    {
        $tmp = new Object();
        $tmp->key = 'failedJobsCount';
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
        $tmp->key = 'activeSessionsCount';
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

    private function getLogFileSize()
    {
        $filename = 'laravel.log';

        $file = storage_path('logs/'.$filename);

        $tmp = new Object();
        $tmp->key = 'logFileSize';
        $tmp->value = round((int) File::size($file) / 1048576, 2).' MB';

        return $tmp;
    }

    private function areDataTypesValid($dataTypes)
    {
        $acceptedDataTypes = (new DataTypesEnum())->getKeys();
        $diffs = array_diff($dataTypes, $acceptedDataTypes);

        if (count($diffs)) {
            return false;
        }

        return true;
    }
}
