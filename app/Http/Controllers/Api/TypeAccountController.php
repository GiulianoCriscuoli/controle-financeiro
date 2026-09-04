<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TypeAccount;
use App\Http\Requests\TypeAccountRequest;
use App\Services\TypeAccount\TypeAccountService;
use Illuminate\Support\Facades\Log;
use Throwable;

class TypeAccountController extends Controller
{
       private $typeAccountService = null;

    public function __construct(TypeAccountService $typeAccountService)
    {
        $this->typeAccountService = $typeAccountService;
    }
    public function index()
    {
        // $typeAccounts = $this->typeAccountService->listTypeAccounts();
        // return response()->json($typeAccounts);
    }

    public function store(TypeAccountRequest $request)
    {
        $data = $request->validated();
        $userId = $request->user()->id;

        try {
            $typeAccount = $this->typeAccountService->store($data, $userId);

            $type = $typeAccount->type === 'C' ? 'cliente' : 'fornecedor';

            return response()->json([
                'message' => "O Cadastro de {$type} criado com sucesso",
                'type_account' => $typeAccount
            ], 201);
        } catch (Throwable $e) {
            Log::error('Erro ao cadastrar tipo de conta: ' . $e->getMessage());

            return response()->json([
                'message' => 'Não foi possível concluir o cadastro. Tente novamente.',
            ], 500);
        }
    }

    public function show(TypeAccount $typeAccount)
    {
        //
    }

    public function update(TypeAccountRequest $request, TypeAccount $typeAccount)
    {
        $data = $request->validated();
        $id = $typeAccount->id;

        try {
            $typeAccount = $this->typeAccountService->update($id, $data);

            return response()->json([
                'message' => 'O Tipo de conta atualizado com sucesso',
                'type_account' => $typeAccount
            ]);
        } catch (Throwable $e) {
            Log::error('Erro ao atualizar tipo de conta: ' . $e->getMessage());

            return response()->json([
                'message' => 'Não foi possível concluir a atualização. Tente novamente.',
            ], 500);
        }
    }

    public function destroy(TypeAccount $typeAccount)
    {
        //
    }
}
