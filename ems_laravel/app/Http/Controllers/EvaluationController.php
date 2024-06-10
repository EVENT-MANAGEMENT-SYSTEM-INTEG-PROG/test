<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEvaluationRequest;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(Evaluation::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluationRequest $request)
    {
        try {

            $createdEvaluation = Evaluation::create($request->all());

            return response($createdEvaluation, 200);
        } catch (\Throwable $th) {
            return response(["message"=>$th->getMessage()], 400);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation, string $id)
    {
        try {
            $evaluationDetails = $evaluation->find($id);

            if($evaluationDetails) {
                return response($evaluationDetails, 200);
            }
            else {
                return response(["message"=>"Evaluation no found"], 404);
            }
        } catch (\Throwable $th) {
            return response(["message"=>$th->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEvaluationRequest $request, Evaluation $evaluation, string $id)
    {
        try {
            $evaluationDetails = $evaluation->find($id);

            if (! $evaluationDetails) {
                return response(["message" => "Evaluation not found"]);
            }

            else {
                $evaluationDetails->update(
                    $request->validated()
                );
            }
            return response(["message" => $evaluationDetails], 200);

            
        } catch (\Throwable $th) {
            return response(["message"=>$th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation, string $id)
    {
        try {
            $result = $evaluation->findOrFail($id);

            if(! $result) {
                return response(["message" => "Evaluation not found"]);
            }

            else {
                $result->delete();
            }
            
            return response(["message" => "Evaluation has been deleted"]);
        } catch (\Throwable $th) {
            return response(["message"=>$th->getMessage()], 400);
        }
    }
}
