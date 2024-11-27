import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/store/authStore';

import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';


export default function login_code(){

    const router = useRouter();
    
    
    const authStore = useAuthStore();

    const getprofile= async()=>{

      try{
        // console.log(`Bearer ${authStore.token}`);
     let res = await axios.get(`${authStore.baseURL}/profile`,{
     headers: {
       Authorization: `Bearer ${authStore.token}`
     }
   });

        console.log(res.data);
        

   let profile_picture="data:image/jpg;base64,"+ res.data.image;
   
   
  return {
    id:res.data.user.id,
    name:res.data.user.name,
    email:res.data.user.email,
    image:profile_picture,
    check:res.data.check,
    
  }
   
 }
     catch(e){
         console.log(e);
       

    }
  }
  const profile_update= async(formData)=>{

    try{
      console.clear();
     console.log(formData);
   let res = await axios.post(`${authStore.baseURL}/profile/update`,formData,{
   headers: {
     Authorization: `Bearer ${authStore.token}`
   }
 });
 console.log(res);
 const $toast = useToast();
                $toast.success('Profile Updated', {
                position: 'bottom-right',
                    duration: 5000
                });
                let profile_picture="data:image/jpg;base64,"+ res.data.image;
                authStore.setAuthData(res.data.user, authStore.token,profile_picture);            
return {

  id:res.data.user.id,
    name:res.data.user.name,
    email:res.data.user.email,
    image:profile_picture,
}

                
 
}
   catch(e){
       console.log(e);
     

  }

}

const sso = async(id)=> {
  console.log(id);

  try {
    let res = await axios.get(`${authStore.baseURL}/sso/${id}`)
    console.log(res);
    if (res.data.access_token) {
    const { access_token, user,image } = res.data;
    let profile_picture="data:image/jpg;base64,"+ image;
    
    authStore.setAuthData(user, access_token,profile_picture);
    //console.log(authStore.token);
    await router.push({name: 'posts.index'});
    //console.clear();
    }
    else if (res.data.error) {
        // Handle invalid credentials case
        alert(res.data.error);
      }
    }
    catch (error) {
        console.error("Login error:", error);
        alert("An error occurred. Please try again.");
      }


}

    const login = async (email,password) => {

        const param={
            email,
            password
        }
        //console.log();
        try {
        let res = await axios.post(`${authStore.baseURL}/login`,param)
        
        if (res.data.access_token) {
        const { access_token, user,image } = res.data;
        let profile_picture="data:image/jpg;base64,"+ image;
        
        authStore.setAuthData(user, access_token,profile_picture);
        //console.log(authStore.token);
        await router.push({name: 'posts.index'});
        //console.clear();
        }
        else if (res.data.error) {
            // Handle invalid credentials case
            alert(res.data.error);
          }
        }
        catch (error) {
            console.error("Login error:", error);
            alert("An error occurred. Please try again.");
          }

    }

    const register = async (formData) => {

     
      //console.log();
      try {
      let res = await axios.post(`${authStore.baseURL}/register`,formData)
      //console.log(res); 
      if (res.data.access_token) {
      const { access_token, user,image } = res.data;
      let profile_picture="data:image/jpg;base64,"+ image;
      authStore.setAuthData(user, access_token,profile_picture);
      //console.log(authStore.token);
      await router.push({name: 'posts.index'});
      //console.clear();
      }
      else if (res.data.error) {
          // Handle invalid credentials case
          alert(res.data.error);
        }
      }
      catch (error) {
          console.error("Register error:", error);
          alert("An error occurred. Please try again.");
        }

  }
    

    

    return {
        login,getprofile,profile_update,register,sso
      };
}
