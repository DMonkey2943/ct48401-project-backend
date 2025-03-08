<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array(
                'id' => 'd1',
                'title' => 'Nấm độc tại rừng quốc gia Việt Nam',
                'type' => 'Sinh học',
                'imageBg' => 'images/decks/deck-nam.png',
                'userId' => 'u1',
                'isSuperUser' => false,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'd2',
                'title' => 'Các thuyết vật lý lượng tử',
                'type' => 'Vật lý',
                'imageBg' => 'images/decks/deck-thuyetvatlyluongtu.jpg',
                'userId' => null,
                'isSuperUser' => true,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'd3',
                'title' => 'Các loại chim trong sách đỏ Việt Nam',
                'type' => 'Sinh học',
                'imageBg' => 'images/decks/deck-chim.jpg',
                'userId' => 'u1',
                'isSuperUser' => false,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'd4',
                'title' => 'Đất hiếm',
                'type' => 'Hóa học',
                'imageBg' => 'images/decks/deck-dathiem.jpg',
                'userId' => null,
                'isSuperUser' => true,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'd5',
                'title' => 'Tổng thống Hoa Kỳ',
                'type' => 'Lịch sử',
                'imageBg' => 'images/decks/deck-tongthonghoaky.jpg',
                'userId' => 'u1',
                'isSuperUser' => false,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
        );

        DB::table('decks')->insert($data);
    }
}
