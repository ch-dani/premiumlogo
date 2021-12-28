<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HireDesignerMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\HireDesignerAnswerMessage;

class HireDesignerMessageController extends Controller
{
    /**
     * @param Request $request
     * @return array|false|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index(Request $request)
    {
        $messages = HireDesignerMessage::all();
        $table_columns = HireDesignerMessage::$table_columns;

        if ($request->ajax()) {
            return $this->processForDataTable(
                $request,
                'HireDesignerMessage',
                'hire-designer-messages',
                [
                    'name' => ['name' => 'name', 'translatable' => false],
                    'email' => ['name' => 'email', 'translatable' => false],
                ]
            );
        }

        return view('admin.hire-designer-messages.index', ['messages' => $messages, 'table_columns' => $table_columns]);
    }


    /**
     * @param HireDesignerMessage $hire_designer_message
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function edit(HireDesignerMessage $hire_designer_message)
    {
        $HireDesignerMessage = $hire_designer_message;
        return view('admin.hire-designer-messages.edit', compact('HireDesignerMessage'));
    }

    /**
     * @param Request $request
     * @param HireDesignerMessage $hire_designer_message
     * @return mixed
     */
    public function update(Request $request, HireDesignerMessage $hire_designer_message)
    {
        $request->validate([
            'answer_message' => 'required'
        ]);

        try {
            Mail::to($hire_designer_message->email)->send(new HireDesignerAnswerMessage($request->answer_message));
            $hire_designer_message->update([
                'answered' => true,
                'answer_message' => $request->answer_message
            ]);
            return response()->json([
                'success' => true,
                'redirect' => route('admin.hire-designer-messages.index')
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

}
