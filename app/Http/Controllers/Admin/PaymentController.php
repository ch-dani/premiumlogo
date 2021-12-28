<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Helpers\Translate;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $payments = Payment::orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            if (!is_null($request->search['value'])) {
                $payments->where(function ($query) use ($request) {
                    foreach ($request->columns as $column) {
                        if ($column["searchable"] == "true") {
                            $query->orWhere($column["data"], 'like', '%' . $request->search['value'] . '%');
                        }
                    }
                });
            }

            $recordsFiltered = $payments->count();
            $payments->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($payments->get() as $payment) {
                $data[] = [
                    'id' => $payment->id,
                    'user' => '<a href="' . route('admin.users.edit', $payment->user->id) . '">' . $payment->user->name . '</a>',
                    'email' => $payment->user->email,
                    'price' => ($payment->amount / 100) . ' ' . strtoupper($payment->currency),
                    'type' => ucfirst($payment->type),
                    'paymentId' => $payment->paymentId,
                    'payment' => '<a href="' . route('admin.logo-prices.edit', $payment->logo_price_id) . '">' . Translate::t($payment->logoPrice->title) . '</a>',
                    'created_at' => Carbon::parse($payment->created_at)->format('d/m/Y H:i'),
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => Payment::count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('admin.payments.index');
        }
    }
}
