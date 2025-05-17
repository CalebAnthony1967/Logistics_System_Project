<template>
  <div class="estimate-container">
    <h1 class="estimate-title">Estimate a Delivery</h1>
    <form @submit.prevent="submitEstimate" class="estimate-form">
      <div class="field">
        <label>Weight (kg)</label>
        <input v-model.number="form.weight" type="number" step="0.1" min="0.1" required />
      </div>
      <div class="field">
        <label>Value (Ksh)</label>
        <input v-model.number="form.value" type="number" min="0" required />
      </div>
      <div class="field">
        <label>Source</label>
        <input v-model="form.source" type="text" required />
      </div>
      <div class="field">
        <label>Destination</label>
        <input v-model="form.destination" type="text" required />
      </div>
      <div class="field-checkbox">
        <label>
          <input v-model="form.urgent" type="checkbox" />
          Urgent Delivery (+500 Ksh)
        </label>
      </div>

      <button type="submit" class="btn">Get Estimate</button>
    </form>

    <div v-if="cost !== null" class="result">
      <p>Estimated Cost: <strong>{{ cost }} Ksh</strong></p>
      <button @click="proceed" class="btn btn-primary">Proceed & Create Delivery</button>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import axios from '@/axios';

export default {
  setup() {
    const form = ref({
      weight: null,
      value: null,
      source: '',
      destination: '',
      urgent: false,
    });
    const cost = ref(null);

    // Estimate only
    const submitEstimate = async () => {
      try {
        // POST to your real API
        const { data } = await axios.post('/api/deliveries/estimate', form.value);
        cost.value = data.cost;
      } catch (e) {
        console.error('Error estimating cost:', e);
        alert('Error calculating cost');
      }
    };

    // After estimate, actually create
    const proceed = async () => {
      try {
        await axios.post('/api/deliveries', form.value);
        alert('Delivery created successfully!');
        // Optionally redirect back to your main dashboard
        window.location.href = '/dashboard';
      } catch (e) {
        console.error('Error creating delivery:', e);
        alert('Error creating delivery');
      }
    };

    return { form, cost, submitEstimate, proceed };
  },
};
</script>

<style scoped>
.estimate-container {
  max-width: 500px;
  margin: auto;
  padding: 2rem;
  background: #fff;
  border-radius: 8px;
}
.estimate-title {
  text-align: center;
  margin-bottom: 1.5rem;
}
.field {
  margin-bottom: 1rem;
}
.field label {
  display: block;
  margin-bottom: 0.5rem;
}
.field input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}
.field-checkbox {
  margin-bottom: 1.5rem;
}
.btn {
  display: inline-block;
  padding: 0.6rem 1.2rem;
  background: #28a745;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.btn-primary {
  background: #007bff;
}
.result {
  margin-top: 2rem;
  text-align: center;
}
</style>
