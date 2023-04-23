<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';


const props = defineProps({
    programas: {type: Object}
});

const form = useForm({
    id:''
});

const deletePrograma = (id,nombre) => {
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
        if (result.isConfirmed) {form.delete(route('programas.destroy', id))}
    });
}


</script>

<template>
    <Head title="Programas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Programas</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <Link :href="route('programas.create')"
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
                                <th class="px-4 py-4">Programa</th>
                                <th class="px-4 py-4"></th>
                                <th class="px-4 py-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="dep, i in programas" :key="dep.id">
                                <td class="border border-gray-400 px-4 py-4">{{(i+1) }} </td>
                                <td class="border border-gray-400 px-4 py-4">{{dep.nombre }} </td>
                                <td class="border border-gray-400 px-4 py-4"> 
                                    <Link :href="route('programas.edit', dep.id)"
                                          :class="'px-4 py-2 bg-yellow-800 text-white border rounded-md font-semibold text-xs '">
                                          <i class="fa-solid fa-edit">Editar</i>
                                    </Link>

                                </td>
                                <td class="border border-gray-400 px-4 py-4"> 
                                    <DangerButton @click="deletePrograma(dep.id, dep.nombre)">
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
