<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    /**
     * Register a new account.
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()
                ], 422);
            }

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'Đăng ký tài khoản thành công.'
            ], 201);
        } catch (Exception $e) {
            Log::error('Lỗi đăng ký tài khoản: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi đăng ký tài khoản: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Login and get access token
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Email hoặc mật khẩu không đúng'
                ], 401);
            }

            $user = Auth::user();
            
            // Create API token
            $token = $request->user()->createToken('auth')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'Đăng nhập thành công.'
            ]);
        } catch (Exception $e) {
            Log::error('Lỗi đăng nhập: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi đăng nhập: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get account's info
     */
    public function account(Request $request)
    {
        try {
            $user = Auth::user();

            if ($user) {
                return response()->json([
                    'user' => $user,
                    'message' => 'Lấy thông tin tài khoản thành công'
                ]);
            }

            return response()->json([
                'message' => 'Lỗi khi lấy thông tin tài khoản'
            ], 401);
        } catch (Exception $e) {
            Log::error('Lỗi khi lấy thông tin tài khoản: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi khi lấy thông tin tài khoản: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Logout and remove access token
     */
    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if ($user) {
                $user->currentAccessToken()->delete();
                return response()->json([
                    'message' => 'Đăng xuất thành công'
                ]);
            }

            return response()->json([
                'message' => 'Lỗi đăng xuất'
            ], 401);
        } catch (Exception $e) {
            Log::error('Lỗi đăng xuất: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi đăng xuất: ' . $e->getMessage()
            ], 400);
        }
    }
}
