<?php
declare(strict_types=1);

namespace App\Domain\Shop;

use JsonSerializable;

class Shop implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $article;

    /**
     * @var string
     */
    private $dealer;

    /**
     * @var float
     */
    private $price;

    /**
     * @param int|null  $id
     * @param string    $article
     * @param string    $dealer
     * @param float    $price
     */
    public function __construct(?int $id, string $article, string $dealer, float $price)
    {
        $this->id = $id;
        $this->article = $article;
        $this->dealer = $dealer;
        $this->price = $price;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'article' => $this->article,
            'dealer' => $this->dealer,
            'price' => $this->price,
        ];
    }
}
