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
    public function select($currentPage, $perPage, $category_id_selected)
    {
        $startRecord = ($currentPage - 1) * $perPage;
        $select = "SELECT p.id as pid, p.name as pname, p.price, p.description, p.image, c.id as cid, c.name as cname";
        $from = "FROM products as p, categories as c, category_product as cp";
        $where = "WHERE p.id = cp.product_id and c.id = cp.category_id and c.id = $category_id_selected";
        $limit = "LIMIT $startRecord, $perPage";
        $sql = self::$connection->prepare($select . " " . $from . " " . $where . " "  . (isset($limit) ? $limit : ""));
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

    public function selectSoLuongByLoaiSanPham($category_id_selected)
    {
        $select = "SELECT count(*) as soluong";
        $from = "FROM products as p, categories as c, category_product as cp";
        $where = "WHERE p.id = cp.product_id and c.id = cp.category_id and c.id = $category_id_selected";
        $sql = self::$connection->prepare($select . " " . $from . " " . $where);
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
        return isset($list[0]['soluong']) ? $list[0]['soluong'] : 0; // trả về thanh navigationbar
    }

    public function getSelectSoLuong()
    {
        $sql = self::$connection->prepare("SELECT count(*) as soluong FROM products");
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
        // var_dump($list);
        return isset($list[0]['soluong']) ? $list[0]['soluong'] : 0;
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
        return isset($list[0]['soluong']) ? $list[0]['soluong'] : 0;
    }

    function getPaginationBar($url, $total, $page, $perPage, $offset)
    {
        // var_dump('url=' . $url, 'total=' . $total, 'page=' . $page, 'perPage=' . $perPage, 'offset=' . $offset);
        if ($total <= 0) {
            return "";
        }
        $totalLinks = ceil($total / $perPage);

        if ($totalLinks <= 1) {
            return "";
        }
        // offset 
        $from = $page - $offset;
        $to = $page + $offset;
        if ($from <= 0) {
            $from = 1;
            $to = $from + $offset * 2;
        }

        if ($to >= $totalLinks) {
            $to = $totalLinks;
        }

        /* @url: $_SERVER['PHP_SELF'] . "?keyword={$keyword}&category_id=1&" */

        //các trang paginate 
        $firstLink = "";
        $prevLink = "";
        $nextLink = "";
        $lastLink = "";
        if ($page > 1) {
            $firstLink = "<li><a href='$url'> << </a></li>"; // <<
            $prev = $page - 1;
            $prevLink = "<li><a href='$url" . "page=$prev'> < </li>"; // <
        }
        if ($page < $totalLinks) {
            $lastLink = "<li><a href='$url" . "page=$totalLinks'> >> </a></li>"; // >>
            $next = $page + 1;
            $nextLink = "<li><a href='$url" . "page=$next'> > </a></li>"; // >
        }

        $link = "";
        // xử lý từ đến offset
        for ($j = $from; $j <= $to; $j++) {
            if ($j != $page) {
                $link = $link . "<li><a href='$url"  . "page=$j'> $j </a></li>";
            } else {
                $link = $link . "<li class='active'><a href='$url"  . "page=$j'> $j </a></li>";
            }
        }
        $result = $firstLink . $prevLink . $link . $nextLink . $lastLink;
        // var_dump($result);
        return $result;
    }
}
