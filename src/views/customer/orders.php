<?php
    $this->title = 'Dashboard';
    use app\core\Application;
    use app\helpers\DateHelper;
?>

<div class="container my-5">
    <div class="row">
        <div class="col-3">
            <ul class="MyAccount-navigation">
                <li class="MyAccount-navigation-link MyAccount-navigation-link--dashboard is-active">
                    <a href="/my-account">Dashboard</a>
                </li>
                <li class="MyAccount-navigation-link MyAccount-navigation-link--orders">
                    <a href="/my-account/orders">Orders</a>
                </li>
                <li class="MyAccount-navigation-link MyAccount-navigation-link--downloads">
                    <a href="/my-account/downloads">Downloads</a>
                </li>
                <li class="MyAccount-navigation-link MyAccount-navigation-link--edit-address">
                    <a href="/my-account/edit-address">Addresses</a>
                </li>
                <li class="MyAccount-navigation-link MyAccount-navigation-link--edit-account">
                    <a href="/my-account/edit-account">Account details</a>
                </li>
                <li class="MyAccount-navigation-link MyAccount-navigation-link--customer-logout">
                    <form action="dashboard/logout" method="post" class="nostyle">
                        <button type="submit" class="btn"> Logout</button>
                    </form>
                </li>
            </ul>
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
                                <a href="/my-account/view-order/<?= $order['order_id'] ?>/">#<?= $order['order_id'] ?></a>
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
                                <a href="/my-account/view-order/<?= $order['order_id'] ?>/" class="button button view">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <!-- <tr class="orders-table__row--status-processing">
                        <td class="orders-table__cell-order-number" data-title="Order">
                            <a href="/my-account/view-order/30/">#30</a>
                        </td>
                        <td class="orders-table__cell-order-date" data-title="Date">
                            <time datetime="2021-10-28T08:09:02+00:00">October 28, 2021</time>
                        </td>
                        <td class="orders-table__cell-order-status" data-title="Status">
                            Processing
                        </td>
                        <td class="orders-table__cell-order-total" data-title="Total">
                            <span class="Price-amount"><span class="Price-currencySymbol">$</span>46</span> for 2 items
                        </td>
                        <td class="orders-table__cell-order-actions" data-title="Actions">
                            <a href="/my-account/view-order/30/" class="button button view">View</a>
                        </td>
                    </tr>
                    <tr class="orders-table__row orders-table__row--status-processing order">
                        <td class="orders-table__cell-order-number" data-title="Order">
                            <a href="/my-account/view-order/28/">#28</a>
                        </td>
                        <td class="orders-table__cell-order-date" data-title="Date">
                            <time datetime="2021-10-23T06:28:24+00:00">October 23, 2021</time>
                        </td>
                        <td class="orders-table__cell-order-status" data-title="Status">
                            Processing
                        </td>
                        <td class="orders-table__cell-order-total" data-title="Total">
                            <span class="Price-amount"><span class="Price-currencySymbol">$</span>92</span> for 4 items
                        </td>
                        <td class="orders-table__cell-order-actions" data-title="Actions">
                            <a href="/my-account/view-order/28/" class="button button view">View</a>		
                        </td>
                    </tr>
                    <tr class="orders-table__row orders-table__row--status-completed order">
                        <td class="orders-table__cell-order-number" data-title="Order">
                            <a href="/my-account/view-order/14/">#14</a>
                            </td>
                            <td class="orders-table__cell-order-date" data-title="Date">
                            <time datetime="2021-09-20T15:27:12+00:00">September 20, 2021</time>
                        </td>
                        <td class="orders-table__cell-order-status" data-title="Status">
                            Completed
                        </td>
                        <td class="orders-table__cell-order-total" data-title="Total">
                            <span class="Price-amount"><span class="Price-currencySymbol">$</span>23</span> for 1 item
                        </td>
                        <td class="orders-table__cell-order-actions" data-title="Actions">
                            <a href="/my-account/view-order/14/" class="button button view">View</a>	
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
    
</div>