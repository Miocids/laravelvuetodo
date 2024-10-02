<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <router-link to="/notes" class="navbar-brand">Inicio</router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link to="/create-note" active-class="active" class="nav-link">Nueva tarea</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/notes" active-class="active" class="nav-link">Tareas</router-link>
          </li>
        </ul>
        <span class="navbar-text ms-auto me-3">
          Bienvenido(a), {{ user?.name || 'Usuario' }}
        </span>
        <button @click="handleLogout" class="btn btn-outline-danger">Cerrar sesión</button>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import store from '../../store';
import { useRouter } from 'vue-router';
import { useToast } from "vue-toastification";

const toast = useToast();
const router = useRouter();

const user = computed(() => store.getters.user);

const handleLogout = async () => {
  try {
    await store.dispatch('logout');
    toast.success("Usuario desconectado con éxito");
    router.push('/login');
  } catch (error) {
    console.error('Error al cerrar sesión:', error);
  }
};

onMounted(() => {
  if (store.getters.isAuthenticated) {
    store.dispatch('fetchUser');
  }
});

</script>
