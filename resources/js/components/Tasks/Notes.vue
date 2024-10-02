<template>
    <nav-component></nav-component>
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" v-if="notes.length">
                    <div class="card-header text-center">
                        <h2>Tareas Guardadas</h2>
                    </div>
            
                    <div class="card-body">
                        <ul class="list-group">
                        <li v-for="n in notes" :key="n.id" class="list-group-item">
                            <label for="">Título</label>
                            <input 
                            v-model="n.title" 
                            class="form-control mb-2" 
                            :disabled="!n.isEditing"
                            />
                            <label for="">Descripción</label>
                            <textarea 
                            v-model="n.description" 
                            class="form-control mb-2" 
                            :disabled="!n.isEditing"
                            ></textarea>
                            <label for="">Etiquetas</label>
                            <input
                            v-model="n.tags"
                            class="form-control mb-2"
                            placeholder="Etiquetas (separadas por comas)"
                            :disabled="!n.isEditing"
                            />
                            <label for="">Creado hace</label>
                            <input
                            class="form-control mb-2"
                            placeholder="Creada"
                            :value="n.created_at"
                            disabled
                            />
                            <div class="d-flex justify-content-end">
                                <button
                                v-if="n.isEditing"
                                @click="saveNote(n.id)"
                                class="btn btn-success btn-sm me-2"
                                >
                                Guardar
                                </button>
                                <button
                                @click="toggleEdit(n)"
                                class="btn btn-primary btn-sm ms-3"
                                >
                                {{ n.isEditing ? 'Cancelar' : 'Editar' }}
                                </button>
                                <button
                                @click="deleteNote(n.id)"
                                class="btn btn-danger btn-sm ms-3"
                                >
                                Eliminar
                                </button>
                            </div>
                        </li>
                        </ul>
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
  const notes = ref([]);
  
  const fetchNotes = async () => {
    try {
      const response = await notesApi.getNotes();
      notes.value = response.data.data.map(note => ({ ...note, isEditing: false }));
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
  
  const toggleEdit = (note) => {
    note.isEditing = !note.isEditing;
  };
  
  const saveNote = async (id) => {
    const noteToUpdate = notes.value.find(n => n.id === id);
    try {
      await notesApi.updateNote(id, {
        title: noteToUpdate.title,
        description: noteToUpdate.description,
        tags: noteToUpdate.tags.split(',').map(tag => tag.trim()),
      });
      toast.success("Tarea actualizada exitosamente")
      toggleEdit(noteToUpdate);
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
  
  const deleteNote = async (id) => {
    try {
      await notesApi.deleteNote(id);
      toast.success("Tarea eliminada exitosamente");
      fetchNotes();
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
  
  onMounted(fetchNotes);
</script>