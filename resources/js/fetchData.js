import axios from "axios";
import useNotificationStore from "./stores/notificationStore";
import { storeToRefs } from "pinia";

export const fetchData = () => {
    const notificationStore=useNotificationStore();
    const { notificationMessage, notificationVisible } = storeToRefs(notificationStore)
    const basUrl = import.meta.env.VITE_BASE_URL;
    

function unauthorizedUnauthintecatedErrorResponse(error) {
    if (error.response.status == 419 || error.response.status == 403) {
    //   let response = error.response;
    //   if (response.config.method == "post") {
    //     router.push({ path: "/unauthorized/1" });
    //   } else if (response.config.method == "get") {
    //     router.push({ path: "/unauthorized/2" });
    //   }
    notificationMessage.value='Unauthorized please login first!!!!'
    notificationVisible.value=true;
    } 
    // else if (error.response.status == 401) {
    //   showUnauthintecatedToast();
    // }else if(error.response.status == 404)
    // {
    //   router.push({name:"notFound"});
    // }
  }
    const Api = axios.create({
        headers: {
            "Content-Type": "aplication/json",
            "Access-Control-Allow-Origin": "*",
        },
    });

    Api.defaults.withCredentials = true;
    Api.defaults.baseURL = basUrl;

    Api.interceptors.response.use(
        function (response) {
            return response;
        },
        function (error) {
            if (!error.response) {
                notificationMessage.value='Network error!!!!'
               notificationVisible.value=true;
            } else {
                unauthorizedUnauthintecatedErrorResponse(error);
            }

            return Promise.reject(error);
        }
    );

    const uploadApi = axios.create({
        headers: {
            "Content-Type": "multipart/form-data",
        },
    });

    uploadApi.defaults.withCredentials = true;
    uploadApi.defaults.baseURL = basUrl;
    return {
        Api,
        uploadApi,
    };
};
