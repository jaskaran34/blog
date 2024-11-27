<script setup>
import { ref,onMounted } from 'vue';
import login_code from '@/composables/auth.js';
const { getprofile,profile_update } = login_code();

const call_update=  async()=>
{


  const formData = new FormData(); 
formData.append('name', user.value.name);
formData.append('image', user.value.update_img); 


  const myoro= await profile_update(formData);
  console.log(myoro);
    user.value.id=myoro.id;
    user.value.name=myoro.name;
    user.value.email=myoro.email;
};

const user = ref({
    id:null,
    name:null,
    email:null,
    image:null,
    check:null,
    update_img:null
});

const handleFileUpload = (event) => { 
  user.value.update_img=event.target.files[0];
  const file = event.target.files[0]; 
  const reader = new FileReader();
   reader.onload = () => {
     user.value.image = reader.result; 
      
    }; 
  reader.readAsDataURL(file); };

onMounted(async ()=>{
   const myPromise= await getprofile();
    user.value.id=myPromise.id;
    user.value.name=myPromise.name;
    user.value.email=myPromise.email;
    user.value.image=myPromise.image;
    user.value.check=myPromise.check;
    console.log(user)
});

</script>
<template>
    
    
  <div class="grid grid-cols-3 gap-4">
    <form class="col-start-2 space-y-6">
      <div class="space-y-4 rounded-md shadow-sm">
        <div>
          <div class="mt-1">
            <img :src="user.image" alt="Profile Image" class="h-[300px] w-[300px] rounded mr-3 mt-2"/>
            <label for="Picture" class="block text-sm font-medium text-gray-700">Update Profile Picture</label>
            <input type="file" id="image" @change="handleFileUpload"  >
          </div>
          <div class="mt-2">
            <label for="Id" class="block text-sm font-medium text-gray-700">Id</label>
            <input
                v-model="user.id"
                type="text"
                class="
                  block w-full mt-1 border-gray-300
                  rounded-md shadow-sm focus:border-indigo-300
                  focus-ring
                  focus:ring-indigo-200
                  focus:ring-opacity-5
"
            readonly>
          </div>
        </div>

        <div>
          <div class="mt-1">
            <label for="Name" class="block text-sm font-medium text-gray-700">Name</label>
            <input
                v-model="user.name"
                type="text"
                class="
                  block w-full mt-1 border-gray-300
                  rounded-md shadow-sm focus:border-indigo-300
                  focus-ring
                  focus:ring-indigo-200
                  focus:ring-opacity-5
"
            >
          </div>
        </div>

        <div>
          <div class="mt-1">
            <label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                v-model="user.email"
                type="text"
                class="
                  block w-full mt-1 border-gray-300
                  rounded-md shadow-sm focus:border-indigo-300
                  focus-ring
                  focus:ring-indigo-200
                  focus:ring-opacity-5
"
            readonly>
          </div>
        </div>

        <div>
          <div class="mt-1">
            
            <button v-if="user.check==0" type="button" @click="call_update()" class="bg-green-500 text-white font-bold rounded px-4 py-2 hover:bg-green-700">Update</button>
          </div>
        </div>

        
      </div>


    </form>

  </div>
</template>