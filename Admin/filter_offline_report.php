<?php
include "config.php";

if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $sells = $obj->fetch("SELECT * FROM offline_sell WHERE date BETWEEN '$startDate' AND '$endDate' ORDER BY date DESC");

    if ($sells) {
        foreach ($sells as $val) {

            echo "<tr>
                <td>" . date("d M, Y", strtotime($val['date'])) . "</td>
                <td>{$val['name']}</td>
                <td>{$val['type']}</td>
                <td>₹" . number_format($val['price'], 2) . "</td>
                <td>{$val['qty']}</td>
                <td>₹" . number_format($val['totalprice'], 2) . "</td>
                <td><span class='badge border border-success text-success px-2 py-1 fs-13'>Paid</span></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>No data found for the selected date range.</td></tr>";
    }
}
?>