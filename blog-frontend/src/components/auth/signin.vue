<template>
    <div>
      hello
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  const postData = ref({});
  
  const extractFormData = () => {
    // Select all input fields with name attributes
    const inputs = document.querySelectorAll('input[name]');
    inputs.forEach((input) => {
      postData.value[input.name] = input.value;
    });
  };
  
  onMounted(() => {
    extractFormData();
    console.log('hhd');
    console.log(postData);
  });
  </script>
  
  <style scoped>
  /* Add your styles here */
  </style>
  