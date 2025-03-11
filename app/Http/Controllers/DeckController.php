<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use App\Traits\HandleImageTrait;

class DeckController extends Controller
{
    use HandleImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();

            // Kiểm tra trường filteredByUser, nếu không có thì mặc định là false
            $filteredByUser = $request->has('filteredByUser') ? (bool)$request->filteredByUser : false;

            if ($filteredByUser == true) {
                // Trường hợp 1: Chỉ lấy các bộ thẻ của user
                $decks = $user->decks;
            } else {
                // Trường hợp 2: Lấy các bộ thẻ của user và các bộ thẻ có isSuperUser là true
                $decks = Deck::where(function ($query) use ($user) {
                    $query->where('userId', $user->id)
                        ->orWhere('isSuperUser', true);
                })->get();
            }

            return response()->json([
                'message' => 'Truy xuất danh sách bộ thẻ thành công',
                'decks' => $decks
            ]);
        } catch (Exception $e) {
            Log::error('Lỗi truy xuất danh sách bộ thẻ: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi truy xuất danh sách bộ thẻ: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $imageBgPath = null;
            if ($request->hasFile('imageBgFile')) {
                Log::info('DeckController - store() - file imageBg: ' . $request->file('imageBgFile'));
                $imageBgPath = $this->uploadImage($request->file('imageBgFile'), 'images/decks');
            }

            $deck = $request->user()->decks()->create([
                'title' => $request->title,
                'type' => $request->type ?? null,
                'imageBg' => $imageBgPath ?? $request->imageBg ?? null,
                'isFavorite' => $request->isFavorite ? filter_var($request->input('isFavorite'), FILTER_VALIDATE_BOOLEAN) : false, //Chuyển đổi kiểu dữ liệu của isFavorite (nếu có)
                'isSuperUser' => $request->isSuperUser ? filter_var($request->input('isSuperUser'), FILTER_VALIDATE_BOOLEAN) : false, //Chuyển đổi kiểu dữ liệu của isSuperUser (nếu có)
            ]);

            return response()->json([
                'message' => 'Tạo mới bộ thẻ thành công',
                'deck' => $deck
            ], 201);
        } catch (Exception $e) {
            Log::error('Lỗi tạo mới bộ thẻ: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi tạo mới bộ thẻ: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $deck = Deck::findOrFail($id);
            $this->authorize('view', $deck); //Kiểm tra xem người dùng có quyền xem bộ thẻ này không (bộ thẻ của user hoặc bộ thẻ có isSuperUser=true)

            // $deck->load('flashcards'); //Tải các flashcards của bộ thẻ này

            return response()->json([
                'message' => 'Truy xuất bộ thẻ thành công',
                'deck' => $deck
            ]);
        } catch (Exception $e) {
            Log::error('Lỗi truy xuất bộ thẻ: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi truy xuất bộ thẻ: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Log::info('DeckController - update() - request: ');
        Log::info($request->all());

        try {
            $deck = Deck::findOrFail($id);
            $this->authorize('update', $deck); //Kiểm tra xem người dùng có quyền cập nhật bộ thẻ này không (bộ thẻ của user)
            
            $data = $request->all();

            if ($request->hasFile('imageBgFile')) {
                // Delete the old image if it exists
                if ($deck->imageBg) {
                    $this->deleteImage($deck->imageBg);
                }

                // Upload the new image
                Log::info('DeckController - update() - file imageBg: ' . $request->file('imageBgFile'));
                $imageBgPath = $this->uploadImage($request->file('imageBgFile'), 'images/decks');
                $data['imageBg'] = $imageBgPath;
            }

            // Chuyển đổi kiểu dữ liệu của isFavorite (nếu có)
            if ($request->has('isFavorite')) {
                $data['isFavorite'] = filter_var($request->input('isFavorite'), FILTER_VALIDATE_BOOLEAN);
            }
            
            // Chuyển đổi kiểu dữ liệu của isSuperUser (nếu có)
            if ($request->has('isSuperUser')) {
                $data['isSuperUser'] = filter_var($request->input('isSuperUser'), FILTER_VALIDATE_BOOLEAN);
            }

            $deck->update($data);

            return response()->json([
                'message' => 'Cập nhật bộ thẻ thành công',
                'deck' => $deck
            ]);
        } catch (Exception $e) {
            Log::error('Lỗi cập nhật bộ thẻ: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi cập nhật bộ thẻ: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $deck = Deck::findOrFail($id);
            $this->authorize('delete', $deck); //Kiểm tra xem người dùng có quyền xóa bộ thẻ này không (bộ thẻ của user)

            if ($deck->imageBg) {
                $this->deleteImage($deck->imageBg);
            }

            $deck->delete();

            return response()->json([
                'message' => 'Xóa bộ thẻ thành công',
                // 'deck' => $deck
            ], 200);
        } catch (Exception $e) {
            Log::error('Lỗi xóa bộ thẻ: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi xóa bộ thẻ: ' . $e->getMessage()
            ], 400);
        }
    }
}
