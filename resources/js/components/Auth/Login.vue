<template>
    <div class="d-flex justify-content-center align-items-center vh-100">
      <div class="card shadow-sm p-4" style="width: 400px;">
        <h3 class="text-center mb-4">Login</h3>
        <form @submit.prevent="login">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" v-model="email" class="form-control" id="email" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" v-model="password" class="form-control" id="password" placeholder="Enter your password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="mt-3 text-center">
          <small>Don't have an account? <router-link to="/register">Register</router-link></small>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useStore } from 'vuex';
  import { useRouter } from 'vue-router';
  import { useToast } from "vue-toastification";

  const toast = useToast();
  const email = ref('');
  const password = ref('');
  const store = useStore();
  const router = useRouter();
  
  const login = async () => {
    try {
      await store.dispatch('login', { email: email.value, password: password.value });
      toast.success("Usuario autenticado exitosamente");
      router.push('/create-note');
    } catch (error) {
      if (error.response && error.response.data && error.response.data.errors) {
        const errors = error.response.data.errors;

        Object.keys(errors).forEach((field) => {
            errors[field].forEach((message) => {
                toast.error(message);
            });
        });
      } else {
          toast.error(error.response.data.message);
      }
    }
  };
  </script>
  
  <style scoped>
  .card {
    border-radius: 10px;
  }
  </style>
  