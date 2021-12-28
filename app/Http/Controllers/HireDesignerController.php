<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HireDesignerMessage;
use App\Mail\AdminHireMessageNotification;
use Illuminate\Support\Facades\Mail;

class HireDesignerController extends Controller
{
    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index()
    {
        return view('site.hire-designer.index');
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function contact()
    {
        return view('site.hire-designer.form');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function hire(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'message' => 'required|min:2',
        ]);
        try {

            Mail::to('vladbabenko60@gmail.com')->send(new AdminHireMessageNotification($request->all()));

            HireDesignerMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
            ]);

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $exception) {

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
