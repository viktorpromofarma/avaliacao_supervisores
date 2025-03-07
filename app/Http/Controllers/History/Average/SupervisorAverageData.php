<?php

namespace App\Http\Controllers\History\Average;

use Illuminate\Http\Request;
use App\Http\Controllers\Basic\UserData;
use App\Models\StatusUserAnswers;

class SupervisorAverageData extends SupervisorAverageFilter
{

    private $userData;
    private function initializeUserData()
    {
        if (!$this->userData) {
            $this->userData = new UserData();
        }
    }
    public function index(Request $request)
    {

        $userData = $this->getUserData($request->supervisor);
        $supervisorStores = $this->getSupervisorStore($userData->seller);
        $supervisorAverage = $this->getSupervisorAverageData($request);
        $supervisorStoresAnswers = $this->getSupervisoreStoreAnswers($request->supervisor, $request->month, $request->year);


        return view('supervisors.average.supervisorAverageData', [
            'userData' => $userData,
            'supervisorStores' => $supervisorStores,
            'supervisorAverages' => $supervisorAverage,
            'supervisorStoresAnswers' => $supervisorStoresAnswers,
            'month' => $request->month,
            'year' => $request->year
        ]);
    }

    public function getSupervisorAverageData(Request $request)
    {
        $baseSupervisorAverage = $this->getSupervisorAverage($request->supervisor, $request->month, $request->year);
        $averageByCategory = $this->getAverageByCategory($baseSupervisorAverage);

        return $averageByCategory;
    }

    public function getUserData($id)
    {
        $this->initializeUserData();
        return $this->userData->getUserData($id);
    }


    public function getSupervisorStore($id)
    {
        $this->initializeUserData();
        return $this->userData->getSupervisorStore($id);
    }

    public function getSupervisoreStoreAnswers($id, $month, $year)
    {
        return StatusUserAnswers::query()
            ->where('supervisor', $id)
            ->where('month', $month)
            ->where('year', $year)
            ->get();
    }
}
