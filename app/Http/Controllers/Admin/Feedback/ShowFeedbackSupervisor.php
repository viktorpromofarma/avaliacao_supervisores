<?php

namespace App\Http\Controllers\Admin\Feedback;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Admin\Feedback\FeedbackSupervisorDetails;

class ShowFeedbackSupervisor extends FeedbackSupervisorDetails
{
    public function index(Request $request)
    {


        $metrics = $this->getMetrics($request->feedback_status_id, $request->month, $request->year);
        $user = $this->getUserData($request->feedback_status_id, $request->month, $request->year);
        $feedback = $this->getSupervisorFeedback($request->feedback_status_id, $request->month, $request->year);
        $totalAnswersManager = $this->getTotalAnswer($request->feedback_status_id, $request->month, $request->year);
        $conclusion = $this->getSupervisorConclusion($request->feedback_status_id, $request->month, $request->year)->conclusion;
        $positivePoints = $this->getSupervisorPositivePoints($request->feedback_status_id, $request->month, $request->year);
        $pointsToImprove = $this->getSupervisorpointsToImprove($request->feedback_status_id, $request->month, $request->year);
        $recomendations = $this->getSupervisorRecomendations($request->feedback_status_id, $request->month, $request->year);





        return view('admin.feedback.showFeedbackSupervisor', [
            'metrics' => $metrics,
            'user' => $user,
            'feedback' => $feedback,
            'totalAnswersManager' => $totalAnswersManager,
            'positivePoints' => $positivePoints,
            'pointsToImprove' => $pointsToImprove,
            'recomendations' => $recomendations,
            'conclusion' => $conclusion

        ]);
    }





    public function getFeedbackMetrics(Request $request)
    {
        return $this->getMetrics($request->feedback_status_id, $request->month, $request->year);
    }

    public function SupervisorFeedback(Request $request)
    {

        return $this->getSupervisorFeedback($request->feedback_status_id, $request->month, $request->year);
    }

    public function getTotalAnswer($feedback_id, $month, $year)
    {
        return $this->getDataStructure($feedback_id, $month, $year);
    }

    public function getSupervisorConclusion($feedback_id, $month, $year)
    {
        return $this->getConclusion($feedback_id, $month, $year);
    }

    public function getSupervisorPositivePoints($feedback_id, $month, $year)
    {
        return $this->getPositivePoints($feedback_id, $month, $year);
    }

    public function getSupervisorpointsToImprove($feedback_id, $month, $year)
    {
        return $this->getpointsToImprove($feedback_id, $month, $year);
    }

    public function getSupervisorRecomendations($feedback_id, $month, $year)
    {
        return $this->getRecomendations($feedback_id, $month, $year);
    }
}
