<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('products')->insert([
        [
            'ProductName' => 'Bơ sữa phô mai tươi',
            'Description' => 'Bơ sáp Đắk Lắk dẻo quẹo hòa quyện lớp foam phô mai tươi mềm mịn. Thêm chút Trà Sữa Oolong Tứ Quý đượm hương càng dậy vị trái cây tươi mát. Khuấy đều để thưởng trọn vị sảng khoái. ',
            'Price' => 55000,
            'CategoryID' => 2,
            'Stock' => 1,
            'ImageURL' => 'main_product1.jpg',
        ],

        [
            'ProductName' => 'Dâu phô mai tươi',
            'Description' => 'Dâu tây Đà Lạt chín mọng hòa quyện lớp foam phô mai tươi mềm mịn. Thêm chút Trà Oolong Tứ Quý đượm hương và thạch kim quất mềm tan càng dậy vị trái cây tươi mát. Khuấy đều để thưởng trọn vị sảng khoái.',
            'Price' => 55000,
            'CategoryID' => 2,
            'Stock' => 1,
            'ImageURL' => 'main_product2.jpg',
        ],
        [
            'ProductName' => 'Hi Tea Vải',
            'Description' => 'Chút ngọt ngào của Vải, mix cùng vị chua thanh tao từ trà hoa Hibiscus, mang đến cho bạn thức uống đúng chuẩn vừa ngon, vừa healthy.',
            'Price' => 49000,
            'CategoryID' => 3,
            'Stock' => 1,
            'ImageURL' => 'main_product3.jpg',
        ],
        [
            'ProductName' => 'Cà phê sữa đá',
            'Description' => 'Cà phê Đắk Lắk nguyên chất được pha phin truyền thống kết hợp với sữa đặc tạo nên hương vị đậm đà, hài hòa giữa vị ngọt đầu lưỡi và vị đắng thanh thoát nơi hậu vị.',
            'Price' => 29000,
            'CategoryID' => 1,
            'Stock' => 1,
            'ImageURL' => 'main_product4.jpg',
        ],
        [
            'ProductName' => 'Mochi Kem Chocolate',
            'Description' => 'Bao bọc bởi lớp vỏ Mochi dẻo thơm, bên trong là lớp kem lạnh cùng nhân chocolate độc đáo. Gọi 1 chiếc Mochi cho ngày thật tươi mát. Sản phẩm phải bảo quán mát và dùng ngon nhất trong 2h sau khi nhận hàng.',
            'Price' => 19000,
            'CategoryID' => 7,
            'Stock' => 1,
            'ImageURL' => 'main_product6.webp',
        ], 
        ]);
    }
}
