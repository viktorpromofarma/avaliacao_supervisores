<?php

namespace App\Http\Controllers\Admin\Feedback;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Basic\UserData;
use App\Models\StatusFeedbackSupervisor;
use App\Http\Controllers\History\Average\SupervisorAverageData;
use App\Models\SaveFeedbackSupervisor;


class FeedbackSupervisorDetails extends Controller
{
    public function getSupervisorFeedback($feedback_id)
    {
        return StatusFeedbackSupervisor::where('id', $feedback_id)->first();
    }

    public function getMetrics($feedback_id)
    {
        $feedback = $this->getSupervisorFeedback($feedback_id);
        $request = new Request([
            'supervisor' => $feedback->user_id,
            'month' => $feedback->month,
            'year' => $feedback->year,
        ]);
        $supervisorAverageData = new SupervisorAverageData();
        $averageData = $supervisorAverageData->getSupervisorAverageData($request);

        return $averageData;
    }

    public function getComments($feedback_id)
    {
        $feedback = $this->getSupervisorFeedback($feedback_id);

        $comments = SaveFeedbackSupervisor::where('user_id', $feedback->user_id)
            ->where('month', $feedback->month)->where('year', $feedback->year)
            ->where('commentAdd', '!=', null)
            ->select('category_id', 'commentAdd')
            ->get();

        return $comments;
    }

    public function getCommentSelect($feedback_id)
    {
        $feedback = $this->getSupervisorFeedback($feedback_id);

        $commentSelect = SaveFeedbackSupervisor::query()
            ->Join('save_user_answers as b', 'save_supervisor_feedback.answer_id', '=', 'b.id')
            ->join('questions_supervisors_assessment as c', 'b.question_id', '=', 'c.id')
            ->join('category_questions_supervisors_assessment as d', 'c.category_id', '=', 'd.id')
            ->where('save_supervisor_feedback.user_id', $feedback->user_id)
            ->where('save_supervisor_feedback.month', $feedback->month)
            ->where('save_supervisor_feedback.year', $feedback->year)
            ->whereNotNull('save_supervisor_feedback.answer_id')
            ->select(
                'd.id',
                'd.description ',
                'save_supervisor_feedback.answer_id ',
                'b.answer_text'
            )
            ->get();

        return $commentSelect;
    }

    public function getUserData($feedback_id)
    {
        $feedback = $this->getSupervisorFeedback($feedback_id);
        $user = new UserData();
        return $user->getUserData($feedback->user_id);
    }

    public function getTotalAnswersForms($feedback_id)
    {

        $totalManagers = StatusFeedbackSupervisor::query()
            ->join('status_user_answers', function ($join) {
                $join->on('status_supervisor_feedback.user_id', '=', 'status_user_answers.supervisor')
                    ->on('status_supervisor_feedback.month', '=', 'status_user_answers.month')
                    ->on('status_supervisor_feedback.year', '=', 'status_user_answers.year');
            })
            ->where('status_supervisor_feedback.id', $feedback_id)
            ->select(
                DB::raw('COUNT(DISTINCT status_user_answers.user_id) AS total_supervisores')
            )->first();


        return $totalManagers;
    }

    public function getPercentAnswers($feedback_id)
    {
        $totalManagers = $this->getTotalAnswersForms($feedback_id);

        $results = StatusFeedbackSupervisor::query()
            ->join('status_user_answers as b', function ($join) {
                $join->on('status_supervisor_feedback.user_id', '=', 'b.supervisor')
                    ->on('status_supervisor_feedback.month', '=', 'b.month')
                    ->on('status_supervisor_feedback.year', '=', 'b.year');
            })
            ->join('save_user_answers as c', function ($join) {
                $join->on('b.user_id', '=', 'c.user_id')
                    ->on('b.created_at', '=', 'c.created_at')
                    ->whereNotNull('c.answer_id');
            })
            ->join('questions_supervisors_assessment as qsa', 'c.question_id', '=', 'qsa.id')
            ->join('category_questions_supervisors_assessment as cqsa', 'qsa.category_id', '=', 'cqsa.id')
            ->join('answers_supervisors_assessment as asa', 'c.answer_id', '=', 'asa.id')
            ->select(
                'cqsa.id as category_id',
                'cqsa.description as category_description',
                'qsa.id as question_id',
                'qsa.description as question_description',
                'c.answer_id',
                'asa.description as answer_description',
                DB::raw('COUNT(DISTINCT c.user_id) AS total_respostas'),
                DB::raw('CONVERT(NUMERIC(15,2),(COUNT(DISTINCT c.user_id) * 100.00) / ' . $totalManagers->total_supervisores . ' )  AS porcentagem')
            )
            ->where('status_supervisor_feedback.id', $feedback_id)
            ->groupBy('cqsa.id', 'cqsa.description', 'c.answer_id', 'asa.description', 'qsa.id', 'qsa.description')
            ->get();

        return $results;
    }

    public function getConclusion($feedback_id)
    {
        $feedback = $this->getSupervisorFeedback($feedback_id);
        $conclusion = SaveFeedbackSupervisor::query()
            ->where('user_id', $feedback->user_id)
            ->where('month', $feedback->month)
            ->where('year', $feedback->year)
            ->whereNotNull('conclusion')
            ->select('conclusion')
            ->first();

        return $conclusion;
    }

    public function getPositivePoints($feedback_id)
    {
        $feedback = $this->getSupervisorFeedback($feedback_id);
        $positivePoints = SaveFeedbackSupervisor::query()
            ->where('user_id', $feedback->user_id)
            ->where('month', $feedback->month)
            ->where('year', $feedback->year)
            ->whereNotNull('positivePoints')
            ->select('positivePoints')
            ->get();

        return $positivePoints;
    }

    public function getpointsToImprove($feedback_id)
    {
        $feedback = $this->getSupervisorFeedback($feedback_id);
        $pointsToImprove = SaveFeedbackSupervisor::query()
            ->where('user_id', $feedback->user_id)
            ->where('month', $feedback->month)
            ->where('year', $feedback->year)
            ->whereNotNull('pointsToImprove')
            ->select('pointsToImprove')
            ->get();

        return $pointsToImprove;
    }

    public function getRecomendations($feedback_id)
    {
        $feedback = $this->getSupervisorFeedback($feedback_id);
        $recomendation = SaveFeedbackSupervisor::query()
            ->where('user_id', $feedback->user_id)
            ->where('month', $feedback->month)
            ->where('year', $feedback->year)
            ->whereNotNull('recomendation')
            ->select('recomendation')
            ->get();

        return $recomendation;
    }

    public function getDataStructure($feedback_id)
    {
        $base = $this->getPercentAnswers($feedback_id);
        $comments = $this->getComments($feedback_id);
        $commentSelect = $this->getCommentSelect($feedback_id);
        $structuredData = [];

        // Adiciona as questões e respostas ao array estruturado
        foreach ($base as $item) {
            $categoryId = $item->category_id;
            $categoryDescription = $item->category_description;
            $questionDescription = $item->question_description;
            $answerDescription = $item->answer_description;
            $porcentagem = $item->porcentagem;

            // Inicializa a categoria se não existir
            if (!isset($structuredData[$categoryId])) {
                $structuredData[$categoryId] = [
                    'category_description' => $categoryDescription,
                    'questions' => [],
                    'comments' => [],
                    'commentSelect' => []
                ];
            }

            // Inicializa a questão se não existir
            if (!isset($structuredData[$categoryId]['questions'][$questionDescription])) {
                $structuredData[$categoryId]['questions'][$questionDescription] = [];
            }

            // Adiciona a resposta à questão
            $structuredData[$categoryId]['questions'][$questionDescription][] = [
                'answer_description' => $answerDescription,
                'porcentagem' => $porcentagem
            ];
        }

        // Adiciona os comentários ao array estruturado
        foreach ($comments as $comment) {
            $categoryId = $comment->category_id;
            $commentText = $comment->commentAdd;

            if (isset($structuredData[$categoryId])) {
                $structuredData[$categoryId]['comments'][] = $commentText;
            }
        }

        // Adiciona apenas os textos das respostas ao `commentSelect`
        foreach ($commentSelect as $comment) {
            $categoryId = $comment->id;

            if (isset($structuredData[$categoryId])) {
                $structuredData[$categoryId]['commentSelect'][] = $comment->answer_text;
            }
        }


        return $structuredData;
    }
}
