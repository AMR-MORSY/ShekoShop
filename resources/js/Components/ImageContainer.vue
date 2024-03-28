<template>

    <div class=" w-full flex-column justify-center  items-center " @click="openImagesUploadingForm">
        <div class=" w-41 h-41 flex justify-center items-center hover:border hover:border-red-400 ">
            <img :src="path" class=" h-40 w-40" alt="">

        </div>
        <p class=" text-center text-black">Click to Update</p>

        <DynamicDialog />

    </div>
</template>

<script setup>
import { useDialog } from 'primevue/usedialog';
import ImagesUploadingForm from './ImagesUploadingForm.vue';

const props = defineProps({
    path:String|undefined,
    id:Number|undefined,
    property:String|undefined
})

const openImagesUploadingForm=()=>{
    dialog.open(ImagesUploadingForm, {
        modal: true,
        data:{
            id:props.id,
            property:props.property
        }
    });
}
const dialog=useDialog();

</script>
