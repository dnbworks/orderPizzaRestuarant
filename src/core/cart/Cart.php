<?php

namespace app\core\cart;

class Cart
{
    /**
     * @var CartItem[]
     */
    private array $items = [];

    /**
     * @return \CartItem[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param \CartItem[] $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Product $product
     * @param int     $quantity
     * @return \CartItem
     * @throws \Exception
     */
    public function addProduct(Product $product, int $quantity)
    {
        // find product in cart
        $cartItem = $this->findCartItem($product->getCartItemId());

        if ($cartItem === null){
            $cartItem = new CartItem($product, 0);
            $this->items[$product->getCartItemId()] = $cartItem;
        }

        $cartItem->increaseQuantity($quantity);
        return $cartItem;
    }

    public function updateProduct($id, $product, $quantity)
    {
        $cartItem = $this->findCartItem($id);
        if($cartItem){
            $cartItem = new CartItem($product, 0);
            $this->items[$id] = $cartItem;
        }
        $cartItem->increaseQuantity($quantity);
        return $cartItem;
    }

    public function addDiff(string $key, Product $product, int $quantity)
    {
        // find product in cart
        $cartItem = $this->findCartItem($key);
        if ($cartItem === null){
            $cartItem = new CartItem($product, 0);
            $this->items[$key] = $cartItem;
        }
        $cartItem->increaseQuantity($quantity);
        return $cartItem;
    }

    private function findCartItem(int|string $productId)
    {
        return $this->items[$productId] ?? null;
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        unset($this->items[$product->getId()]);
    }

    public function removeItem(string|int $id)
    {
        unset($this->items[$id]);
    }

    /**
     * This returns total number of products added in cart
     *
     * @return int
     */
    public function getTotalQuantity()
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->getQuantity();
        }
        return $sum;
    }

    /**
     * This returns total price of products added in cart
     *
     * @return float
     */
    public function getTotalSum()
    {
        $totalSum = 0;
        foreach ($this->items as $item) {
            $totalSum += $item->getQuantity() * $item->getProduct()->getPrice();
        }

        return $totalSum;
    }
}