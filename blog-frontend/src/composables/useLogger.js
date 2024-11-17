// composables/useLogger.js
import { onMounted, watch } from 'vue';
import { useAuthStore } from '@/store/authStore';
import { useRoute } from 'vue-router';

export function useLogger() {
  const authStore = useAuthStore();
  const route = useRoute();

  // Log initial token and user when the component mounts
  onMounted(() => {
  });

  // Watch for changes in the route
  watch(
    () => route.fullPath, // Watch the fullPath of the current route
    () => {
      console.log('Token (route change):', authStore.token); // Log token when route changes
      console.log('User (route change):', authStore.user);   // Log user when route changes
      //console.log('image:', authStore.profile);
    },
    { immediate: false } // Don't execute immediately on first run; only on route change
  );
}
