<template>
    <div>
       
    </div>
</template>


<script setup>
import { onMounted,ref } from 'vue';

import login_code from '@/composables/auth.js';
const { sso } = login_code();

onMounted(async()=>{
  

const urlParams = new URLSearchParams(window.location.search); 


await sso(urlParams.get('id'));


});


</script>
