<?php
class Product
{
    private /*AI int(11)*/ $id;
    private
        /**varchar(255) */
        $name;
    private
        /**int(11) */
        $price;
    private
        /**text */
        $description;
    private
        /**varchar(255) */
        $image;
    public function __construct($id, $name, $price, $description, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
    }
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    /**
     * Get the value of id
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
    /**
     * Get the value of name
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
