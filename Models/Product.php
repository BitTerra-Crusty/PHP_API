<?php

    class Product
    {
        //DB conn props
        private $conn;
        private $table = "product";

        //product fields
        public $id;
        public $name;
        public $price;
        public $description;
        public $quantity;

        //contructor for the database connection
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //Read product from DB
        public function read()
        {
            $query = 'SELECT * FROM product';

            //prepare the query statement
            $stmt = $this->conn->prepare($query);

            //execute the quesry statement
            $stmt->execute();

            return $stmt;
        }

        //Read or get a single product
        public function read_product()
        {
            $query = 'SELECT * FROM product WHERE id = ? LIMIT 0,1';

            //prepare the query statement
            $stmt = $this->conn->prepare($query);

            //Bind the ID to the ? aka PDO parameter
            $stmt->bindParam(1, $this->id);

            //execute the quesry statement
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row == false)
            {
                return "No content found";
            }

            return $row;
        }

        //Create product
        public function Create()
        {
            $query = 'INSERT INTO '.$this->table .' 
                    SET name = :name,
                        description = :description,
                        price = :price,
                        quantity = :quantity';

            //prepare the query statement
            $stmt = $this->conn->prepare($query);

            //Clean up all input data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->quantity = htmlspecialchars(strip_tags($this->quantity));

            //Binding data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':quantity', $this->quantity);

            //execute the quesry statement
            if($stmt->execute())
            {
                return true;
            }

            //price error message
            printf("error: %s. \n", $stmt->error);
            return false;

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        //Update product
        public function Update()
        {
            $query = 'UPDATE '.$this->table .' 
                    SET name = :name,
                        description = :description,
                        price = :price,
                        quantity = :quantity
                    WHERE id = :id';

            //prepare the query statement
            $stmt = $this->conn->prepare($query);

            //Clean up all input data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->quantity = htmlspecialchars(strip_tags($this->quantity));
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Binding data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':quantity', $this->quantity);
            $stmt->bindParam(':id', $this->id);

            //execute the quesry statement
            if($stmt->execute())
            {
                return true;
            }

            //price error message
            printf("error: %s. \n", $stmt->error);
            return false;

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        //Delete product
        public function delete()
        {
            $query = 'DELETE FROM product WHERE id = :id';

            //prepare the query statement
            $stmt = $this->conn->prepare($query);

            //clean
            $this->id = htmlspecialchars(strip_tags($this->id));

            //bind
            $stmt->bindParam(':id', $this->id); 

           //execute the quesry statement
           if($stmt->execute())
           {
               return true;
           }

           //price error message
           printf("error: %s. \n", $stmt->error);
           return false;
            
        }
    }

?>