<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Http\Requests\CreateProfessionalsRequest;
use App\Http\Requests\UpdateProfessionalsRequest;
use App\Models\Professional;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ProfessionalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $professionals = Professional::all();

            return response()->json([
                'Profesionales' => $professionals,
            ]);

        } catch(Exception $e) {
            return response()->json([
                'error' => 'Error al obtener profesionales: ' . $e->getMessage()
            ], 500);
        }   
    }

    public function show($id): JsonResponse
    {
        try {
            // Buscar el profesional por su ID
            $professional = Professional::findOrFail($id);

            // Devolver el profesional encontrado en formato JSON
            return response()->json([
                'Profesional' => $professional,
            ]);

        } catch (ModelNotFoundException $e) {
            // Manejar la excepción si el profesional no existe
            return response()->json(['message' => 'El profesional no existe'], 404);

        } catch (Exception $e) {
            // Manejar cualquier otro error y devolver una respuesta de error
            return response()->json([
                'message' => 'Error al obtener el profesional: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(CreateProfessionalsRequest $request): JsonResponse
    {
        try {
            if (!AuthHelper::isAdmin()) {
                return response()->json([
                    'message' => 'El usuario no es un administrador'   
                ], 403);
            }

            $data = $request->validated();

            // Crear un nuevo profesional con los datos proporcionados
            $professional = Professional::create([
                'id_user' => $data['id_user'],
                'id_salon' => $data['id_salon'],
                'specialty' => $data['specialty'],
                'description' => $data['description'],
                'avatar' => $data['avatar'] ?? null,
                'active' => $data['active'],
            ]);

            return response()->json([
                'message' => 'Profesional registrado correctamente',
                'profesional' => $professional
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();

            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al registrar el profesional: ' . $e->getMessage(),
                'errors' => $errors
            ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación

        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al registrar el profesional: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }

    public function update(UpdateProfessionalsRequest $request, $id): JsonResponse
    {
        try {
            if (!AuthHelper::isAdmin()) {
                return response()->json([
                    'message' => 'El usuario no es un administrador'   
                ], 403);
            }
            
            // Encuentra el profesional por su ID
            $professional = Professional::findOrFail($id);

            $data = $request->validated();

            // Actualizar el profesional con los datos proporcionados
            $professional->update([
                'id_user' => $data['id_user'],
                'id_salon' => $data['id_salon'],
                'specialty' => $data['specialty'],
                'description' => $data['description'],
                'avatar' => $data['avatar'] ?? $professional->avatar,
                'active' => $data['active'],
            ]);

            $professional->refresh();

            return response()->json([
                'message' => 'Profesional actualizado correctamente',
                'Profesional' => $professional
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'El profesional no existe'], 404);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al actualizar el profesional: ' . $e->getMessage(),
                'errors' => $errors
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el profesional: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            if (!AuthHelper::isAdmin()) {
                return response()->json([
                    'message' => 'El usuario no es un administrador'   
                ], 403);
            }

            // Encuentra el profesional por su ID
            $professional = Professional::findOrFail($id);

            // Eliminar el profesional
            $professional->delete();

            return response()->json([
                'message' => 'Profesional eliminado correctamente'
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'El profesional no existe'], 404);

        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al eliminar el profesional: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }

    public function getSalonProfessionals($salonId): JsonResponse
    {
        try {
            $professionals = Professional::where('id_salon', $salonId)->get();

            return response()->json([
                'Profesionales' => $professionals,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener profesionales del salón: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getActiveProfessionals(): JsonResponse
    {
        try {
            $professionals = Professional::where('active', true)->get();

            return response()->json([
                'Profesionales' => $professionals,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener profesionales activos: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getUserProfessional($userId): JsonResponse
    {
        try {
            $professional = Professional::where('id_user', $userId)->first();

            if (!$professional) {
                return response()->json(['message' => 'No se encontró el profesional para este usuario'], 404);
            }

            return response()->json([
                'Profesional' => $professional,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener el profesional del usuario: ' . $e->getMessage()
            ], 500);
        }
    }
}