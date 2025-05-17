<template>
  <div class="dashboard-container">
    <h1 class="dashboard-title">My Deliveries</h1>

    <div class="table-container" v-if="deliveries.length">
      <table class="delivery-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Status</th>
            <th>Cost (Ksh)</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="d in deliveries" :key="d.id">
            <td>{{ d.id }}</td>
            <td>{{ d.product_name }}</td>
            <td>
              <span :class="statusClass(d.status)">{{ d.status }}</span>
            </td>
            <td>{{ d.cost }}</td>
            <td>{{ new Date(d.created_at).toLocaleString() }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <p v-else class="no-data">No deliveries found.</p>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios, { setAuthToken } from '@/axios';

export default {
  props: {
    auth: Object,
  },
  setup(props) {
    const deliveries = ref([]);

    // map status to badge classes
    const statusClass = (status) => ({
      'status-badge pending': status === 'pending',
      'status-badge dispatched': status === 'dispatched',
      'status-badge in-transit': status === 'in_transit',
      'status-badge delivered': status === 'delivered',
      'status-badge cancelled': status === 'cancelled',
    });

    const fetchDeliveries = async () => {
      try {
        setAuthToken(props.auth.user.token);
        const { data } = await axios.get('/api/deliveries');
        deliveries.value = data;
      } catch (err) {
        console.error('Error fetching deliveries:', err);
        alert('Failed to load deliveries');
      }
    };

    onMounted(fetchDeliveries);

    return { deliveries, statusClass };
  },
};
</script>

<style scoped>
.dashboard-container {
  padding: 2rem;
  max-width: 1000px;
  margin: auto;
}
.dashboard-title {
  font-size: 2rem;
  margin-bottom: 1rem;
  text-align: center;
}
.table-container {
  overflow-x: auto;
}
.delivery-table {
  width: 100%;
  border-collapse: collapse;
}
.delivery-table th,
.delivery-table td {
  padding: 0.75rem;
  border: 1px solid #ddd;
  text-align: left;
}
.delivery-table th {
  background: #f4f4f4;
}
.status-badge {
  padding: 0.3rem 0.6rem;
  border-radius: 0.5rem;
  font-size: 0.85rem;
  color: white;
}
.status-badge.pending { background: orange; }
.status-badge.dispatched { background: blue; }
.status-badge.in-transit { background: purple; }
.status-badge.delivered { background: green; }
.status-badge.cancelled { background: red; }
.no-data {
  text-align: center;
  color: #666;
  margin-top: 2rem;
}

/* Responsive */
@media (max-width: 600px) {
  .dashboard-title { font-size: 1.5rem; }
  .delivery-table th, .delivery-table td { font-size: 0.85rem; padding: 0.5rem; }
}
</style>
