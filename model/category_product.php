<?php
class CategoryProduct
{
    private /*AI int(11)*/ $category_id;
    private
        /**varchar(255) */
        $product_id;


    public function __construct($category_id, $product_id)
    {
        $this->category_id = $category_id;
        $this->product_id = $product_id;
    }
    /**
     * Get the value of id
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }
}
