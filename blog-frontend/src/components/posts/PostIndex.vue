<script setup>

import { onBeforeMount,onMounted,onBeforeUnmount } from 'vue';
import usePosts from '@/composables/posts.js';
import { useAuthStore } from '@/store/authStore';
const authStore = useAuthStore();



//console.log(authStore.user.id)

const { posts, getPosts,delete_post,pop_message,clearPosts } = usePosts();


onBeforeMount( () => {
});

onMounted( async() => {
  
  await getPosts();
   
});





</script>
<template>
  
  <div class="grid grid-cols-1 gap-2 mt-2 p-4">
    <h1>Posts</h1>

    
    <table class="min-2-full divide-y divide-gray-300" v-if="posts && posts.length && authStore.user">
      <thead>
        <tr>
            <th scope="col" class="px-6 py-3 text-start text-sm uppercase">S.no</th>
          <th scope="col" class="px-6 py-3 text-start text-sm uppercase">Post Id</th>
          <th scope="col" class="px-6 py-3 text-start text-sm uppercase">User</th>
          <th scope="col" class="px-6 py-3 text-start text-sm uppercase">Title</th>
          <th scope="col" class="px-6 py-3 text-start text-sm uppercase">Date</th>
          <th scope="col" class="px-6 py-3 text-start text-sm uppercase">EDIT</th>
          <th scope="col" class="px-6 py-3 text-start text-sm uppercase">Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr class="hover:bg-gray-300" v-for="(post,index) in posts" :key="post.id">
        
        <td class="px-6 py-3 text-start text-sm">{{index + 1}}</td>
        <td class="px-6 py-3 text-start text-sm">{{post.id}}</td>
        <td class="px-6 py-3 text-start text-sm">{{post.user}}</td>
        <td class="px-6 py-3 text-start text-sm">{{post.title}}</td>
        <td class="px-6 py-3 text-start text-sm">{{post.created_at}}</td>
        <td>
          <router-link :to="{name:'post.edit',params:{id: post.id}}">
          <button v-if="authStore.user.id===post.user_id" class="bg-yellow-500 text-white font-bold rounded px-4 py-2 hover:bg-yellow-700">
            <font-awesome-icon icon="fa-pencil" class="h-4 w-4 mr-1" />Edit
          </button>
          </router-link>
          </td> 
        <td><button v-if="authStore.user.id===post.user_id" @click="delete_post(post.id)" class="bg-red-500 text-white font-bold rounded px-4 py-2 hover:bg-red-700"><font-awesome-icon icon="fa-trash" class="h-4 w-4 mr-1" />Delete</button></td>    
    </tr>
      </tbody>
    </table>
    <div v-else> No posts available. </div>
  </div>
  
  <!--
  <button class="bg-blue-700 text-white hover:bg-blue-700 rounded py-2 px-4">CREATE</button> 
   -->
</template>

