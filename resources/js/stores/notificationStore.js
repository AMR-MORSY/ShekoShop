import { defineStore } from 'pinia';
import { ref,computed } from 'vue';
 const useNotificationStore = defineStore('notification',()=> {
   
    const notificationVisible=ref(false)
    const notificationMessage=ref('');

    // const cartProductsCount=computed(()=>{
    //     if(cartProducts.value)
    //     {
    //         return JSON.parse(cartProducts.value).length; 
    //     }
    //     return 0;
    // })

    // function getCartProductsFromStorage() {

    //     cartProducts.value=localStorage.getItem('cartProducts')
        
    // }

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