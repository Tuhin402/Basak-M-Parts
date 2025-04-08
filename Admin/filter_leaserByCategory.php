<?php
include "config.php";

if (isset($_POST['category'])) {
    $category = $_POST['category'];

    $products = $obj->fetch("SELECT * FROM products WHERE cat_id = '$category' ORDER BY last_updated DESC");

    if($products) {
        foreach ($products as $val) { 
            $commonCatId = $val['cat_id'];
            $commonCompId = $val['company_id'];
            $product_id = $val['id'];

            $category = $obj->fetch("SELECT category FROM product_category WHERE id = $commonCatId");
            $cat = isset($category[0]['category']) ? $category[0]['category'] : 'Unknown';

            $company = $obj->fetch("SELECT name FROM company WHERE id = $commonCompId");
            $comp = isset($company[0]['name']) ? $company[0]['name'] : 'Unknown';

            $sql = "SELECT AVG(rating) AS avg_rating FROM product_reviews WHERE product_id = $product_id";
            $result = $obj->fetch($sql);
            $avg_rating = isset($result[0]['avg_rating']) ? round($result[0]['avg_rating'], 1) : 0;

            $online_sql = "SELECT SUM(quantity) AS total_online FROM orders WHERE product_id = $product_id";
            $online_result = $obj->fetch($online_sql);
            $total_online = isset($online_result[0]['total_online']) ? $online_result[0]['total_online'] : 0;

            $offline_sql = "SELECT SUM(qty) AS total_offline FROM offline_sell WHERE pro_id = $product_id";
            $offline_result = $obj->fetch($offline_sql);
            $total_offline = isset($offline_result[0]['total_offline']) ? $offline_result[0]['total_offline'] : 0;

            $total_sell = $total_online + $total_offline;

            echo "<tr>
                <td class='ps-3'>" . date("d M, Y", strtotime($val['last_updated'])) . "</td>
                <td>
                    <div class='d-flex align-items-center gap-2'>
                        <div class='rounded bg-light avatar-md d-flex align-items-center justify-content-center'>
                            <img src='uploads/products/{$val['image_1']}' alt='Product Image' class='avatar-md rounded'>
                        </div>
                        <div>
                            <a href='javascript:void(0);' class='text-dark fw-medium fs-15'>{$val['name']}</a>
                        </div>
                    </div>
                </td>
                <td><p class='text-muted'>{$cat}</p></td>
                <td><p class='text-muted'>{$comp}</p></td>
                <td>
                    <span class='badge p-1 bg-light text-dark fs-12 me-1'><i class='bx bxs-star align-text-top fs-14 text-warning me-1'></i> {$avg_rating}</span>
                </td>
                <td><p class='text-muted'>{$val['stock']}</p></td>
                <td><p class='text-muted'>{$total_sell}</p></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>No data found for the selected category.</td></tr>";
    }
}
?>