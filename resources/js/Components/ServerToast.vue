<template>

    <div class="card flex justify-content-center">
        <Toast position="bottom-center" group="SFB">
            <template #message="slotProps">
                <div class="flex flex-column align-items-start" style="flex: 1">

                    <div class="font-medium text-sm my-3 text-900">{{ slotProps.message.summary }}</div>

                </div>
            </template>
        </Toast>

    </div>

    
</template>


<script setup>

import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';
import { onMounted, watch, watchEffect } from 'vue';

const props = defineProps({
    // severity: String | null,
    message: String | null,
    // group: String | null


})
const toast = useToast();



const mountToast = () => {
    console.log(props.summary)
    
    toast.add({
        severity:"error",
        life: 3000,
        summary: props.message,
        group: "SFB"
    })

}




onMounted(() => {

    mountToast()
})

</script>
