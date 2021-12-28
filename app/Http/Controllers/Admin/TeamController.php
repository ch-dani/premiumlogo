<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$Team = Team::all();

		if($request->ajax()){
//			$data = $this->processForDataTable($request, "Team", "team", ["name"=>['name'=>'name', 'translatable'=>true], "url"=>"url"]);
			$data = $this->processForDataTable($request, 'Team', 'team', ['fullName' => 'name']);

			return $data;
		}

		return view('admin.team.index', ["Team" => $Team, "table_columns" => Team::$table_columns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$Languages = Language::all();

		return view('admin.team.edit', compact('Languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$request->validate([
			'first_name' => 'required',
		]);

		$data = $request->except(['_token']);

		$data['first_name'] = json_encode($data['first_name']);
		$data['last_name'] = json_encode($data['last_name']);
		$data['position'] = json_encode($data['position']);

		try {
			$team = Team::create($data);

			return response()->json([
				'success' => true,
				'data' => $team,
				'message' => 'Team meber successfully added.',
				'redirect' => route('admin.team.index'),
			]);
		} catch (\Exception $exception) {
			return response()->json([
				'success' => false,
				'message' => $exception->getMessage()
			]);
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $Team)
    {
		$Languages = Language::all();

		return view('admin.team.edit', compact('Team', 'Languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $Team)
    {
		$request->validate([
			'first_name' => 'required',
		]);

		$data = $request->except(['_token']);

		$data['first_name'] = json_encode($data['first_name']);
		$data['last_name'] = json_encode($data['last_name']);
		$data['position'] = json_encode($data['position']);

		try {
			$Team->update($data);

			return response()->json([
				'success' => true,
				'data' => $Team,
				'message' => 'Team meber successfully updated.',
				'redirect' => route('admin.team.index'),
			]);
		} catch (\Exception $exception) {
			return response()->json([
				'success' => false,
				'message' => $exception->getMessage()
			]);
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
