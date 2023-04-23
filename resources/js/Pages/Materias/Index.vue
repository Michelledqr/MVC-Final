<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';


const props = defineProps({
    materias: {type: Object}
});

const form = useForm({
    id:''
});

const deleteMateria = (id,nombre) => {
    const alerta = Swal.mixin({
        buttonStyling:true
    });
    alerta.fire({
        title:'¿Confirma Borrar '+ nombre + '?',
        icon:'question',
        showCancelButton: true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Eliminar!',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result)=>{
        if (result.isConfirmed) {form.delete(route('materias.destroy', id))}
    });
}


</script>

<template>
    <Head title="Materias" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Materias</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <Link :href="route('materias.create')"
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
                                <th class="px-4 py-4">Materia</th>
                                <th class="px-4 py-4">Créditos</th>
                                <th class="px-4 py-4">Horas Cátedra</th>
                                <th class="px-4 py-4">Horas Autonomas</th>
                                <th class="px-4 py-4"></th>
                                <th class="px-4 py-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="dep, i in materias" :key="dep.id">
                                <td class="border border-gray-400 px-4 py-4">{{(i+1) }} </td>
                                <td class="border border-gray-400 px-4 py-4">{{dep.nombre }} </td>
                                <td class="border border-gray-400 px-4 py-4">{{dep.creditos }} </td>
                                <td class="border border-gray-400 px-4 py-4">{{dep.horasguia }} </td>
                                <td class="border border-gray-400 px-4 py-4">{{dep.horasauto }} </td>
                                <td class="border border-gray-400 px-4 py-4"> 
                                    <Link :href="route('materias.edit', dep.id)"
                                          :class="'px-4 py-2 bg-yellow-800 text-white border rounded-md font-semibold text-xs '">
                                          <i class="fa-solid fa-edit">Editar</i>
                                    </Link>

                                </td>
                                <td class="border border-gray-400 px-4 py-4"> 
                                    <DangerButton @click="deleteMateria(dep.id, dep.nombre)">
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
