import axios from "axios";

export const fetchData=()=>{

    const basUrl = import.meta.env.VITE_BASE_URL;
    const Api=axios.create({
        headers:{
            "Content-Type": "aplication/json",
            'Access-Control-Allow-Origin': '*',

        }
    });

    Api.defaults.withCredentials = true;
    Api.defaults.baseURL = basUrl;


    return{
        Api
    }

}

  
