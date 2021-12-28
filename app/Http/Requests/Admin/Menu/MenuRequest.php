<?php

	namespace App\Http\Requests\Admin\Menu;

	use App\Http\Requests\BaseRequest;
	use Illuminate\Validation\Rule;
	use Illuminate\Support\Facades\Auth;

	class MenuRequest extends BaseRequest
	{
		/**
		 * Determine if the user is authorized to make this request.
		 *
		 * @return bool
		 */
		public function authorize()
		{
//			return auth()->check();
			return Auth::guard('admin')->check();
		}

		/**
		 * Get the validation rules that apply to the request.
		 *
		 * @return array
		 */
		public function rules()
		{
			return [
//				'title' => ['required', 'string', 'max:255'],
				'title' => ['required'],
				'link' => ['required', 'max:255'],
				'code' => ['required', 'max:255']
			];
		}
	}
