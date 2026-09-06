<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FinancialTransaction;
use App\Services\FinancialTransaction\FinancialTransactionService;
use Illuminate\Http\Request;
use App\Http\Requests\FinancialTransactionRequest;
use Illuminate\Support\Facades\Log;
use Throwable;

class FinancialTransactionController extends Controller
{

    private $financialtransactionService = null;

    public function __construct(FinancialTransactionService $financialtransactionService)
    {
        $this->financialtransactionService = $financialtransactionService;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(FinancialTransactionRequest $request)
    {
        $data = $request->validated();

        try {
            $this->financialtransactionService->store($data);

            return response()->json([
                'message' => "O lançamento foi criado com sucesso"
            ], 201);
        } catch (Throwable $e) {
            Log::error('Erro ao cadastrar o lançamento: ' . $e->getMessage());

            return response()->json([
                'message' => 'Não foi possível concluir o cadastro. Tente novamente.',
            ], 500);
        }
    }

    public function show(FinancialTransaction $financialTransaction)
    {
        //
    }

    public function edit(FinancialTransaction $financialTransaction)
    {
        //
    }

    public function update(Request $request, FinancialTransaction $financialTransaction)
    {
        //
    }

    public function destroy(FinancialTransaction $financialTransaction)
    {
        //
    }
}
