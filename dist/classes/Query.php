<?php 

    /**
     * qyery 
     * v1.0.0
    */

    // require_once "Connection.php";

    class Query extends Connection {

        public CONST LIMIT = 10;

        public $page = 0;

        // start of items
        public function startOf() {
            return self::LIMIT * $this->page;
        }
        
        // upload img method
        public function uploadImg($title, $img) {

            $sql = "INSERT INTO gallery (title, path) VALUES (:title, :path)";

            $stmt = $this->con->prepare($sql);

            $stmt->execute(array(
                "title"    => $title,
                "path"     => $img
            ));

            return true;

        }

        // fetchAllImages
        public function fetchAllImgs() {

            $sql = "SELECT * FROM gallery ORDER BY id DESC LIMIT ".$this->startOf().", ".self::LIMIT."";

            $stmt = $this->con->prepare($sql);

            $stmt->execute();

            $results = $stmt->fetchAll();

            return $results;

        }

        // pagination - get the images count
        public function imagesCount() {

            $sql = "SELECT COUNT(id) AS number_of_imgs FROM gallery";

            $stmt = $this->con->prepare($sql);

            $stmt->execute();

            $results = $stmt->fetchColumn();

            $results = intval($results);

            return ceil($results / self::LIMIT);

        }

        // deleteImg
        public function deleteImg($id) {

            $sql = "SELECT path FROM gallery WHERE id = :id";

            $stmt = $this->con->prepare($sql);

            $stmt->execute(array("id" => $id));

            $results = $stmt->fetchColumn();

            if (file_exists(root . "/uploads/" . $results)) {
                unlink(root . "/uploads/" . $results);
            }

            $sql = "DELETE FROM gallery WHERE id = :id";

            $stmt = $this->con->prepare($sql);

            $stmt->execute(array("id" => $id));

            return true;

        }

    } 

?>