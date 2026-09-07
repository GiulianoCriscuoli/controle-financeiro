<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FinancialTransaction;
use App\Services\FinancialTransaction\FinancialTransactionService;
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
        $financialTransaction = $this->financialtransactionService->all();

        return response()->json($financialTransaction, 200);
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

    public function update(FinancialTransactionRequest $request, FinancialTransaction $financialTransaction)
    {

        $data = $request->validated();
        $id = $financialTransaction->id;

        try {
            $financialTransaction = $this->financialtransactionService->update($id, $data);

            return response()->json([
                'message' => 'O lançamento foi atualizado com sucesso',
            ]);
        } catch (Throwable $e) {
            Log::error('Erro ao atualizar lançamento: ' . $e->getMessage());

            return response()->json([
                'message' => 'Não foi possível concluir a atualização. Tente novamente.',
            ], 500);
        }
    }

    public function destroy(FinancialTransaction $financialTransaction)
    {
        $id = $financialTransaction->id;

        try {
            $this->financialtransactionService->destroy($id);

            return response()->json([
                'message' => 'O lançamento foi excluído com sucesso',
            ]);
        } catch (Throwable $e) {
            Log::error('Erro ao excluir lançamento: ' . $e->getMessage());

            return response()->json([
                'message' => 'Não foi possível concluir a exclusão. Tente novamente.',
            ], 500);
        }
    }
}
