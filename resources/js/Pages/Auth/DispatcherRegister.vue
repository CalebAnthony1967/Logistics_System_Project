<template>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Register as Dispatcher</h1>
        <form @submit.prevent="submit">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input v-model="form.name" type="text" class="mt-1 block w-full border-gray-300 rounded-md" required autofocus />
                <span v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input v-model="form.email" type="email" class="mt-1 block w-full border-gray-300 rounded-md" required />
                <span v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input v-model="form.phone" type="text" class="mt-1 block w-full border-gray-300 rounded-md" required />
                <span v-if="form.errors.phone" class="text-red-500 text-sm">{{ form.errors.phone }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <input v-model="form.address" type="text" class="mt-1 block w-full border-gray-300 rounded-md" required />
                <span v-if="form.errors.address" class="text-red-500 text-sm">{{ form.errors.address }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                <input v-model="form.vehicle_type" type="text" class="mt-1 block w-full border-gray-300 rounded-md" required />
                <span v-if="form.errors.vehicle_type" class="text-red-500 text-sm">{{ form.errors.vehicle_type }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Vehicle Capacity</label>
                <input v-model="form.vehicle_capacity" type="text" class="mt-1 block w-full border-gray-300 rounded-md" required />
                <span v-if="form.errors.vehicle_capacity" class="text-red-500 text-sm">{{ form.errors.vehicle_capacity }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input v-model="form.password" type="password" class="mt-1 block w-full border-gray-300 rounded-md" required />
                <span v-if="form.errors.password" class="text-red-500 text-sm">{{ form.errors.password }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input v-model="form.password_confirmation" type="password" class="mt-1 block w-full border-gray-300 rounded-md" required />
                <span v-if="form.errors.password_confirmation" class="text-red-500 text-sm">{{ form.errors.password_confirmation }}</span>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Register</button>
            </div>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
    setup() {
        const form = useForm({
            name: '',
            email: '',
            phone: '',
            address: '',
            vehicle_type: '',
            vehicle_capacity: '',
            password: '',
            password_confirmation: '',
        });

        function submit() {
            form.post(route('dispatcher.register.store'), {
                onSuccess: () => {
                    form.reset();
                },
            });
        }

        return { form, submit };
    },
};
</script>