<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FlashcardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array(
                'id' => 'f1',
                'text' => 'Nấm độc tán trắng',
                'imgUrl' => 'images/flashcards/fc-namdoctantrang.jpg',
                'description' => '10 loại nấm độc khi trekking xuyên rừng quốc gia Việt Nam. Các trekkers đã ít nhất một lần đến khám phá các khu rừng quốc gia Việt Nam sẽ bất ngờ với hệ sinh thái đa dạng nơi đây. Từ các loài hoa đến các loại quả, đều là những loại thực vật lần đầu tiên bạn nhìn thấy. Việc bắt gặp những loài hoa, thức quả rừng lạ có thể mang đến nhiều trải nghiệm và kiến thức mới lạ. Có thể đó là thứ bạn có thể dùng như một món ăn. Nhưng cũng có những loại thực vật bạn tuyệt đối không thể ăn, đặc biệt là nấm. Bài viết này sẽ giúp bạn hiểu rõ hơn về những loài nấm độc bạn có thể bắt gặp trên chặng đường trekking của mình.Nấm độc tán trắng Loại nấm này có tên khoa học là Amanita Verna. Bạn có thể bắt gặp loại nấm này mọc thành từng cụm hoặc đơn chiếc. Tại Việt Nam, bạn sẽ tìm thấy loài nấm tán trắng này ở các tỉnh phía Bắc như Hà Giang, Tuyên Quang, Thái Nguyên, Yên Bái, Bắc Cạn, Phú Thọ…',
                'language' => 'vi-VN',
                'isMarked' => false,
                'deckId' => 'd1',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'f2',
                'text' => 'Nấm phiến đốm chuông',
                'imgUrl' => 'images/flashcards/fc-namphiendomchuong.jpg',
                'description' => 'Mũ nấm hình chuông, đường kính từ 2 đến 3.5cm. Các phiến có vân, màu xanh rồi đen. Nấm có lớp thịt mỏng, màu da sơn dương.  Những chất độc gây ảo giác nằm ở phiến đốm chuông không mùi.  Bạn có thể tìm thấy nấm phiến đốm chuông trên phân hoại mục ở các bãi cỏ từ tháng 1 đến tháng 9 hằng năm.',
                'language' => 'vi-VN',
                'isMarked' => false,
                'deckId' => 'd1',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'f3',
                'text' => 'Superposition - Chồng chập lượng tử',
                'imgUrl' => 'images/flashcards/fc-f3',
                'description' => 'Ở tầng mức lượng tử, các nhà khoa học phát hiện ra rằng quỹ đạo di chuyển của các hạt này gần như không thể được nắm bắt, phỏng đoán một cách chính xác. Đối với vật lý cổ điển, thì việc này quả thực phi logic và khó có thể chấp nhận được.',
                'language' => 'vi-VN',
                'isMarked' => false,
                'deckId' => 'd2',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'f4',
                'text' => 'Quantum Entanglement - Vướng mắt lượng tử',
                'imgUrl' => null,
                'description' => '2 hạt (ví dụ: electron), dù ở cách xa nhau vô cùng (ví dụ: 1 hạt ở cực Bắc & 1 hạt ở cực Nam Trái Đất), thì một khi chúng ta tác động vào 1 electron bất kỳ trong cặp này, electron còn lại cũng sẽ ngay lập tức bị ảnh hưởng, mặc dù giữa chúng không có mối liên hệ rõ ràng nào. Cứ như thể các electron có khả năng tương tác, “trao đổi” thông tin từ xa với nhau vậy',
                'language' => 'vi-VN',
                'isMarked' => false,
                'deckId' => 'd2',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'f5',
                'text' => 'Bồ câu Nicoba',
                'imgUrl' => 'images/flashcards/fc-bocaunicoba.jpg',
                'description' => 'Bồ câu Nicoba (danh pháp hai phần: Caloenas nicobarica) là một loài bồ câu được tìm thấy tại các hòn đảo nhỏ và những vùng bờ biển tại quần đảo Nicobar, miền đông tới quần đảo Mã Lai, và đến Solomon và Palau. Nó hiện là thành viên duy nhất của chi Caloenas, và là họ hàng gần nhất còn tồn tại của chim dodo.',
                'language' => 'vi-VN',
                'isMarked' => false,
                'deckId' => 'd3',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'f6',
                'text' => 'Bồng chanh rừng',
                'imgUrl' => 'images/flashcards/fc-bongchangrung.jpg',
                'description' => 'Bồng chanh rừng (danh pháp hai phần: Alcedo hercules) là loài chim bói cá lớn nhất thuộc chi Alcedo, họ Bồng chanh. Bồng chanh rừng dài từ 22 đến 23 cm, có phần ngực và bụng xù xì với mảng ngực màu xanh đen, phần trên màu lam cobalt hoặc xanh da trời rực rỡ, nhuốm màu tím.',
                'language' => 'vi-VN',
                'isMarked' => false,
                'deckId' => 'd3',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'f7',
                'text' => 'Scandi',
                'imgUrl' => 'images/flashcards/fc-scandium.jpg',
                'description' => 'Scandi hay scandium là một nguyên tố hóa học trong bảng tuần hoàn có ký hiệu Sc và số nguyên tử bằng 21. Là một kim loại chuyển tiếp mềm, màu trắng bạc, scandi có trong các khoáng chất hiếm ở Scandinavia',
                'language' => 'en-US',
                'isMarked' => false,
                'deckId' => 'd4',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'f8',
                'text' => 'Ytri',
                'imgUrl' => 'images/flashcards/fc-ytti.png',
                'description' => 'Ytri là một nguyên tố hóa học có ký hiệu Y và số nguyên tử 39. Là một kim loại chuyển tiếp màu trắng bạc, ytri khá phổ biến trong các khoáng vật đất hiếm và hai trong số các hợp chất của nó được sử dụng làm lân quang màu đỏ trong các ống tia âm cực, chẳng hạn trong các ống dùng cho truyền hình.',
                'language' => 'en-US',
                'isMarked' => false,
                'deckId' => 'd4',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'f9',
                'text' => 'George Washington',
                'imgUrl' => 'images/flashcards/fc-f9.jpg',
                'description' => 'George Washington[c] (22 tháng 2 năm 1732 / 14 tháng 12 năm 1799) là một nhà lãnh đạo quân sự, chính khách người Mỹ, một trong những người lập quốc, tổng thống đầu tiên của Hoa Kỳ từ năm 1789 đến năm 1797',
                'language' => 'en-US',
                'isMarked' => false,
                'deckId' => 'd5',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
            array(
                'id' => 'f10',
                'text' => 'Thomas Jefferson',
                'imgUrl' => 'images/flashcards/fc-f10.png',
                'description' => 'Thomas Jefferson (13 tháng 4 năm 1743 / 4 tháng 7 năm 1826) là chính khách, nhà ngoại giao, luật sư, kiến trúc sư, nhà triết học người Mỹ. Ông là một trong các kiến quốc phụ của Hợp chúng quốc Hoa Kỳ và là tổng thống thứ 3 của Hợp Chúng Quốc Hoa Kỳ',
                'language' => 'en-US',
                'isMarked' => false,
                'deckId' => 'd5',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ),
        );

        DB::table('flashcards')->insert($data);
    }
}
