<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowFeedbackSupervisor extends FeedbackSupervisorDetails
{
    public function index(Request $request)
    {
        $metrics = $this->getMetrics($request->feedback_status_id);
        $user = $this->getUserData($request->feedback_status_id);
        $feedback = $this->getSupervisorFeedback($request->feedback_status_id);
        $totalAnswersManager = $this->getTotalAnswer($request->feedback_status_id);
        $conclusion = $this->getSupervisorConclusion($request->feedback_status_id)->conclusion;
        $positivePoints = $this->getSupervisorPositivePoints($request->feedback_status_id);
        $pointsToImprove = $this->getSupervisorpointsToImprove($request->feedback_status_id);
        $recomendations = $this->getSupervisorRecomendations($request->feedback_status_id);





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
        return $this->getMetrics($request->feedback_status_id);
    }

    public function SupervisorFeedback(Request $request)
    {

        return $this->getSupervisorFeedback($request->feedback_status_id);
    }

    public function getTotalAnswer($feedback_id)
    {
        return $this->getDataStructure($feedback_id);
    }

    public function getSupervisorConclusion($feedback_id)
    {
        return $this->getConclusion($feedback_id);
    }

    public function getSupervisorPositivePoints($feedback_id)
    {
        return $this->getPositivePoints($feedback_id);
    }

    public function getSupervisorpointsToImprove($feedback_id)
    {
        return $this->getpointsToImprove($feedback_id);
    }

    public function getSupervisorRecomendations($feedback_id)
    {
        return $this->getRecomendations($feedback_id);
    }
}
