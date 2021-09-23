<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class JobController extends Controller
{
    protected $model;

    public function __construct(Job $job)
    {
        # code...
        $this->model = $job;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->allRelatedData());
    }

    /**
     * get all related jobs for property
     *
     * @return void
     */
    protected function allRelatedData()
    {
        # code...
        $data = $this->model->with(['user', 'property'])->get();
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\JobRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        //
        $request->validated();
        $data['summary'] = $request->get('summary');
        $data['description'] = $request->get('description');
        $data['status'] = 'open';
        try {
            DB::transaction(function () use ($data, $request) {
                $user = new User;
                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');
                $user->save();
                $job = $user->job()->create($data);
                $job->property()->create(['name' => $request->get('property_name')]);
            }
        );
        } catch (Exception $th) {
            //throw $th;
            throw $th;
            return response()->json(['errors' => $th->getMessage()], JsonResponse::HTTP_CONFLICT);
        }

        return response()->json(['sucess' => true], 200);

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
