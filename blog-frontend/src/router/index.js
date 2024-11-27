 import {createRouter,createWebHistory} from 'vue-router'
import PostIndex from '@/components/posts/PostIndex.vue'
import PostCreate from '@/components/posts/PostCreate.vue'
import PostEdit from '@/components/posts/PostEdit.vue'
import Login from '@/components/auth/login.vue'
import Logout from '@/components/auth/logout.vue'
import Profile from '@/components/auth/profile.vue'
import register from '@/components/auth/register.vue'
import signin from '@/components/auth/signin.vue'
import HandleData from '@/components/HandleData.vue'



import { useAuthStore } from '@/store/authStore';

 const routes=[
    {
        path:'/',name:'posts.index',component:PostIndex ,meta: { requiresAuth: true }
    }, 
      {  path:'/posts/create',name:'posts.create',component:PostCreate,meta: { requiresAuth: true }
      }
      ,
      {  path:'/posts/:id/edit',name:'post.edit',component:PostEdit,props:true,meta: { requiresAuth: true }
      },
      {  path:'/login',name:'login',component:Login,
      }
      ,
      {  path:'/logout',name:'logout',component:Logout,meta: { requiresAuth: true }
      }
      ,
      {  path:'/profile',name:'profile',component:Profile,meta: { requiresAuth: true }
      }
      ,
      {  path:'/register',name:'register',component:register
      },
      {  path:'/signin',name:'signin',component:signin
      }
      , { path: '/handle-data', name: 'handle.data', component: HandleData }
      
 ];

 const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();
  
    // Check if the route requires authentication
    if (to.meta.requiresAuth && !authStore.token) {
      // Redirect to login if token is null
      next({ path: '/login' });
    } else {
      next(); // Proceed to the route
    }
  });

export default router;
