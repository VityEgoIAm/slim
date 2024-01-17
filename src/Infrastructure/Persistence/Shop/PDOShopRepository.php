<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Shop;

use App\Domain\Shop\Shop;
use App\Domain\Shop\ShopRepository;
use PDO;

class PDOShopRepository implements ShopRepository
{
    private $pdo;

    /**
     * PDOShopRepository constructor.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * {@inheritdoc}
     */
    public function findAllWithHighPrice(): array
    {
        $statement = $this->pdo->prepare("WITH sh AS
            (SELECT *, RANK() 
            OVER (PARTITION BY article ORDER BY article ASC, price DESC) AS rnk 
            FROM shop)
            SELECT * FROM sh WHERE rnk = 1");
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $this->convertRecordsetToShopList($data);
    }

    /**
     * Convert a record to a shop.
     * 
     * @param array $record Record data.
     * @return Shop Shop.
     */
    private function convertRecordToShop(array $record) {
        $shop = $this->createShop(
                    $record['id'],
                    $record['article'],
                    $record['dealer'],
                    (float)$record['price']
                );

        return $shop;
    }

    /**
     * Convert a recordset to a list of shops.
     * 
     * @param array $recordset Recordset data.
     * @return Shop[] Shop list.
     */
    private function convertRecordsetToShopList(array $recordset) {
        $shops = [];

        foreach ($recordset as $record) {
            $shops[] = $this->convertRecordToShop($record);
        }

        return $shops;
    }

    /**
     * Create shop.
     *
     * @param int $id Shop id.
     * @param string $article article.
     * @param string $dealer dealer.
     * @param float $price price.
     * @return Shop Shop.
     */
    private function createShop(int $id, string $article, string $dealer, float $price) {
        $shop = new Shop($id, $article, $dealer, $price);

        return $shop;
    }
}
