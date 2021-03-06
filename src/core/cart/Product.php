<?php

namespace app\core\cart;

class Product
{
    private int $id;
    private string $title;
    private float $price;
    private int $availableQuantity;
    private array $options;
    private string $img;
    private string $category;
    private string $description;
    private string|int $cartItemId;

    /**
     * Product constructor.
     *
     * @param int    $id
     * @param string $title
     * @param float  $price
     * @param int    $availableQuantity
     * @param string  $description
     */

    public function __construct(int $id, $title, float $price, $availableQuantity, $options, $img, $category, $description, $cartItemId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->availableQuantity = $availableQuantity;
        $this->options = $options;
        $this->img = $img;
        $this->category = $category;
        $this->description = $description;
        $this->cartItemId = $cartItemId;
    }

    public function getCartItemId(): string
    {
        return $this->cartItemId;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function getOption(): array
    {
        return $this->options;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getProductAttributes(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => (string) $this->price,
            'availableQuantity' => $this->availableQuantity,
            'img' => $this->img,
            'category' => $this->category,
            'options' => $this->options,
            'CartItemId' => $this->getCartItemId(),
            'description' => $this->description
        ];
    }


    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getAvailableQuantity()
    {
        return $this->availableQuantity;
    }

    /**
     * @param int $availableQuantity
     */
    public function setAvailableQuantity($availableQuantity)
    {
        $this->availableQuantity = $availableQuantity;
    }

    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Cart $cart
     * @param int  $quantity
     * @return \CartItem
     * @throws \Exception
     */
    public function addToCart(Cart $cart, int $quantity)
    {
        return $cart->addProduct($this, $quantity);
    }

    /**
     * Remove product from cart
     *
     * @param Cart $cart
     */
    public function removeFromCart(Cart $cart)
    {
        return $cart->removeProduct($this);
    }
}