import { defineStore } from 'pinia';
import { ref,computed } from 'vue';
 const useNotificationStore = defineStore('notification',()=> {
   
    const notificationVisible=ref(false)
    const notificationMessage=ref('');

   

    function showNotification(){
        notificationVisible.value=true;
    }
    function hideNotification(){
        notificationVisible.value=false;
        notificationMessage.value='';
    }

    return {
       notificationVisible,showNotification,hideNotification,notificationMessage
    }
  })

  export default useNotificationStore;