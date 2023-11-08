import { createApp, ref } from 'vue';
import {
  createPinia,
  defineStore
} from 'pinia';
import AppButton from './components/button.js'
import { storeToRefs } from 'pinia';
import { plugin, defaultConfig } from '@formkit/vue'

const pinia = createPinia()

import { useGeneralStore } from './store/general-store.js';
createApp({
    components: {
        AppButton,
    },
    setup() {
      const generalStore = useGeneralStore();
      const { toggleDarkMode, isSideMenuOpen } = generalStore;
      const { isDarkMode, modal } = storeToRefs(generalStore);
      function openModal() {
        generalStore.openModal({
          message: '1234',
          onConfirm: () => {
            console.log('on confirm');
          },
        });
      }
        return {
          modal,
          isDarkMode,
          openModal,
          toggleDarkMode,
          isSideMenuOpen
        }
    }
})
.use(plugin, defaultConfig)
.use(pinia)
.mount('#app')