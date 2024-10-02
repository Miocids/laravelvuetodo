<template>
    <div class="d-flex justify-content-center align-items-center vh-100">
      <div class="card shadow-sm p-4" style="width: 400px;">
        <h3 class="text-center mb-4">Register</h3>
        <form @submit.prevent="register">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" v-model="name" class="form-control" id="name" placeholder="Enter your name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" v-model="email" class="form-control" id="email" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" v-model="password" class="form-control" id="password" placeholder="Enter your password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
        <div class="mt-3 text-center">
          <small>Already have an account? <router-link to="/login">Login</router-link></small>
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
  const name = ref('');
  const email = ref('');
  const password = ref('');
  const store = useStore();
  const router = useRouter();
  
  const register = async () => {
    try {
      await store.dispatch('register', { name: name.value, email: email.value, password: password.value });
      toast.success("Registration successful!");  
      router.push('/notes');
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
  