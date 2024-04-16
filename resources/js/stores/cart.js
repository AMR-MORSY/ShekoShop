import { defineStore } from 'pinia';
import { ref,computed } from 'vue';
 const useCartStore = defineStore('cart',()=> {
    const cartProducts=ref(localStorage.getItem('cartProducts'))
    const sideCartVisible=ref(false)

    const cartProductsCount=computed(()=>{
        if(cartProducts.value)
        {
            return JSON.parse(cartProducts.value).length; 
        }
        return 0;
    })

    function getCartProductsFromStorage() {

        cartProducts.value=localStorage.getItem('cartProducts')
        
    }

    function showSideCart(){
        sideCartVisible.value=true;
    }
    function hideSideCart(){
        sideCartVisible.value=false;
    }

    return {
        cartProducts,cartProductsCount,getCartProductsFromStorage,sideCartVisible,showSideCart,hideSideCart
    }
  })

  export default useCartStore;