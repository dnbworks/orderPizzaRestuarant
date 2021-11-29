<?php
    $this->title = 'Dashboard';
    use app\core\Application;
    use app\helpers\DateHelper;
?>

<div class="container my-5">
    <div class="row">
        <div class="col-3">
            <?php require 'partials/sidenav.php'; ?>
        </div>
        <div class="col-8">
            <table class="my_account_orders table">
                <thead>
                    <tr>
                        <th class="orders-table__header-order-number"><span class="nobr">Order</span></th>
                        <th class="orders-table__header-order-date"><span class="nobr">Date</span></th>
                        <th class="orders-table__header-order-status"><span class="nobr">Status</span></th>
                        <th class="orders-table__header-order-total"><span class="nobr">Total</span></th>
                        <th class="orders-table__header-order-actions"><span class="nobr">Actions</span></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($orders as $order): ?>
                        <tr class="orders-table__row--status-processing">
                            <td class="orders-table__cell-order-number" data-title="Order">
                                <a href="/my-account/view-order/<?= $order['order_id'] ?>">#<?= $order['order_id'] ?></a>
                            </td>
                            <td class="orders-table__cell-order-date" data-title="Date">
                                <time datetime="<?= $order['order_date'] ?>"><?= DateHelper::format_data($order['order_date']) ?></time>
                            </td>
                            <td class="orders-table__cell-order-status" data-title="Status">
                                <?= $order['order_status'] ?>
                            </td>
                            <td class="orders-table__cell-order-total" data-title="Total">
                                <span class="Price-amount"><span class="Price-currencySymbol">PHP </span><?= $order['total'] ?></span> for <?= $order['quantity'] ?> items
                            </td>
                            <td class="orders-table__cell-order-actions" data-title="Actions">
                                <a href="/my-account/view-order/<?= $order['order_id'] ?>" class="button button view">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>