<template>
    <div>
        <form enctype="multipart/form-data" @submit.prevent="uploadImage">
            <div class=" grid grid-cols-2 gap-4">

                <div class=" col-span-2 md:col-span-1">

                    <label for="images">Images</label>
                    <input id="images" class="block mt-1 w-full" type='file' multiple @change="getFiles($event)"
                        autocomplete="images" />



                    <p class=" text-red-400"></p>





                </div>
                <div class=" col-span-2 md:col-span-1">
                    <SpinnerButton type="submit" label="Upload" :spine="spine"/>
                </div>

            </div>


        </form>
    </div>

</template>

<script setup>
import { reactive, ref } from 'vue';
import SpinnerButton from './SpinnerButton.vue';
import { fetchData } from '../fetchData';
import { inject } from "vue";

const dialogRef = inject('dialogRef');
const spine=ref(false) ;

const form=reactive({
    images:''
})

const upload=(url)=>{
    const { uploadApi } = fetchData();
    uploadApi.post(url,form).then((response)=>{
        spine.value=false;
        console.log(response)
        window.location.href = response.data.redirect;
    })

}
const uploadImage=()=>{
    spine.value=true;
   if(dialogRef.value.data.property=="devision")
   {
    let url=`/admin/devisions/images/${dialogRef.value.data.id}`;
    upload(url)
   }
   else if(dialogRef.value.data.property=="category")
   {
    let url=`/admin/categories/images/${dialogRef.value.data.id}`;
    upload(url)

   }
   

}
const getFiles=(event)=>{
    console.log(event.target.files)
    form.images=Object.values(event.target.files) 


}

</script>
