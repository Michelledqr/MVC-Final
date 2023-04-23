<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({materia:{type:Object}});
const form = useForm({
    nombre:props.materia.nombre,
    creditos:props.materia.creditos,
    horasguia:props.materia.horasguia,
    horasauto:props.materia.horasauto
});


</script>

<template>
    <Head title="Editar Materia" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Materia</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="form.patch(route('materias.update', materia))"
                    class="mt-6 space-y-6 max-w-xl">

                        <InputLabel for="nombre" value="Materia"></InputLabel>
                        <TextInput id="nombre" v-model="form.nombre" autofocus required
                        type="text"
                        class="mt-1 block w-full"></TextInput>
                        <InputError :message="form.errors.nombre" class="mt-2"></InputError>

                        <InputLabel for="creditos" value="Creditos Académicos"></InputLabel>
                        <TextInput id="creditos" v-model="form.creditos" autofocus required
                        type="number"
                        class="mt-1 block w-full"></TextInput>
                        <InputError :message="form.errors.creditos" class="mt-2"></InputError>

                        <InputLabel for="horasguia" value="Horas Cátedra"></InputLabel>
                        <TextInput id="horasguia" v-model="form.horasguia" autofocus required
                        type="number"
                        class="mt-1 block w-full"></TextInput>
                        <InputError :message="form.errors.horasguia" class="mt-2"></InputError>

                        <InputLabel for="horasguia" value="Horas Autónomas"></InputLabel>
                        <TextInput id="horasauto" v-model="form.horasauto" autofocus required
                        type="number"
                        class="mt-1 block w-full"></TextInput>
                        <InputError :message="form.errors.horasauto" class="mt-2"></InputError>
                        
                        <PrimaryButton :disabled="form.processing">
                            <i class="fa-solid fa-save"></i>Guardar
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
