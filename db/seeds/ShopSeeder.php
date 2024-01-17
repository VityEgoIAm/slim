<?php


use Phinx\Seed\AbstractSeed;

class ShopSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'article'    => '0001',
                'dealer'    => 'B',
                'price'    => 3.99,
            ],[
                'article'    => '0002',
                'dealer'    => 'A',
                'price'    => 10.99,
            ],[
                'article'    => '0003',
                'dealer'    => 'C',
                'price'    => 1.69,
            ],[
                'article'    => '0004',
                'dealer'    => 'D',
                'price'    => 19.95,
            ],[
                'article'    => '0005',
                'dealer'    => 'E',
                'price'    => 21.05,
            ],[
                'article'    => '0001',
                'dealer'    => 'A',
                'price'    => 3.32,
            ],[
                'article'    => '0002',
                'dealer'    => 'D',
                'price'    => 10.99,
            ]
        ];

        $shop = $this->table('shop');
        $shop->insert($data)
             ->saveData();
    }
}
