<?php

/**
 * Sok Kim Thanh
 * Tuan 9 13/11/2023 2:22PM
 * PRoduct db
 */
require_once 'db.php';

class Product_DB extends Db
{

    /**
     * 1  danh sách sản phẩm
     */
    public function select($currentPage, $perPage)
    {
        $startRecord = ($currentPage - 1) * $perPage;
        $sql = self::$connection->prepare("SELECT * FROM products LIMIT $startRecord, $perPage");
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
    /**
     * 1  danh sách sản phẩm
     */
    public function search($keyword, $currentPage, $perPage)
    {
        $startRecord = ($currentPage - 1) * $perPage;
        $sql = self::$connection->prepare("SELECT * FROM products where name like '%$keyword%' LIMIT $startRecord, $perPage");
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
    public function getSoLuong($keyword)
    {

        $sql = self::$connection->prepare("SELECT count(*) as soluong FROM products where name like '%$keyword%'");
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
        return $list[0]['soluong'];
    }

    function getPaginationBar($url, $total, $perPage)
    {
        $totalLinks = ceil($total / $perPage);
        $link = "";
        for ($j = 1; $j <= $totalLinks; $j++) {
            $link = $link . "<a href='$url" . "page=$j'> $j </a>";
        }
        return $link;
    }
}
