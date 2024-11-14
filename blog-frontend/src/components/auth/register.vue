<script setup>
import { ref } from 'vue';
import login_code from '@/composables/auth.js';
const { register } = login_code();

var randomNumber = Math.floor(Math.random() * 1000); 
var email_format = "test[]@gmail.com";  
var formattedEmail = email_format.replace('[]', randomNumber  );
const name=ref('jaskaran');
const email=ref(formattedEmail);
const password=ref('Guest@1234');
const password_confirmation=ref('Guest@1234');

const handleSubmit = () => {
    register(name.value,email.value,password.value,password_confirmation.value);
};
</script>
<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-semibold text-center text-gray-800">Register</h2>
      <form @submit.prevent="handleSubmit" class="space-y-4">
        <div class="space-y-2">
          <label for="name" class="text-sm font-medium text-gray-700">Name</label>
          <input
            type="text"
            id="name" 
            v-model="name"
            placeholder="Enter your Name"
            required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
          />
        </div>
        <div class="space-y-2">
          <label for="email" class="text-sm font-medium text-gray-700">Email</label>
          <input
            type="email"
            id="email" 
            v-model="email"
            placeholder="Enter your email"
            required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
          />
        </div>
        <div class="space-y-2">
          <label for="password" class="text-sm font-medium text-gray-700">Password</label>
          <input
            type="password" 
            id="password"
            v-model="password"
            placeholder="Enter your password"
            required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
          />
        </div>
        <div class="space-y-2">
          <label for="password" class="text-sm font-medium text-gray-700">Confirm Password</label>
          <input
            type="password" 
            id="password_confirmation"
            v-model="password_confirmation"
            placeholder="Confirm your password"
            required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
          />
        </div>
        
        <button
          type="submit"
          class="w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
        >
          Register
        </button>

      </form>
      <p>Already Have an account.  <RouterLink :to="{name:'login'}" ><button class=" px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-blue-400">Login</button></RouterLink></p>
    </div>
  </div>
</template>
<style scoped>
</style>