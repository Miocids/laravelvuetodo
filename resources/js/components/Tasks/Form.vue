<template>
    <nav-component></nav-component>
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Crear Tarea</div>

                    <div class="card-body">
                        
                        <form @submit.prevent="submitNote" class="mb-4">
                            <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input
                                type="text"
                                v-model="note.title"
                                id="title"
                                class="form-control"
                                required
                            />
                            </div>
                            <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea
                                v-model="note.description"
                                id="description"
                                class="form-control"
                                rows="3"
                                required
                            ></textarea>
                            </div>
                            <div class="mb-3">
                            <label for="tags" class="form-label">Etiquetas (separadas por comas)</label>
                            <input
                                type="text"
                                v-model="tagsInput"
                                id="tags"
                                class="form-control"
                            />
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Guardar Nota</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import notesApi from '../../services/notesService';
    import { useToast } from "vue-toastification";
    
    const toast = useToast();
    const note = ref({
    title: '',
    description: '',
    tags: [],
    });

    const notes = ref([]);
    const tagsInput = ref('');
    
  const submitNote = async () => {
    try {
      note.value.tags = tagsInput.value
        ? tagsInput.value.split(',').map(tag => tag.trim())
        : [];
  
      await notesApi.createNote({
        title: note.value.title,
        description: note.value.description,
        tags: note.value.tags,
      });
  
      toast.success("Tarea creada exitosamente")
      note.value.title = '';
      note.value.description = '';
      tagsInput.value = '';
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