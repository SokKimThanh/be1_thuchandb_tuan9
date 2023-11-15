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

    public function InDanhSachLoaiSP($keyword, $page, $category_id_selected)
    {

        $list = $this->select();
        $result = "";
        $page = 1;
        foreach ($list as $row => $value) {
            $category_id = $value['id'];
            $href = "{$_SERVER['PHP_SELF']}?category_id={$category_id}&page={$page}";
            if ($value['id'] != $category_id_selected) {
                $result .= "" . "<li><a href='$href'>{$value['name']}</a></li>" . "";
            } else {
                $result .= "" . "<li class='active'><a href='$href'>{$value['name']}</a></li>" . "";
            }
        }
        return $result;
    }
}
