<?php
include "config.php";

if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $orders = $obj->fetch("SELECT o.order_id, o.date, o.user_name, SUM(o.total_price) AS total_price, o.status, SUM(o.quantity) AS quantity, o.ship_status FROM orders o JOIN products p ON o.price = p.b2b_price WHERE o.date BETWEEN '$startDate' AND '$endDate' GROUP BY o.order_id ORDER BY o.date DESC");

    if ($orders) {
        foreach ($orders as $val) {
            $statusClass = "";
            if ($val['ship_status'] == "In Transit") {
                $statusClass = "border-secondary text-secondary";
            } elseif ($val['ship_status'] == "Out for Delivery") {
                $statusClass = "border-warning text-warning";
            } elseif ($val['ship_status'] == "Completed") {
                $statusClass = "border-success text-success";
            } elseif ($val['ship_status'] == "Pending") {
                $statusClass = "border-danger text-danger";
            }

            echo "<tr>
                <td>#{$val['order_id']}</td>
                <td>" . date("d M, Y", strtotime($val['date'])) . "</td>
                <td><a href='javascript:void(0)' class='link-primary fw-medium'>{$val['user_name']}</a></td>
                <td>₹" . number_format($val['total_price'], 2) . "</td>
                <td><span class='badge bg-success text-light px-2 py-1 fs-13'>{$val['status']}</span></td>
                <td>{$val['quantity']}</td>
                <td><span class='badge border border-danger text-danger px-2 py-1 fs-13'>Pending</span></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>No orders found for the selected date range.</td></tr>";
    }
}
?>