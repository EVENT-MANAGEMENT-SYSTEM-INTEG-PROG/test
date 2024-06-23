<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use App\Http\Requests\BudgetStoreRequest;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(Budget::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BudgetStoreRequest $request)
    {
        try {
            $createBudget = Budget::create($request->all());

            return response($createBudget, 201);
        } catch (\Throwable $th) {
            return response(["message"=>$th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $budgetDetails = Budget::find($id);

            if ($budgetDetails) {
                return response($budgetDetails, 200);
            } else {
                return response(["message"=>"Budget not found"], 404);
            }
        } catch (\Throwable $th) {
            return response(["message"=>$th->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BudgetStoreRequest $request, string $id)
    {
        try {
            $budgetDetails = Budget::find($id);

            if (!$budgetDetails) {
                return response(["message"=>"Budget not found"], 404);
            } else {
                $budgetDetails->update(
                    $request->validated()
                );
            }

            return response(["message" => $budgetDetails], 200);
        } catch (\Throwable $th) {
            return response(["message"=>$th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $result = Budget::findOrFail($id);

            if (!$result) {
                return response(["message" => "Budget not found", 404]);
            } else {
                $result->delete();
            }

            return response(["message" => "Budget has been delete successfully"], 200);
        } catch (\Throwable $th) {
            return response(["message"=>$th->getMessage()], 400);
        }
    }
}
