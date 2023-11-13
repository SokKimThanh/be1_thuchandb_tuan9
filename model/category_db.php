<?php

/**
 * Sok Kim Thanh
 * Tuan 9 13/11/2023 2:22PM
 * PRoduct db
 */
require_once 'db.php';

class Category_DB extends Db
{
    /**
     * 1  danh sách 
     */
    public function select()
    {
        $sql = self::$connection->prepare("SELECT * FROM categories");
        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }
        $list = array();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        $sql->close();
        return $list;
    }
}
