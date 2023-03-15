<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Rules\SecurePassword;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{

    /**
     * Registra a un nuevo usuario en la base de datos si cumple las validaciones especificadas.
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'min:2', 'max:20', 'not_regex:~\d+~'],
            'apellidos' => ['required', 'min:2', 'max:40', 'not_regex:~\d+~'],
            'dni' => ['required', 'regex:/^[0-9]{8}[A-Z]$/i'],
            'email' => ['required', 'email', 'unique:usuarios,email'],
            'password' => ['required', 'min:10', new SecurePassword],
            'password_confirmation' => ['required', 'same:password'],
            'telefono' => ['min:9', 'max:12', 'regex:/^\+?\d+$/'],
            'iban' => ['required', 'regex:/^[A-Z]{2}\d{22}$/'],
            'about' => ['min:20', 'max:250']
        ]);


        if ($validator->fails()) {
            return response(implode("\n",$validator->messages()->all()), 400);
        }

        try {
            $user = new Usuario([
                'nombre' => $request->get('nombre'),
                'apellidos' => $request->get('apellidos'),
                'dni' => $request->get('dni'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'iban' => $request->get('iban'),
            ]);

            if($request->has('telefono')) {
                $user->telefono = $request->get('telefono');
            }

            if($request->has('pais')) {
                $user->pais = $request->get('pais');
            }
            if($request->has('about')) {
                $user->about = $request->get('about');
            }

            $user->save();

            return response('Usuario registrado correctamente', 201);

        } catch (\Exception $e) {
            return response('Error interno', 500);
        }

    }

    /**
     * Realiza la operación de login verificando las creedenciales con las almacenadas en la base de datos.
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response(implode("\n",$validator->messages()->all()), 400);
        }

        try {
           $user = Usuario::getUserByEmail($request->get('email'));

            if($user && Hash::check($request->get('password'),$user->password)) {
                return response('Creedenciales correctas, acceso concedido', 200);
            } else {
                return response('Creedenciales incorrectas', 401);
            }

        } catch (\Exception $e) {
            return response('Error interno', 500);
        }
    }

}
