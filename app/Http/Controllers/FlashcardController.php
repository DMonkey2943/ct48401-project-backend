<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\Flashcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\HandleImageTrait;

class FlashcardController extends Controller
{
    use HandleImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index($deckId)
    {
        $deck = Deck::findOrFail($deckId);
        $this->authorize('view', $deck);

        try {
            $flashcards = $deck->flashcards;

            return response()->json([
                'message' => 'Truy xuất danh sách flashcards thành công',
                'flashcards' => $flashcards
            ]);
        } catch (Exception $e) {
            Log::error('Lỗi truy xuất danh sách flashcards: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi truy xuất danh sách flashcards: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $deckId)
    {
        $deck = Deck::findOrFail($deckId);
        $this->authorize('update', $deck);

        Log::info('FlashcardController - store() start: ' . $request->hasFile('imageFile'));
        Log::info($request->all());

        try {
            $imagePath = null;
            if ($request->hasFile('imageFile')) {
                Log::info('FlashcardController - store() - file imageUrl: ' . $request->file('imageFile'));
                $imagePath = $this->uploadImage($request->file('imageFile'), 'images/flashcards');
                Log::info('$imagePath = ' . $imagePath);
            }

            $flashcard = $deck->flashcards()->create([
                'text' => $request->text,
                'imgUrl' => $imagePath ?? $request->imgUrl ?? null,
                'description' => $request->description ?? '',
                'language' => $request->language,
                'isMarked' => $request->isMarked ? filter_var($request->input('isMarked'), FILTER_VALIDATE_BOOLEAN) : false, //Chuyển đổi kiểu dữ liệu của isMarked (nếu có)
            ]);

            return response()->json([
                'message' => 'Tạo mới flashcard thành công',
                'flashcard' => $flashcard
            ], 201);
        } catch (Exception $e) {
            Log::error('Lỗi tạo mới flashcard: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi tạo mới flashcard: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($deckId, $flashcardId)
    {
        $deck = Deck::findOrFail($deckId);
        $this->authorize('view', $deck);

        try {
            $flashcard = Flashcard::findOrFail($flashcardId);

            if ($flashcard->deckId !== $deck->id) {
                return response()->json([
                    'message' => 'Flashcard không tồn tại trong bộ thẻ này'
                ], 404);
            }

            return response()->json([
                'message' => 'Truy xuất flashcard thành công',
                'flashcard' => $flashcard
            ]);
        } catch (Exception $e) {
            Log::error('Lỗi truy xuất flashcard: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi truy xuất flashcard: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $deckId, $flashcardId)
    {
        $deck = Deck::findOrFail($deckId);
        $this->authorize('view', $deck);

        try {
            $flashcard = Flashcard::findOrFail($flashcardId);

            if ($flashcard->deckId !== $deck->id) {
                return response()->json([
                    'message' => 'Flashcard không tồn tại trong bộ thẻ này'
                ], 404);
            }

            $data = $request->all();

            if ($request->hasFile('imageFile')) {
                if ($flashcard->imgUrl) {
                    $this->deleteImage($flashcard->imgUrl);
                }

                $imagePath = $this->uploadImage($request->file('imageFile'), 'images/flashcards');
                $data['imgUrl'] = $imagePath;
            }

            // Chuyển đổi kiểu dữ liệu của isMarked (nếu có)
            if ($request->has('isMarked')) {
                $data['isMarked'] = filter_var($request->input('isMarked'), FILTER_VALIDATE_BOOLEAN);
            }

            $flashcard->update($data);

            return response()->json([
                'message' => 'Cập nhật flashcard thành công',
                'flashcard' => $flashcard
            ]);
        } catch (Exception $e) {
            Log::error('Lỗi cập nhật flashcard: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi cập nhật flashcard: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($deckId, $flashcardId)
    {
        $deck = Deck::findOrFail($deckId);
        $this->authorize('view', $deck);

        try {
            $flashcard = Flashcard::findOrFail($flashcardId);

            if ($flashcard->deckId !== $deck->id) {
                return response()->json([
                    'message' => 'Flashcard không tồn tại trong bộ thẻ này'
                ], 404);
            }

            if ($flashcard->imgUrl) {
                $this->deleteImage($flashcard->imgUrl);
            }

            $flashcard->delete();

            return response()->json([
                'message' => 'Xóa flashcard thành công',
                // 'flashcard' => $flashcard
            ], 200);
        } catch (Exception $e) {
            Log::error('Lỗi xóa flashcard: ' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return response()->json([
                'message' => 'Lỗi xóa flashcard: ' . $e->getMessage()
            ], 400);
        }
    }
}
