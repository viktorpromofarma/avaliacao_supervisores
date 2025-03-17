<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaveFeedbackSupervisor;
use App\Models\StatusFeedbackSupervisor;

class SaveApplyFeedback extends Controller
{
    public function store(Request $request)
    {



        $saveFeedback =   $this->saveStatuSupervisor($request);
        if ($saveFeedback) {
            return redirect()->route('admin.generate_feedback')->with('success', 'Feedback enviado com sucesso!');
        } else {
            return redirect()->route('admin.generate_feedback')->with('error', 'Feedback não foi realizado, nenhum comentário foi realizado!');
        }
    }

    private function getCommonData(Request $request)
    {
        return [
            'user_id' => $request->user_id,
            'month' => $request->month,
            'year' => $request->year,
            'date' => date('d-m-Y')
        ];
    }

    public function getCommentsAdd(Request $request)
    {
        $dados = $request->all();

        $comentarios = $dados['comentarios'] ?? [];
        if (!is_array($comentarios)) {
            return false;
        }
        $subarrays = array_filter($comentarios, fn($item) => is_array($item));
        return !empty($subarrays) ? $subarrays : false;
    }

    public function getCommentsAnswers(Request $request)
    {
        $dados = $request->all();
        $comentarios = $dados['comentarios'] ?? [];

        if (!is_array($comentarios)) {
            return false;
        }

        $dados_filtrados = array_filter($comentarios, fn($item) => !is_array($item));
        return !empty($dados_filtrados) ? $dados_filtrados : false;
    }

    public function getPositivesPoints(Request $request)
    {
        $dados = $request->all();

        $pontosPositivos = $dados['pontosPositivos'] ?? [];
        if (!is_array($pontosPositivos)) {
            return false;
        }

        return !empty($pontosPositivos) ? $pontosPositivos : false;
    }

    public function getImprovePoints(Request $request)
    {
        $dados = $request->all();

        $pontosMelhorar = $dados['pontosMelhorar'] ?? [];
        if (!is_array($pontosMelhorar)) {
            return false;
        }

        return !empty($pontosMelhorar) ? $pontosMelhorar : false;
    }

    public function getRecomendation(Request $request)
    {
        $dados = $request->all();

        $pontosRecomendacoes = $dados['pontosRecomendacoes'] ?? [];
        if (!is_array($pontosRecomendacoes)) {
            return false;
        }

        return !empty($pontosRecomendacoes) ? $pontosRecomendacoes : false;
    }

    public function getConclusion(Request $request)
    {

        $conclusion = $request->conclusao;
        return !empty($conclusion) ? $conclusion : false;
    }


    public function saveCommentAdd(Request $request)
    {
        $commentsAdd = $this->getCommentsAdd($request);
        $commonData = $this->getCommonData($request);

        try {
            foreach ($commentsAdd as $category_id => $comments) {
                foreach ($comments as $comment) {
                    SaveFeedbackSupervisor::create([
                        'user_id' => $commonData['user_id'],
                        'created_at' => $commonData['date'],
                        'month' => $commonData['month'],
                        'year' => $commonData['year'],
                        'category_id' => $category_id,
                        'commentAdd' => $comment
                    ]);
                }
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function saveCommentAnswer(Request $request)
    {
        $commentsAnswers = $this->getCommentsAnswers($request);
        $commonData = $this->getCommonData($request);

        try {
            foreach (array_keys($commentsAnswers) as $answer_id) {
                SaveFeedbackSupervisor::create([
                    'user_id' => $commonData['user_id'],
                    'created_at' => $commonData['date'],
                    'month' => $commonData['month'],
                    'year' => $commonData['year'],
                    'answer_id' => (int) $answer_id
                ]);
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function savePositivesPoints(Request $request)
    {
        $positivePoints = $this->getPositivesPoints($request);
        $commonData = $this->getCommonData($request);

        try {
            foreach ($positivePoints as $positivePoint) {
                SaveFeedbackSupervisor::create([
                    'user_id' => $commonData['user_id'],
                    'created_at' => $commonData['date'],
                    'month' => $commonData['month'],
                    'year' => $commonData['year'],
                    'positivePoints' => $positivePoint
                ]);
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function saveRecomendation(Request $request)
    {
        $recomendation = $this->getRecomendation($request);
        $commonData = $this->getCommonData($request);

        try {
            foreach ($recomendation as $recomendation) {
                SaveFeedbackSupervisor::create([
                    'user_id' => $commonData['user_id'],
                    'created_at' => $commonData['date'],
                    'month' => $commonData['month'],
                    'year' => $commonData['year'],
                    'recomendation' => $recomendation
                ]);
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function saveConclusion(Request $request)
    {
        $conclusion = $this->getConclusion($request);
        $commonData = $this->getCommonData($request);

        try {

            SaveFeedbackSupervisor::create([
                'user_id' => $commonData['user_id'],
                'created_at' => $commonData['date'],
                'month' => $commonData['month'],
                'year' => $commonData['year'],
                'conclusion' => $conclusion
            ]);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function saveImprovePoints(Request $request)
    {
        $ImprovePoints = $this->getImprovePoints($request);
        $commonData = $this->getCommonData($request);

        try {
            foreach ($ImprovePoints as $ImprovePoint) {
                SaveFeedbackSupervisor::create([
                    'user_id' => $commonData['user_id'],
                    'created_at' => $commonData['date'],
                    'month' => $commonData['month'],
                    'year' => $commonData['year'],
                    'pointsToImprove' => $ImprovePoint
                ]);
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


    public function saveStatuSupervisor(Request $request)
    {

        $commonData = $this->getCommonData($request);
        $commentsAnswers = $this->saveCommentAnswer($request);
        $commentsAdd = $this->saveCommentAdd($request);
        $positivePoints = $this->savePositivesPoints($request);
        $ImprovePoints = $this->saveImprovePoints($request);
        $recomendation  = $this->saveRecomendation($request);
        $conclusion = $this->saveConclusion($request);

        if (!$commentsAnswers && !$commentsAdd && !$positivePoints && !$ImprovePoints && !$recomendation && !$conclusion) {
            return false;
        } else {
            try {
                StatusFeedbackSupervisor::create([
                    'user_id' => $commonData['user_id'],
                    'month' => $commonData['month'],
                    'year' => $commonData['year'],
                    'created_at' => date('d-m-Y')
                ]);
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }
}
