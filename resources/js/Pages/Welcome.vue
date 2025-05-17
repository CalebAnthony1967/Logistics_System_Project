<template>
    <div class="container mt-4">
        <h1 class="display-4">Welcome to Logistics System</h1>
        <p class="lead">This is the welcome page for your logistics application.</p>
        <div class="mt-4">
            <a v-if="canLogin" href="/login" class="btn btn-link">Login</a>
            <span v-if="canLogin && canRegister"> | </span>
            <a v-if="canRegister" href="/register" class="btn btn-link">Register</a>
            <span v-if="canRegister"> | </span>
            <a href="/dispatcher/register" class="btn btn-link">Register as Dispatcher</a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Welcome',
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        auth: Object,
        errors: Object,
    },
};
</script>

<style scoped>
.container {
    max-width: 700px;
    margin: 3rem auto;
    padding: 2rem;
    background: linear-gradient(145deg, #f4f6f8, #ffffff);
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    text-align: center;
    transition: all 0.3s ease-in-out;
}

.display-4 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1rem;
    text-shadow: 1px 1px 1px #e5e7eb;
}

.lead {
    font-size: 1.25rem;
    color: #4b5563;
    margin-bottom: 2rem;
}

.btn-link {
    display: inline-block;
    margin: 0.5rem;
    padding: 0.6rem 1.4rem;
    background-color: #3b82f6;
    color: white;
    font-weight: 600;
    text-decoration: none;
    border-radius: 8px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-link:hover {
    background-color: #2563eb;
    transform: translateY(-2px);
}

.btn-link:active {
    transform: scale(0.98);
}

/* -------------------- MEDIA QUERIES -------------------- */

/* Mobile: <576px */
@media (max-width: 575.98px) {
    .container {
        padding: 1.5rem 1rem;
        margin: 1.5rem 0.5rem;
    }

    .display-4 {
        font-size: 1.6rem;
    }

    .lead {
        font-size: 1rem;
    }

    .btn-link {
        display: block;
        width: 100%;
        margin: 0.5rem 0;
        font-size: 1rem;
    }
}

/* Tablet: 576px - 991px */
@media (min-width: 576px) and (max-width: 991.98px) {
    .container {
        padding: 2rem;
    }

    .display-4 {
        font-size: 2rem;
    }

    .lead {
        font-size: 1.1rem;
    }

    .btn-link {
        padding: 0.5rem 1.2rem;
        font-size: 1rem;
    }
}

/* Desktop: =992px */
@media (min-width: 992px) {
    .container {
        max-width: 700px;
    }

    .display-4 {
        font-size: 2.5rem;
    }

    .lead {
        font-size: 1.25rem;
    }

    .btn-link {
        font-size: 1.05rem;
    }
}
</style>
