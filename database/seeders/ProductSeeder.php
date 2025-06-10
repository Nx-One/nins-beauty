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
    public function run(): void
    {
        $products = [
            ['name' => 'Facial Wash NS', 'price' => 55.00, 'description' => 'Facial wash untuk normal skin yang membersihkan tanpa membuat kulit kering.', 'stock' => 120],
            ['name' => 'Facial Wash Acne', 'price' => 55.00, 'description' => 'Facial wash untuk kulit berjerawat yang membantu mengurangi minyak berlebih.', 'stock' => 110],
            ['name' => 'Facial Wash Bright', 'price' => 55.00, 'description' => 'Facial wash dengan kandungan brightening untuk kulit tampak lebih cerah.', 'stock' => 90],

            ['name' => 'Toner Acne', 'price' => 50.00, 'description' => 'Toner untuk kulit berjerawat yang membantu menenangkan dan membersihkan pori.', 'stock' => 80],
            ['name' => 'Toner Lightening', 'price' => 50.00, 'description' => 'Toner dengan kandungan pencerah untuk meratakan warna kulit.', 'stock' => 85],

            ['name' => 'TSCL+ Cream', 'price' => 55.00, 'description' => 'Cream khusus untuk membantu mengatasi flek dan mencerahkan kulit.', 'stock' => 75],
            ['name' => 'TSP Cream', 'price' => 55.00, 'description' => 'Cream penghilang jerawat dan flek dengan formula lembut.', 'stock' => 60],
            ['name' => 'TS Bright Cream', 'price' => 55.00, 'description' => 'Cream pencerah untuk wajah tampak glowing alami.', 'stock' => 90],
            ['name' => 'BB Acne', 'price' => 55.00, 'description' => 'BB cream khusus kulit berjerawat dengan coverage ringan.', 'stock' => 70],
            ['name' => 'BB Bright', 'price' => 55.00, 'description' => 'BB cream dengan efek cerah alami dan perlindungan ringan.', 'stock' => 70],
            ['name' => 'Sun Acne N4', 'price' => 55.00, 'description' => 'Sunscreen untuk kulit berjerawat dengan perlindungan maksimal.', 'stock' => 100],

            ['name' => 'AM+ Cream', 'price' => 70.00, 'description' => 'Advanced Moisturizer untuk kelembapan ekstra dan perlindungan kulit.', 'stock' => 55],
            ['name' => 'BRT Cream', 'price' => 70.00, 'description' => 'Brightening cream untuk wajah cerah dan sehat.', 'stock' => 60],
            ['name' => 'Glow 1 Cream', 'price' => 70.00, 'description' => 'Cream untuk tampilan kulit glowing dan halus.', 'stock' => 65],
            ['name' => 'Totol Acne Cream', 'price' => 50.00, 'description' => 'Obat totol jerawat yang efektif mengempeskan jerawat.', 'stock' => 90],
            ['name' => 'Totol Flek Cair', 'price' => 50.00, 'description' => 'Cairan penghilang flek hitam secara spot treatment.', 'stock' => 85],
            ['name' => 'Soft BRT Cream', 'price' => 70.00, 'description' => 'Brightening cream dengan tekstur lembut untuk kulit sensitif.', 'stock' => 65],

            ['name' => 'White Serum', 'price' => 90.00, 'description' => 'Serum pencerah kulit dengan bahan aktif pemutih.', 'stock' => 45],
            ['name' => 'Acne Serum', 'price' => 85.00, 'description' => 'Serum khusus untuk mengatasi jerawat dan bekasnya.', 'stock' => 55],
            ['name' => 'Eye C Gel', 'price' => 65.00, 'description' => 'Gel mata dengan kandungan vitamin C untuk mata cerah dan segar.', 'stock' => 50],
            ['name' => 'Retinol Acne', 'price' => 110.00, 'description' => 'Retinol untuk kulit berjerawat, membantu regenerasi kulit.', 'stock' => 35],
            ['name' => 'Retinol White', 'price' => 110.00, 'description' => 'Retinol untuk pencerah kulit dengan anti-aging effect.', 'stock' => 30],
            ['name' => 'Vita B Radiant', 'price' => 95.00, 'description' => 'Vitamin B serum untuk kulit sehat dan bercahaya.', 'stock' => 50],
            ['name' => 'Acne Dry Lotion', 'price' => 75.00, 'description' => 'Lotion pengering jerawat yang cepat menyerap dan efektif.', 'stock' => 60],

            ['name' => 'Gliko Moist', 'price' => 55.00, 'description' => 'Moisturizer dengan glycolic acid untuk kulit halus dan lembab.', 'stock' => 80],
            ['name' => 'Ecta Cream', 'price' => 75.00, 'description' => 'Krim perawatan kulit dengan Ectoin untuk perlindungan dari iritasi.', 'stock' => 55],
            ['name' => 'Vit B3 Gel', 'price' => 75.00, 'description' => 'Gel dengan vitamin B3 untuk mencerahkan dan memperkuat skin barrier.', 'stock' => 60],
        ];

        foreach ($products as &$product) {
            $product['image'] = 'FRAME (' . rand(1, 6) . ').png';
        }

        DB::table('products')->insert($products);
    }
}
