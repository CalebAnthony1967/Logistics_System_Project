


```vue
<template>
    <div class="dashboard-container">
        <h1 class="dashboard-title">Customer Dashboard</h1>
        <nav class="tab-nav">
            <button class="tab-link" :class="{ active: activeTab === 'delivery' }" @click="activeTab = 'delivery'">New Delivery</button>
            <button class="tab-link" :class="{ active: activeTab === 'history' }" @click="activeTab = 'history'">Delivery History</button>
            <button class="tab-link" :class="{ active: activeTab === 'track' }" @click="activeTab = 'track'">Track Delivery</button>
            <button class="tab-link" :class="{ active: activeTab === 'profile' }" @click="activeTab = 'profile'">Profile</button>
        </nav>

        <!-- New Delivery Tab -->
        <div v-if="activeTab === 'delivery'" class="tab-content">
            <h2 class="tab-title">New Delivery Request</h2>
            <form @submit.prevent="submitDelivery" class="delivery-form">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input v-model="deliveryForm.product_name" type="text" id="product_name" required />
                        <span v-if="deliveryForm.errors.product_name" class="error">{{ deliveryForm.errors.product_name }}</span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea v-model="deliveryForm.description" id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (kg)</label>
                        <input v-model.number="deliveryForm.weight" type="number" step="0.1" min="0.1" id="weight" required />
                        <span v-if="deliveryForm.errors.weight" class="error">{{ deliveryForm.errors.weight }}</span>
                    </div>
                    <div class="form-group">
                        <label for="value">Value (Ksh)</label>
                        <input v-model.number="deliveryForm.value" type="number" min="0" id="value" required />
                        <span v-if="deliveryForm.errors.value" class="error">{{ deliveryForm.errors.value }}</span>
                    </div>
                    <div class="form-group">
                        <label for="source">Source</label>
                        <input v-model="deliveryForm.source" id="source" required />
                        <span v-if="deliveryForm.errors.source" class="error">{{ deliveryForm.errors.source }}</span>
                    </div>
                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <input v-model="deliveryForm.destination" id="destination" required />
                        <span v-if="deliveryForm.errors.destination" class="error">{{ deliveryForm.errors.destination }}</span>
                    </div>
                    <div class="form-group">
                        <label for="sender_name">Sender Name</label>
                        <input v-model="deliveryForm.sender_name" type="text" id="sender_name" required />
                        <span v-if="deliveryForm.errors.sender_name" class="error">{{ deliveryForm.errors.sender_name }}</span>
                    </div>
                    <div class="form-group">
                        <label for="sender_email">Sender Email</label>
                        <input v-model="deliveryForm.sender_email" type="email" id="sender_email" required />
                        <span v-if="deliveryForm.errors.sender_email" class="error">{{ deliveryForm.errors.sender_email }}</span>
                    </div>
                    <div class="form-group">
                        <label for="sender_phone">Sender Phone</label>
                        <input v-model="deliveryForm.sender_phone" type="text" id="sender_phone" required />
                        <span v-if="deliveryForm.errors.sender_phone" class="error">{{ deliveryForm.errors.sender_phone }}</span>
                    </div>
                    <div class="form-group">
                        <label for="sender_address">Sender Address</label>
                        <input v-model="deliveryForm.sender_address" id="sender_address" required />
                        <span v-if="deliveryForm.errors.sender_address" class="error">{{ deliveryForm.errors.sender_address }}</span>
                    </div>
                    <div class="form-group">
                        <label for="receiver_name">Receiver Name</label>
                        <input v-model="deliveryForm.receiver_name" type="text" id="receiver_name" required />
                        <span v-if="deliveryForm.errors.receiver_name" class="error">{{ deliveryForm.errors.receiver_name }}</span>
                    </div>
                    <div class="form-group">
                        <label for="receiver_email">Receiver Email</label>
                        <input v-model="deliveryForm.receiver_email" type="email" id="receiver_email" required />
                        <span v-if="deliveryForm.errors.receiver_email" class="error">{{ deliveryForm.errors.receiver_email }}</span>
                    </div>
                    <div class="form-group">
                        <label for="receiver_phone">Receiver Phone</label>
                        <input v-model="deliveryForm.receiver_phone" type="text" id="receiver_phone" required />
                        <span v-if="deliveryForm.errors.receiver_phone" class="error">{{ deliveryForm.errors.receiver_phone }}</span>
                    </div>
                    <div class="form-group">
                        <label for="receiver_address">Receiver Address</label>
                        <input v-model="deliveryForm.receiver_address" id="receiver_address" required />
                        <span v-if="deliveryForm.errors.receiver_address" class="error">{{ deliveryForm.errors.receiver_address }}</span>
                    </div>
                    <div class="form-group">
                        <label for="urgent">Urgent Delivery</label>
                        <input v-model="deliveryForm.urgent" type="checkbox" id="urgent" />
                    </div>
                    <div class="form-group">
                        <label for="special_instructions">Special Instructions</label>
                        <textarea v-model="deliveryForm.special_instructions" id="special_instructions"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="preferred_delivery_time">Preferred Delivery Time</label>
                        <input v-model="deliveryForm.preferred_delivery_time" type="datetime-local" id="preferred_delivery_time" />
                        <span v-if="deliveryForm.errors.preferred_delivery_time" class="error">{{ deliveryForm.errors.preferred_delivery_time }}</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" :disabled="deliveryForm.processing">Submit Delivery</button>
                <div v-if="cost !== null" class="estimated-cost">
  <p><strong>Estimated Cost:</strong> {{ cost }} Ksh</p>
</div>

                
                  
                 <div v-if="cost" class="payment-section">
                    <h3>Payment</h3>
                    <div class="form-group">
                        <label for="phone_number">M-Pesa Phone Number</label>
                        <input v-model="paymentForm.phone_number" type="text" id="phone_number" required />
                        <span v-if="paymentForm.errors.phone_number" class="error">{{ paymentForm.errors.phone_number }}</span>
                    </div>
                    <button @click="initiatePayment" class="btn btn-primary" :disabled="paymentForm.processing">Pay {{ cost }} Ksh</button>
                </div>
            </form>
        </div>

        <!-- Delivery History Tab -->
        <div v-if="activeTab === 'history'" class="tab-content">
            <h2 class="tab-title">Delivery History</h2>
            <div class="search-container">
                <input v-model="searchQuery" type="text" placeholder="Search deliveries..." class="search-input" />
            </div>
            <div class="table-container">
                <table class="delivery-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Cost (Ksh)</th>
                            <th>Payment</th>
                            <th>Dispatcher</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="delivery in filteredDeliveries" :key="delivery.id">
                            <td>{{ delivery.id }}</td>
                            <td>{{ delivery.product_name }}</td>
                            <td>
                                <span :class="statusClass(delivery.status)">{{ delivery.status }}</span>
                            </td>
                            <td>{{ delivery.cost }}</td>
                            <td>{{ delivery.payment_status }}</td>
                            <td>{{ delivery.dispatcher_id ? 'Assigned' : 'Unassigned' }}</td>
                            <td>{{ new Date(delivery.created_at).toLocaleDateString() }}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm" @click="viewDelivery(delivery)">View</button>
                                <button v-if="delivery.status === 'pending'" class="btn btn-danger btn-sm" @click="cancelDelivery(delivery)">Cancel</button>
                                <button v-if="delivery.status === 'delivered' && !delivery.rating" class="btn btn-primary btn-sm" @click="openRatingModal(delivery)">Rate</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Track Delivery Tab -->
        <div v-if="activeTab === 'track'" class="tab-content">
            <h2 class="tab-title">Track Delivery</h2>
            <div class="select-container">
                <select v-model="selectedDelivery" class="track-select">
                    <option value="null" disabled>Select a delivery</option>
                    <option v-for="delivery in deliveries" :key="delivery.id" :value="delivery">
                        {{ delivery.id }} - {{ delivery.product_name }}
                    </option>
                </select>
            </div>
            <div v-if="eta" class="eta-display">Estimated Arrival: {{ eta }}</div>
            <div v-if="selectedDelivery" class="map-placeholder">
                Map unavailable. Route: {{ selectedDelivery.source }} to {{ selectedDelivery.destination }}
            </div>
        </div>

        <!-- Profile Tab -->
        <div v-if="activeTab === 'profile'" class="tab-content">
            <h2 class="tab-title">User Profile</h2>
            <form @submit.prevent="updateProfile" class="profile-form">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input v-model="profileForm.name" type="text" id="name" required />
                        <span v-if="profileForm.errors.name" class="error">{{ profileForm.errors.name }}</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input v-model="profileForm.email" type="email" id="email" required />
                        <span v-if="profileForm.errors.email" class="error">{{ profileForm.errors.email }}</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input v-model="profileForm.phone" type="text" id="phone" required />
                        <span v-if="profileForm.errors.phone" class="error">{{ profileForm.errors.phone }}</span>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input v-model="profileForm.address" id="address" required />
                        <span v-if="profileForm.errors.address" class="error">{{ profileForm.errors.address }}</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" :disabled="profileForm.processing">Update Profile</button>
            </form>
        </div>

        <!-- Delivery Details Modal -->
        <div v-if="selectedDelivery" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Delivery #{{ selectedDelivery.id }}</h3>
                    <button class="modal-close" @click="selectedDelivery = null">×</button>
                </div>
                <div class="modal-body">
                    <p><strong>Product:</strong> {{ selectedDelivery.product_name }}</p>
                    <p><strong>Description:</strong> {{ selectedDelivery.description || 'N/A' }}</p>
                    <p><strong>Weight:</strong> {{ selectedDelivery.weight }} kg</p>
                    <p><strong>Value:</strong> {{ selectedDelivery.value }} Ksh</p>
                    <p><strong>Cost:</strong> {{ selectedDelivery.cost }} Ksh</p>
                    <p><strong>Status:</strong> {{ selectedDelivery.status }}</p>
                    <p><strong>Payment Status:</strong> {{ selectedDelivery.payment_status }}</p>
                    <p><strong>Source:</strong> {{ selectedDelivery.source }}</p>
                    <p><strong>Destination:</strong> {{ selectedDelivery.destination }}</p>
                    <p><strong>Sender:</strong> {{ selectedDelivery.sender_name }} ({{ selectedDelivery.sender_email }})</p>
                    <p><strong>Receiver:</strong> {{ selectedDelivery.receiver_name }} ({{ selectedDelivery.receiver_email }})</p>
                    <p><strong>Dispatcher:</strong> {{ selectedDelivery.dispatcher_id ? 'Assigned' : 'Unassigned' }}</p>
                    <p><strong>Urgent:</strong> {{ selectedDelivery.urgent ? 'Yes' : 'No' }}</p>
                    <p><strong>Special Instructions:</strong> {{ selectedDelivery.special_instructions || 'N/A' }}</p>
                    <p><strong>Preferred Delivery Time:</strong> {{ selectedDelivery.preferred_delivery_time ? new Date(selectedDelivery.preferred_delivery_time).toLocaleString() : 'N/A' }}</p>
                    <p v-if="selectedDelivery.rating"><strong>Rating:</strong> {{ selectedDelivery.rating }} stars</p>
                    <p v-if="selectedDelivery.rating_comment"><strong>Comment:</strong> {{ selectedDelivery.rating_comment }}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" @click="selectedDelivery = null">Close</button>
                </div>
            </div>
        </div>

        <!-- Rating Modal -->
        <div v-if="ratingDelivery" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Rate Delivery #{{ ratingDelivery.id }}</h3>
                    <button class="modal-close" @click="ratingDelivery = null">×</button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitRating">
                        <div class="form-group">
                            <label for="rating">Rating (1–5)</label>
                            <input v-model.number="ratingForm.rating" type="number" min="1" max="5" id="rating" required />
                            <span v-if="ratingForm.errors.rating" class="error">{{ ratingForm.errors.rating }}</span>
                        </div>
                        <div class="form-group">
                            <label for="rating_comment">Comment</label>
                            <textarea v-model="ratingForm.rating_comment" id="rating_comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" :disabled="ratingForm.processing">Submit Rating</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue';
import axios, { setAuthToken } from '@/axios'; // use shared axios instance

export default {
    props: {
        auth: Object,
    },
    setup(props) {
        

        setAuthToken(props.auth.user.token);


        const activeTab = ref('delivery');
        const deliveries = ref([]);
        const searchQuery = ref('');
        const selectedDelivery = ref(null);
        const ratingDelivery = ref(null);
        const cost = ref(null);
        const eta = ref(null);

        // Delivery Form
        const deliveryForm = useForm({
            product_name: '',
            description: '',
            weight: '',
            value: '',
            source: '',
            destination: '',
            sender_name: props.auth.user.name,
            sender_email: props.auth.user.email,
            sender_phone: props.auth.user.phone,
            sender_address: props.auth.user.address,
            receiver_name: '',
            receiver_email: '',
            receiver_phone: '',
            receiver_address: '',
            urgent: false,
            special_instructions: '',
            preferred_delivery_time: '',
        });

        // Payment Form
        const paymentForm = useForm({
            phone_number: props.auth.user.phone,
        });

        // Rating Form
        const ratingForm = useForm({
            rating: null,
            rating_comment: '',
        });

        // Profile Form
        const profileForm = useForm({
            name: props.auth.user.name,
            email: props.auth.user.email,
            phone: props.auth.user.phone,
            address: props.auth.user.address,
        });

        // Fetch Deliveries
        const fetchDeliveries = async () => {
            try {
                
                const response = await axios.get('/api/deliveries');
                deliveries.value = response.data;
            } catch (error) {
                console.error('Error fetching deliveries:', error);
                alert('Failed to load deliveries');
            }
        };

     
// ?? Estimate and Confirm before Submitting
const submitDelivery = async () => {
  try {
    const response = await axios.post('/api/deliveries/estimate', deliveryForm.data());
    cost.value = response.data.cost;

    if (confirm(`Estimated cost: ${cost.value} Ksh. Proceed to submit?`)) {
      await axios.post('/api/deliveries', deliveryForm.data());
      alert('Delivery submitted successfully!');
      deliveryForm.reset();
      cost.value = null;
      await fetchDeliveries();
    }
  } catch (error) {
    console.error('Error estimating cost or submitting delivery:', error);
    alert('Error calculating or submitting delivery');
  }
};


        // Initiate Payment
        const initiatePayment = () => {
            
            paymentForm.post('/api/payments', {
                data: { delivery_id: deliveries.value[deliveries.value.length - 1]?.id, amount: cost.value },
                onSuccess: () => {
                    alert('Payment initiated successfully! Check your phone for M-Pesa prompt.');
                    fetchDeliveries();
                },
                onError: (errors) => {
                    console.error('Payment errors:', errors);
                    alert('Error initiating payment');
                },
            });
        };

        // Cancel Delivery
        const cancelDelivery = (delivery) => {
            if (confirm('Are you sure you want to cancel this delivery?')) {
                
                axios.patch(`/api/deliveries/${delivery.id}`, { status: 'cancelled' })
                    .then(() => {
                        fetchDeliveries();
                        alert('Delivery cancelled successfully');
                    }).catch((error) => {
                        console.error('Error cancelling delivery:', error);
                        alert('Error cancelling delivery');
                    });
            }
        };

        // View Delivery
        const viewDelivery = (delivery) => {
            selectedDelivery.value = delivery;
        };

        // Open Rating Modal
        const openRatingModal = (delivery) => {
            ratingDelivery.value = delivery;
            ratingForm.reset();
        };

        // Submit Rating
        const submitRating = () => {
            
            ratingForm.post(`/api/deliveries/${ratingDelivery.value.id}/rate`, {
                onSuccess: () => {
                    fetchDeliveries();
                    ratingDelivery.value = null;
                    alert('Rating submitted successfully');
                },
                onError: (errors) => {
                    console.error('Rating errors:', errors);
                    alert('Error submitting rating');
                },
            });
        };

        // Update Profile
        const updateProfile = () => {
            profileForm.put('/api/profile', {
                onSuccess: () => alert('Profile updated successfully!'),
                onError: (errors) => {
                    console.error('Profile update errors:', errors);
                    alert('Error updating profile');
                },
            });
        };

        // Filter Deliveries
        const filteredDeliveries = computed(() => {
    const query = searchQuery.value.toLowerCase();

    // Ensure deliveries is always an array before filtering
    const list = Array.isArray(deliveries.value) ? deliveries.value : [];

    return list.filter(delivery =>
        delivery?.product_name?.toLowerCase().includes(query) ||
        delivery?.status?.toLowerCase().includes(query)
    );
});


        // Status Class
        const statusClass = (status) => ({
            'status-badge pending': status === 'pending',
            'status-badge dispatched': status === 'dispatched',
            'status-badge in-transit': status === 'in_transit',
            'status-badge delivered': status === 'delivered',
            'status-badge cancelled': status === 'cancelled',
        });

        // Mock ETA for Tracking
        watch(selectedDelivery, (newDelivery) => {
            if (newDelivery && newDelivery.source && newDelivery.destination) {
                eta.value = '30 minutes';
            } else {
                eta.value = null;
            }
        });

        fetchDeliveries();

        return {
            activeTab,
            deliveryForm,
            paymentForm,
            ratingForm,
            profileForm,
            deliveries,
            searchQuery,
            selectedDelivery,
            ratingDelivery,
            cost,
            eta,
            submitDelivery,
            initiatePayment,
            cancelDelivery,
            viewDelivery,
            openRatingModal,
            submitRating,
            updateProfile,
            filteredDeliveries,
            statusClass,
        };
    },
};
</script>

<style scoped>
.dashboard-container {
  padding: 2rem;
  max-width: 1200px;
  margin: auto;
  background: #f9f9f9;
  border-radius: 8px;
}

.dashboard-title {
  font-size: 2rem;
  font-weight: bold;
  text-align: center;
  margin-bottom: 1.5rem;
}

.tab-nav {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-bottom: 2rem;
}

.tab-link {
  padding: 0.75rem 1.5rem;
  margin: 0.25rem;
  border: none;
  background: #e0e0e0;
  color: #333;
  cursor: pointer;
  border-radius: 5px;
  transition: background 0.3s;
}

.tab-link.active,
.tab-link:hover {
  background: #007BFF;
  color: white;
}

.tab-content {
  background: white;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
}

.tab-title {
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 1rem;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.form-group input,
.form-group textarea,
.form-group select {
  padding: 0.5rem;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.btn {
  padding: 0.6rem 1.2rem;
  font-size: 1rem;
  margin-top: 1rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-primary {
  background-color: #28a745;
  color: white;
}

.btn-secondary {
  background-color: #17a2b8;
  color: white;
}

.btn-danger {
  background-color: #dc3545;
  color: white;
}

.btn-sm {
  padding: 0.4rem 0.8rem;
  font-size: 0.85rem;
}

.error {
  color: red;
  font-size: 0.85rem;
  margin-top: 0.25rem;
}

.cost-alert {
  margin-top: 1rem;
  background: #d1ecf1;
  color: #0c5460;
  padding: 0.75rem;
  border-radius: 5px;
}

.table-container {
  overflow-x: auto;
}

.delivery-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
}

.delivery-table th,
.delivery-table td {
  border: 1px solid #ddd;
  padding: 0.75rem;
  text-align: left;
}

.status-pending {
  color: #ffc107;
  font-weight: bold;
}

.status-completed {
  color: #28a745;
  font-weight: bold;
}

.status-cancelled {
  color: #dc3545;
  font-weight: bold;
}

.search-container {
  margin-bottom: 1rem;
}

.search-input {
  padding: 0.5rem;
  width: 100%;
  max-width: 300px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.select-container {
  margin-bottom: 1rem;
}

.track-select {
  padding: 0.5rem;
  width: 100%;
  max-width: 400px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.map-container {
  width: 100%;
  height: 300px;
  background-color: #e5e5e5;
  border-radius: 8px;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.6);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 999;
}

.modal-content {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  width: 90%;
  max-width: 600px;
  position: relative;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ddd;
  padding-bottom: 0.5rem;
  margin-bottom: 1rem;
}

.modal-close {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
}

@media (max-width: 768px) {
  .form-grid {
    grid-template-columns: 1fr;
  }

  .tab-link {
    flex: 1 1 auto;
  }
}

.estimated-cost {
  background-color: #e8f5e9;
  border-left: 5px solid #28a745;
  padding: 1rem;
  margin-top: 1rem;
  border-radius: 4px;
}

</style>

```