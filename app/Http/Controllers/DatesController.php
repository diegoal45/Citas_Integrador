<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Http\Requests\CreateDatesRequest;
use App\Http\Requests\UpdateDatesRequest;
use App\Models\Dates;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class DatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $dates = Dates::all();

            return response()->json([
                'Citas' => $dates,
            ]);

        } catch(Exception $e) {
            return response()->json([
                'error' => 'Error al obtener citas: ' . $e->getMessage()
            ], 500);
        }   
    }

    public function show($id): JsonResponse
    {
        try {
            // Buscar la cita por su ID
            $date = Dates::findOrFail($id);

            // Devolver la cita encontrada en formato JSON
            return response()->json([
                'Cita' => $date,
            ]);

        } catch (ModelNotFoundException $e) {
            // Manejar la excepción si la cita no existe
            return response()->json(['message' => 'La cita no existe'], 404);

        } catch (Exception $e) {
            // Manejar cualquier otro error y devolver una respuesta de error
            return response()->json([
                'message' => 'Error al obtener la cita: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(CreateDatesRequest $request): JsonResponse
    {
        try {
            if (!AuthHelper::isAdmin()) {
                return response()->json([
                    'message' => 'El usuario no es un administrador'   
                ], 403);
            }

            $data = $request->validated();

            // Crear una nueva cita con los datos proporcionados
            $date = Dates::create([
                'id_user' => $data['id_user'],
                'id_professional' => $data['id_professional'],
                'id_service' => $data['id_service'],
                'confirmation_code' => $data['confirmation_code'],
                'date' => $data['date'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'active' => $data['active'],
                'final_price' => $data['final_price'],
                'notes' => $data['notes'],
            ]);

            return response()->json([
                'message' => 'Cita registrada correctamente',
                'cita' => $date
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();

            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al registrar la cita: ' . $e->getMessage(),
                'errors' => $errors
            ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación

        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al registrar la cita: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }

    public function update(UpdateDatesRequest $request, $id): JsonResponse
    {
        try {
            if (!AuthHelper::isAdmin()) {
                return response()->json([
                    'message' => 'El usuario no es un administrador'   
                ], 403);
            }
            
            // Encuentra la cita por su ID
            $date = Dates::findOrFail($id);

            $data = $request->validated();

            // Actualizar la cita con los datos proporcionados
            $date->update([
                'id_user' => $data['id_user'],
                'id_professional' => $data['id_professional'],
                'id_service' => $data['id_service'],
                'confirmation_code' => $data['confirmation_code'],
                'date' => $data['date'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'active' => $data['active'],
                'final_price' => $data['final_price'],
                'notes' => $data['notes'],
            ]);

            $date->refresh();

            return response()->json([
                'message' => 'Cita actualizada correctamente',
                'Cita' => $date
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'La cita no existe'], 404);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al actualizar la cita: ' . $e->getMessage(),
                'errors' => $errors
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la cita: ' . $e->getMessage()
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

            // Encuentra la cita por su ID
            $date = Dates::findOrFail($id);

            // Eliminar la cita
            $date->delete();

            return response()->json([
                'message' => 'Cita eliminada correctamente'
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'La cita no existe'], 404);

        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al eliminar la cita: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }

    public function getUserDates($userId): JsonResponse
    {
        try {
            $dates = Dates::where('id_user', $userId)->get();

            return response()->json([
                'Citas' => $dates,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener citas del usuario: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getProfessionalDates($professionalId): JsonResponse
    {
        try {
            $dates = Dates::where('id_professional', $professionalId)->get();

            return response()->json([
                'Citas' => $dates,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener citas del profesional: ' . $e->getMessage()
            ], 500);
        }
    }
}