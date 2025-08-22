<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    /**
     * Obtiene todas las categorías
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Obtener todas las categorías ordenadas por nombre
        try {
            $categorias = Categoria::orderBy('nombre', 'asc')->get();
            
            return response()->json([
                'success' => true,
                'data' => $categorias,
                'message' => 'Categorías obtenidas exitosamente'
            ], 200);
            
        } catch (\Exception $excepcion) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las categorías: ' . $excepcion->getMessage()
            ], 500);
        }
    }

    /**
     * Almacena una nueva categoría
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $datosValidados = $request->validate([
                'nombre' => 'required|string|max:100|unique:categorias,nombre'
            ], [
                'nombre.required' => 'El nombre de la categoría es obligatorio',
                'nombre.max' => 'El nombre no puede exceder los 100 caracteres',
                'nombre.unique' => 'El nombre de la categoría ya existe'
            ]);

            $categoria = Categoria::create($datosValidados);

            return response()->json([
                'success' => true,
                'data' => $categoria,
                'message' => 'Categoría creada exitosamente'
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $excepcionValidacion) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $excepcionValidacion->errors()
            ], 422);
            
        } catch (\Exception $excepcion) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la categoría: ' . $excepcion->getMessage()
            ], 500);
        }
    }
}