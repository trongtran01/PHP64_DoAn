<?php

namespace Database\Seeders;

use App\Models\StoreRegion;
use Illuminate\Database\Seeder;

class StoreLocationSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Hồ Chí Minh', 'slug' => 'hcm', 'banner_image' => 'regions/hcm.jpg',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.497847148615!2d106.69803087576813!3d10.773130059253065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f611eda33fd%3A0x469b4bc8801a4aa8!2sLa%20Viet%20Coffee%20(Takashimaya)!5e0!3m2!1sen!2s!4v1763569473410!5m2!1sen!2s',
                'stores' => [
                    ['Takashimaya – B2', '033 8184 600', '09:30–21:30'],
                    ['60 Phó Đức Chính', '035 5454 600', '07:00–17:00'],
                    ['191 Hai Bà Trưng', '088 920 9977', '07:00–22:00'],
                    ['57A Tú Xương', '034 256 5748', '07:00–22:00'],
                    ['16 Bà Huyện Thanh Quan', '032 518 8818', '07:00–22:00'],
                ],
            ],
            [
                'name' => 'Đà Lạt', 'slug' => 'dalat', 'banner_image' => 'regions/dl.jpg',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.25559149303!2d108.43251717577792!3d11.956797736312433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317112d0ec679cb9%3A0x69dd101b15161e40!2sLa%20Viet%20Coffee!5e0!3m2!1sen!2s!4v1763569582214!5m2!1sen!2s',
                'stores' => [
                    ['4D Trần Quý Cáp', '02633 989 919', '08:00–22:00'],
                    ['Kiosk 01 – Khu Hoà Bình', '0989 520 749', '07:00–21:00'],
                    ['Đại diện Đà Lạt', '0989 520 749', '08:00–22:00', 'Văn phòng đại diện'],
                ],
            ],
            [
                'name' => 'Hà Nội', 'slug' => 'hanoi', 'banner_image' => 'regions/hn.jpg',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3722.9352498916114!2d105.81057377590392!3d21.07524818617893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abc762689b55%3A0x2c0e92803a68cc86!2sLa%20Viet%20Coffee%20(Lotte%20West%20Lake)!5e0!3m2!1sen!2s!4v1763569600745!5m2!1sen!2s',
                'stores' => [
                    ['VP Đại Diện – Ngõ 57 Láng Hạ', '086 885 0659', '08:00–17:00', 'Văn phòng đại diện'],
                    ['103 ngõ 6 Lê Thánh Tông', '086 577 0989', '08:00–17:00'],
                    ['7 Vọng Đức – Hoàn Kiếm', '086 959 5769', '07:00–22:00'],
                    ['Lotte Mall Tây Hồ – Food Hall Tầng 3', '098 660 7375', '09:30–22:00'],
                ],
            ],
            [
                'name' => 'Quy Nhơn', 'slug' => 'quynhon', 'banner_image' => 'regions/qn.jpg',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.152987863833!2d109.22069447579578!3d13.769646096878747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x316f6d17b7cab3b1%3A0x46e7b0a940872da!2zTMOgIFZp4buHdCBDb2ZmZWUgKFZQIMSR4bqhaSBkaeG7h24gdOG6oWkgUXVpIE5oxqFuKQ!5e0!3m2!1sen!2s!4v1763569645874!5m2!1sen!2s',
                'stores' => [
                    ['25 Lê Xuân Trữ – Trần Phú', '0866 106 989', null, 'VP đại diện'],
                ],
            ],
            [
                'name' => 'Nha Trang', 'slug' => 'nhatrang', 'banner_image' => 'regions/nt.jpg',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3898.920183560348!2d109.19071697578056!3d12.253680530209932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317067003f230bf1%3A0x5f4462abec3a92dc!2sLa%20Viet%20Coffee%20(Nha%20Trang%20-%208%20Le%20Loi)!5e0!3m2!1sen!2s!4v1763569621727!5m2!1sen!2s',
                'stores' => [
                    ['Vinpearl Hòn Tre – SGA-05 & Harbour L1K2', null, '09:00–21:00'],
                    ['Chợ Đầm – 8 Lê Lợi', '0355 511 809', '07:00–22:00'],
                ],
            ],
        ];

        foreach ($data as $i => $item) {
            $stores = $item['stores'];
            unset($item['stores']);

            $region = StoreRegion::updateOrCreate(
                ['slug' => $item['slug']],
                $item + ['sort_order' => $i + 1, 'is_active' => true]
            );

            $region->stores()->delete();

            foreach ($stores as $j => $s) {
                $region->stores()->create([
                    'name'          => $s[0],
                    'phone'         => $s[1] ?? null,
                    'opening_hours' => $s[2] ?? null,
                    'note'          => $s[3] ?? null,
                    'sort_order'    => $j + 1,
                    'is_active'     => true,
                ]);
            }
        }
    }
}