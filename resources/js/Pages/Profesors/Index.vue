<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';


const props = defineProps({
    profesors: {type: Object}
});

const form = useForm({
    id:''
});

const deleteProfesor = (id,nombre) => {
    const alerta = Swal.mixin({
        buttonStyling:true
    });
    alerta.fire({
        title:'¿Confirma Borrar '+nombre + '?',
        icon:'question',
        showCancelButton: true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Eliminar!',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result)=>{
        if (result.isConfirmed) {form.delete(route('profesors.destroy', id))}
    });
}


</script>

<template>
    <Head title="Profesores" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profesores</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <Link :href="route('profesors.create')"
                    :class="'px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs '">
                    <i class="fa-solid fa-plus-circle"></i>Agregar
                    </Link>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                    <table class="table-auto border border-gray-400">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-4">#</th>
                                <th class="px-4 py-4">Profesor</th>
                                <th class="px-4 py-4"></th>
                                <th class="px-4 py-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="dep, i in profesors" :key="dep.id">
                                <td class="border border-gray-400 px-4 py-4">{{(i+1) }} </td>
                                <td class="border border-gray-400 px-4 py-4">{{dep.nombre }} </td>
                                
                                <td class="border border-gray-400 px-4 py-4"> 
                                    <Link :href="route('profesors.edit', dep.id)"
                                          :class="'px-4 py-2 bg-yellow-800 text-white border rounded-md font-semibold text-xs '">
                                          <i class="fa-solid fa-edit">Editar</i>
                                    </Link>
                                </td>
                                <td class="border border-gray-400 px-4 py-4"> 
                                    <DangerButton @click="deleteProfesor(dep.id, dep.nombre)">
                                         <i class="fa-solid fa-trash">Borrar</i>
                                    </DangerButton>
                                </td>
                            </tr>
                        </tbody>  
                    </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
