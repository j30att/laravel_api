<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transactions\TransactionResourceGroupByDate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\BuilderHelpers;


class TransactionController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $filter = $request->get('filter');

        if ($user) {
            $transactions = $user->transactions()->with('sale');

            if (!empty($filter['date'])) {
                $to = Carbon::now();

                if ($filter['date'] == 1) {
                    $from = $to->copy()->subMonth();
                } elseif ($filter['date'] == 2) {
                    $from = $to->copy()->subYear();
                }

                if (isset($from)) {
                    $transactions->whereBetween('created_at', [$from, $to]);
                }
            }

            $transactions = $transactions->orderBy('created_at', 'desc')->get();

            return TransactionResourceGroupByDate::collection($transactions);
        }

        return response()->json([
            'error' => 'Not Authorized'
        ], 401);
    }
}