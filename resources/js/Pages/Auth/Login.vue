<template>
    <guest-layout>
        <div class="login-header">
            <h1 class="system-title">Logistics System</h1>
        </div>

        <div class="login-card">
            <h2 class="card-title mb-4">Login</h2>
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input v-model="form.email" type="email" class="form-control" id="email" required autofocus />
                    <div v-if="form.errors.email" class="text-danger small">{{ form.errors.email }}</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input v-model="form.password" type="password" class="form-control" id="password" required />
                    <div v-if="form.errors.password" class="text-danger small">{{ form.errors.password }}</div>
                </div>

                <div class="mb-3 form-check">
                    <input v-model="form.remember" type="checkbox" class="form-check-input" id="remember" />
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a v-if="canResetPassword" :href="route('password.request')" class="btn btn-link">
                        Forgot your password?
                    </a>
                    <button type="submit" class="btn btn-primary">Log in</button>
                </div>
            </form>
        </div>
    </guest-layout>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

export default {
    components: { GuestLayout },
    props: {
        canResetPassword: Boolean,
        errors: Object,
        auth: Object,
    },
    setup() {
        const form = useForm({
            email: '',
            password: '',
            remember: false,
        });

        function submit() {
            form.post(route('login'), {
                onSuccess: () => form.reset('password'),
            });
        }

        return { form, submit, route };
    },
};
</script>

<style scoped>
.login-header {
  width: 100%;
  background-color: #007BFF;
  color: white;
  padding: 1rem 0;
  text-align: center;
}

.system-title {
  font-size: 2rem;
  font-weight: bold;
  margin: 0;
}

.login-card {
  max-width: 500px;
  margin: 2rem auto;
  padding: 2rem;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0,0,0,0.05);
}

.card-title {
  font-size: 1.5rem;
  text-align: center;
  font-weight: 600;
}

@media (max-width: 768px) {
  .system-title {
    font-size: 1.5rem;
  }

  .login-card {
    padding: 1.5rem 1rem;
  }

  .card-title {
    font-size: 1.25rem;
  }
}

@media (max-width: 480px) {
  .system-title {
    font-size: 1.25rem;
  }

  .login-card {
    padding: 1rem;
  }

  .card-title {
    font-size: 1.125rem;
  }
}
</style>
