document.addEventListener('DOMContentLoaded', () => {
    const orderTableBody = document.getElementById('orderTableBody');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const modal = document.getElementById('orderModal');
    const closeModal = document.querySelector('.close-btn');
    let currentOrders = [];

    // Fetch Orders
    async function fetchOrders(status = '') {
        orderTableBody.innerHTML = '<tr><td colspan="4" class="loading">Loading orders...</td></tr>';
        try {
            const response = await fetch(`./api/orders${status ? `?status=${status}` : ''}`);
            const data = await response.json();
            currentOrders = data;
            renderOrders(data);
        } catch (error) {
            console.error('Error fetching orders:', error);
            orderTableBody.innerHTML = '<tr><td colspan="4" class="loading">Error loading orders.</td></tr>';
        }
    }

    function renderOrders(orders) {
        orderTableBody.innerHTML = '';
        if (orders.length === 0) {
            orderTableBody.innerHTML = '<tr><td colspan="4" class="loading">No orders found.</td></tr>';
            return;
        }

        orders.forEach(order => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>#${order.id}</td>
                <td>${order.customer_name}</td>
                <td><span class="badge badge-${order.status.toLowerCase()}">${order.status}</span></td>
                <td>$${parseFloat(order.total_price).toFixed(2)}</td>
            `;
            tr.addEventListener('click', () => showOrderDetails(order.id));
            orderTableBody.appendChild(tr);
        });
    }

    async function showOrderDetails(id) {
        try {
            const response = await fetch(`./api/orders/${id}`);
            const order = await response.json();
            
            document.getElementById('detailId').textContent = `#${order.id}`;
            document.getElementById('detailCustomer').textContent = order.customer_name;
            document.getElementById('detailStatus').textContent = order.status;
            document.getElementById('detailPrice').textContent = `$${parseFloat(order.total_price).toFixed(2)}`;
            document.getElementById('detailDate').textContent = new Date(order.created_at).toLocaleString();
            
            modal.style.display = 'flex';
        } catch (error) {
            console.error('Error fetching order details:', error);
        }
    }

    // Filter Logic
    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            fetchOrders(btn.dataset.status);
        });
    });

    // Close Modal
    closeModal.onclick = () => modal.style.display = 'none';
    window.onclick = (e) => { if (e.target == modal) modal.style.display = 'none'; };

    // Initial Fetch
    fetchOrders();
});
