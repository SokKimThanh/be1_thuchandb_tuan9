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
    public function select()
    {

        $sql = self::$connection->prepare("SELECT * FROM products");
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

    function getPaginationBar($url, $total, $page, $perPage, $offset)
    {
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


        //các trang paginate 
        $firstLink = "";
        $prevLink = "";
        $nextLink = "";
        $lastLink = "";
        if ($page > 1) {
            $firstLink = "<li><a href='$url'> << </a></li>"; // <<
            $prev = $page - 1;
            $prevLink = "<li><a href='$url"/* $_SERVER['PHP_SELF'] . "?keyword={$keyword}&" */ . "page=$prev'> < </li>"; // <
        }
        if ($page < $totalLinks) {
            $lastLink = "<li><a href='$url"/* $_SERVER['PHP_SELF'] . "?keyword={$keyword}&" */ . "page=$totalLinks'> >> </a></li>"; // >>
            $next = $page + 1;
            $nextLink = "<li><a href='$url"/* $_SERVER['PHP_SELF'] . "?keyword={$keyword}&" */ . "page=$next'> > </a></li>"; // >
        }

        $link = "";
        // xử lý từ đến offset
        for ($j = $from; $j <= $to; $j++) {
            if ($j != $page) {
                $link = $link . "<li><a href='$url" /* $_SERVER['PHP_SELF'] . "?keyword={$keyword}&" */ . "page=$j'> $j </a></li>";
            } else {
                $link = $link . "<li class='active'><a href='$url" /* $_SERVER['PHP_SELF'] . "?keyword={$keyword}&" */ . "page=$j'> $j </a></li>";
            }
        }
        return $firstLink . $prevLink . $link . $nextLink . $lastLink;
    }
}
