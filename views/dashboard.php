<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management Dashboard</title>
    <link rel="stylesheet" href="./css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>Order Dashboard</h1>
            <div class="filter-bar">
                <button class="filter-btn active" data-status="">All</button>
                <button class="filter-btn" data-status="Pending">Pending</button>
                <button class="filter-btn" data-status="Completed">Completed</button>
            </div>
        </header>

        <div class="order-table-container">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                    <!-- Orders will be injected here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Order Detail Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2 style="margin-bottom: 2rem;">Order Details</h2>
            
            <div class="detail-row">
                <div class="detail-label">Order ID</div>
                <div class="detail-value" id="detailId"></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Customer Name</div>
                <div class="detail-value" id="detailCustomer"></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Status</div>
                <div class="detail-value" id="detailStatus"></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Total Price</div>
                <div class="detail-value" id="detailPrice"></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Order Date</div>
                <div class="detail-value" id="detailDate"></div>
            </div>
        </div>
    </div>

    <script src="./js/main.js"></script>
</body>
</html>
