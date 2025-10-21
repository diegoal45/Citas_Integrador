<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Http\Requests\CreateNotificationsRequest;
use App\Http\Requests\UpdateNotificactionsRequest;
use App\Http\Requests\UpdateNotificationsRequest;
use App\Models\Notifications;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $notifications = Notifications::all();

            return response()->json([
                'Notificaciones' => $notifications,
            ]);

        } catch(Exception $e) {
            return response()->json([
                'error' => 'Error al obtener notificaciones: ' . $e->getMessage()
            ], 500);
        }   
    }

    public function show($id): JsonResponse
    {
        try {
            // Buscar la notificación por su ID
            $notification = Notifications::findOrFail($id);

            // Devolver la notificación encontrada en formato JSON
            return response()->json([
                'Notificacion' => $notification,
            ]);

        } catch (ModelNotFoundException $e) {
            // Manejar la excepción si la notificación no existe
            return response()->json(['message' => 'La notificación no existe'], 404);

        } catch (Exception $e) {
            // Manejar cualquier otro error y devolver una respuesta de error
            return response()->json([
                'message' => 'Error al obtener la notificación: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(CreateNotificationsRequest $request): JsonResponse
    {
        try {
            if (!AuthHelper::isAdmin()) {
                return response()->json([
                    'message' => 'El usuario no es un administrador'   
                ], 403);
            }

            $data = $request->validated();

            // Crear una nueva notificación con los datos proporcionados
            $notification = Notifications::create([
                'id_user' => $data['id_user'],
                'type' => $data['type'],
                'title' => $data['title'],
                'message' => $data['message'],
                'notes' => $data['notes'],
            ]);

            return response()->json([
                'message' => 'Notificación registrada correctamente',
                'notificacion' => $notification
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();

            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al registrar la notificación: ' . $e->getMessage(),
                'errors' => $errors
            ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación

        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al registrar la notificación: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }

    public function update(UpdateNotificactionsRequest $request, $id): JsonResponse
    {
        try {
            if (!AuthHelper::isAdmin()) {
                return response()->json([
                    'message' => 'El usuario no es un administrador'   
                ], 403);
            }
            
            // Encuentra la notificación por su ID
            $notification = Notifications::findOrFail($id);

            $data = $request->validated();

            // Actualizar la notificación con los datos proporcionados
            $notification->update([
                'id_user' => $data['id_user'],
                'type' => $data['type'],
                'title' => $data['title'],
                'message' => $data['message'],
                'notes' => $data['notes'],
            ]);

            $notification->refresh();

            return response()->json([
                'message' => 'Notificación actualizada correctamente',
                'Notificacion' => $notification
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'La notificación no existe'], 404);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al actualizar la notificación: ' . $e->getMessage(),
                'errors' => $errors
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la notificación: ' . $e->getMessage()
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

            // Encuentra la notificación por su ID
            $notification = Notifications::findOrFail($id);

            // Eliminar la notificación
            $notification->delete();

            return response()->json([
                'message' => 'Notificación eliminada correctamente'
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'La notificación no existe'], 404);

        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al eliminar la notificación: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }

    public function getUserNotifications($userId): JsonResponse
    {
        try {
            $notifications = Notifications::where('id_user', $userId)->get();

            return response()->json([
                'Notificaciones' => $notifications,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener notificaciones del usuario: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getNotificationsByType($type): JsonResponse
    {
        try {
            $notifications = Notifications::where('type', $type)->get();

            return response()->json([
                'Notificaciones' => $notifications,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener notificaciones por tipo: ' . $e->getMessage()
            ], 500);
        }
    }
}