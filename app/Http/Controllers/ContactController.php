<?php

namespace App\Http\Controllers;

use App\Models\HireDesignerMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index()
    {
        return view('site.contact-us.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'message' => 'required|min:2',
        ]);

        $message = HireDesignerMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => $message ? true : false
        ]);
    }
}
