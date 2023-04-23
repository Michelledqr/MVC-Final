<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { nextTick, ref} from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import VueTailWindPagination from '@ocrv/vue-tailwind-pagination';
import Swal from 'sweetalert2';

const nameInput = ref(null);
const modal = ref(false);
const modal2 = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');

const props = defineProps({
    contenidos: {type: Object},
    programas: {type: Object},
    materias: {type: Object},
    profesors: {type: Object}
});

const form = useForm({
    idprograma:'', semestre:"", idmateria:'', idprofesor:'', idmateriapre:''
});

const formMateria = useForm({
    nombre:'', creditos:"", horasguia:'', horasauto:''
});


const formPage = useForm({});

const onPageClick =(event)=>{
    formPage.get(route('contenido.index', {page: event}));
}
const openModal = (op, contenido, idprograma, semestre, idmateria, idprofesor, idmateriapre) => {
    modal.value=true;
    //nextTick(()=> Input.value.focus());
    operation.value = op;
    id.value = contenido;

    if ( op===1){
        title.value = 'Crear Contenido';
    } else {   
        title.value = 'Editar Contenido';
        form.idprograma=idprograma;
        form.semestre=semestre;
        form.idmateria=idmateria;
        form.idprofesor=idprofesor;
        form.idmateriapre=idmateriapre;
    }
}

const closeModal = ()=>{
    modal.value = false;
    form.reset();
}

const openModal2 = (nombre, creditos, horasguia, horasauto) => {
    modal2.value=true;
    formMateria.nombre = nombre;
    formMateria.creditos = creditos;
    formMateria.horasguia = horasguia;
    formMateria.horasauto = horasauto;
}

const closeModal2 = ()=>{
    modal2.value = false;
    formMateria.reset();
}


const save = () =>{
    if( operation.value==1){
        form.post(route('contenidos.store'), {
            onSuccess: ()=>{ok('¡Guardado!')}
        });
    } else {
        form.put(route('contenidos.update', id.value), {
            onSuccess: ()=>{ok('¡Actualizado!')}
        });
    }
}

const ok = (msj) =>{
    form.reset();
    closeModal();
    Swal.fire({tittle:msj, icon:'success'});
}


const deleteContenido = (id) => {
    const alerta = Swal.mixin({
        buttonStyling:true
    });
    alerta.fire({
        title:'¿Confirma Borrar '+ id +'?',
        icon:'question',
        showCancelButton: true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Eliminar!',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result)=>{
        if (result.isConfirmed) {form.delete(route('contenidos.destroy', id), {
            onSuccess: ()=> {ok('Contenido eliminado')}
            });
        }
    });
}


</script>

<template>
    <Head title="Contenidos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Contenidos</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <PrimaryButton  @click="$event => openModal(1)">
                        <i class="fa-solid fa-plus-circle"></i>Agregar
                    </PrimaryButton>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center overflow-x-auto">
                    <table class="table-auto border border-gray-400">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-2 py-2">#</th>
                                <th class="px-2 py-2">Programa</th>
                                <th class="px-2 py-2">Semestre</th>
                                <th class="px-2 py-2">Materia</th>
                                <th class="px-2 py-2"></th>
                                <th class="px-2 py-2">Profesor</th>
                                <th class="px-2 py-2">Pre-requisito</th>
                                <th class="px-2 py-2"></th>
                                <th class="px-2 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="dep, i in contenidos" :key="dep.id">
                                <td class="border border-gray-400 px-2 py-2">{{(i+1) }} </td>
                                <td class="border border-gray-400 px-2 py-2">{{dep.programa}} </td>
                                <td class="border border-gray-400 px-2 py-2">{{dep.semestre}} </td>
                                <td class="border border-gray-400 px-2 py-2">{{dep.materia }} </td>
                                <td class="border border-gray-400 px-2 py-2">{{dep.profesor }} </td>
                                <td class="border border-gray-400 px-2 py-2">{{dep.materiapre}} </td>
                                
                                <td class="border border-gray-400 px-2 py-2"> 
                                
                                    <WarningButton @click="$event => openModal2( dep.materia, dep.creditos, dep.horasguia, dep.horasauto)">
                                        <i class="fa-solid fa-edit">Detalle materia</i>
                                    </WarningButton>
                                </td>


                                <td class="border border-gray-400 px-2 py-2"> 
                                    <WarningButton @click="$event => openModal(2, dep.id, dep.idprograma, dep.semestre, dep.idmateria, dep.idprofesor, dep.idmateriapre)">
                                        <i class="fa-solid fa-edit">Editar</i>
                                    </WarningButton>
                                </td>
                                <td class="border border-gray-400 px-2 py-2"> 
                                    <DangerButton @click="deleteContenido(dep.id)">
                                         <i class="fa-solid fa-trash">Borrar</i>
                                    </DangerButton>
                                </td>
                            </tr>
                        </tbody>  
                    </table>
            </div>
            <Modal :show="modal" @close="closeModal">
                <h2 class="p-3 text-lg font.medium text-hray-900">{{ title }}</h2>
                <div class="p-3">
                    <InputLabel for="idprograma" value="Programa: "></InputLabel>
                    <SelectInput id="idprograma" :options="programas" 
                    v-model="form.idprograma" type="number" class="mt-1 block w-3/4"></SelectInput>
                    <InputError :message="form.errors.idprograma"></InputError>
                </div>

                <div class="p-3">
                    <InputLabel for="semestre" value="Semestre: "></InputLabel>
                    <TextInput id="semestre" ref="idsemestreInput" 
                    v-model="form.semestre" type="number" class="mt-1 block w-3/4" ></TextInput>
                    <InputError :message="form.errors.semestre"></InputError>
                </div>
                
                <div class="p-3 ">
                    <InputLabel for="idmateria" value="Materia: "></InputLabel>
                    <SelectInput id="idmateria" :options="materias"
                    v-model="form.idmateria" type="text" class="mt-1 block w-3/4"></SelectInput>
                    <InputError :message="form.errors.idprograma"></InputError>
                </div>
                
                <div class="p-3">
                    <InputLabel for="idprofesor" value="Profesor: "></InputLabel>
                    <SelectInput id="idprofesor" :options="profesors"
                    v-model="form.idprofesor" type="text" class="mt-1 block w-3/4"
                     ></SelectInput>
                    <InputError :message="form.errors.idprofesor" class="mt-2"></InputError>
                </div>
                
                <div class="p-3">
                    <InputLabel for="idmateriapre" value="Pre-requisito "></InputLabel>
                    <SelectInput id="idmateriapre" :options="materias" 
                    v-model="form.idmateriapre" type="text" class="mt-1 block w-3/4" 
                    ></SelectInput>
                    <InputError :message="form.errors.idmateriapre"></InputError>
                </div>
                <div class="p-3 mt-6">
                    <PrimaryButton :disabled="form.processing" @click="save">
                        <i class="fa-solid fa-save">Guardar</i>
                    </PrimaryButton>
                    <SecondaryButton :disabled="form.processing" @click="closeModal" class="ml-3">
                        Cancelar
                    </SecondaryButton>

                </div>
                <div class="p-3 mt-6 justify-">
                </div>
            </Modal>
            <Modal :show="modal2" @close="closeModal2">
                
                <h3 class="p-3 text-lg font.medium text-hray-900">Intensidad Horaria</h3>
                <div class="p-3">Asignatura      : {{ formMateria.nombre }} </div>
                <div class="p-3">Créditos        : {{ formMateria.creditos }} </div>
                <div class="p-3">Horas Cátedra   : {{ formMateria.horasguia }} </div>
                <div class="p-3">Horas Autónomas : {{ formMateria.horasauto }} </div>

                <div class="p-3 mt-6">
                    <SecondaryButton :disabled="form.processing" @click="closeModal2" class="ml-3">
                        Cerrar
                    </SecondaryButton>
                </div>

            </Modal>

 
 
        </div>
    </AuthenticatedLayout>
</template>
/