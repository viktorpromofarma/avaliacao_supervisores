<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\StatusUserAnswers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Basic\UserData;
use Illuminate\Support\Facades\Auth;

class Evaluation_History extends Controller
{

    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }


    public function index(Request $request)
    {

        $filters = $request->only(['month', 'year', 'storeStart', 'storeEnd', 'manager', 'supervisor']);
        $statusUser = $this->getStatusUser($filters);

        return view('admin.evaluation_history', [
            'statusUser' => $statusUser,
            'user' => $this->user
        ]);
    }




    public function getStatusUser($filters = [])
    {



        $query = StatusUserAnswers::query()
            ->leftJoin('usuarios_avaliacao_supervisao as b', 'status_user_answers.user_id', '=', 'b.id')
            ->leftJoin('usuarios_avaliacao_supervisao as c', 'status_user_answers.supervisor', '=', 'c.id')
            ->select(
                'status_user_answers.month',
                'status_user_answers.year',
                'status_user_answers.store',
                'status_user_answers.user_id',
                'status_user_answers.supervisor',
                DB::raw("CONVERT(varchar(20), CAST(status_user_answers.created_at AS date), 103) as data_registro"),
                'status_user_answers.id',
                'b.display_name as manager_name',
                'b.seller as manager_seller',
                'c.display_name as supervisor_name',
                'c.seller as supervisor_register'
            );

        if (!empty($filters['month'])) {
            $query->where('status_user_answers.month', $filters['month']);
        }

        if (!empty($filters['year'])) {
            $query->where('status_user_answers.year', $filters['year']);
        }

        if (!empty($filters['storeStart']) && !empty($filters['storeEnd'])) {
            $query->whereBetween('status_user_answers.store', [$filters['storeStart'], $filters['storeEnd']]);
        } elseif (!empty($filters['storeStart'])) {
            $query->where('status_user_answers.store', '>=', $filters['storeStart']);
        } elseif (!empty($filters['storeEnd'])) {
            $query->where('status_user_answers.store', '<=', $filters['storeEnd']);
        }

        if (!empty($filters['manager'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('b.display_name', 'like', '%' . $filters['manager'] . '%')
                    ->orWhere('b.seller', 'like', '%' . $filters['manager'] . '%');
            });
        }

        if (!empty($filters['supervisor'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('c.display_name', 'like', '%' . $filters['supervisor'] . '%')
                    ->orWhere('c.seller', 'like', '%' . $filters['supervisor'] . '%');
            });
        }

        if (!$this->user->accessRole->admin) {
            $query->where('status_user_answers.user_id ', Auth::user()->id);
        }



        $query
            ->orderBy('status_user_answers.month', 'asc')
            ->orderBy('status_user_answers.year', 'asc');

        return $query->get();
    }
}
