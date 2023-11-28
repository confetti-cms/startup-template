import { createApp, ref } from 'vue';
import {
  createPinia,
  defineStore
} from 'pinia';
import AppButton from './components/button.js'
import { storeToRefs } from 'pinia';
import { plugin, defaultConfig } from '@formkit/vue'
import { autoAnimatePlugin } from '@formkit/auto-animate'
import initStorage from './helpers/storage.js';

const pinia = createPinia()

import { useGeneralStore } from './store/general-store.js';
createApp({
    components: {
        AppButton,
    },
    setup() {
      const generalStore = useGeneralStore();
      generalStore.initApp();

      // console.log("login redirect begin");

      // let apiUrl;


      // let xhr2 = new XMLHttpRequest();
      // xhr2.open('GET', '/config.blade.php', true);
      // xhr2.responseType = 'json';
      // xhr2.onload = function () {
      //   let status = xhr2.status;
      //   if (status === 200) {
      //     apiUrl = xhr2.response.api_url
      //     // Alpine.store('config').setApiUrl(xhr2.response.api_url);
      //     document.dispatchEvent(new CustomEvent('config:init'));
      //   } else {
      //     console.error(status, xhr2.response);
      //     // Alpine.store('config').setApiUrl('error_from_config');
      //   }
      // };
      // xhr2.send()

      // setTimeout(() => {

      //       // let apiUrl = Alpine.store('config').getApiUrl()

      //       if (apiUrl === undefined) {
      //           console.error('apiUrl is undefined')
      //       }
      //       // Get redirect url
      //       let xhr = new XMLHttpRequest();
      //       xhr.open('GET', apiUrl + '/confetti-cms/auth/login', true);
      //       xhr.responseType = 'json';
      //       xhr.setRequestHeader('Accept', 'application/json');
      //       xhr.onload = function () {
      //           let status = xhr.status;
      //           console.log('xhr', xhr);

      //           if (status === 200) {
      //               let date = new Date();
      //               date.setTime(date.getTime() + (10 * 60 * 1000));
      //               let expires = "; expires=" + date.toUTCString();
      //               document.cookie = "state=" + xhr.response["state"] + expires + "; path=/";
      //               // set cookie to redirect to this page after login
      //               document.cookie = "redirect_after_login=" + window.location.href + "; path=/";
      //               window.location.href = xhr.response["redirect_url"];
      //           } else {
      //               console.error(status, xhr.response);
      //           }
      //       };
      //       xhr.send()
      //       console.log("request send");

      //     }, 4000);

      const {
        toggleDarkMode,
        isSideMenuOpen,
      } = generalStore;

      const {
        isDarkMode,
        modal,
        isPagesMenuOpen
      } = storeToRefs(generalStore);
      function openModal() {
        generalStore.openModal({
          message: '1234',
          onConfirm: () => {
            console.log('on confirm');
          },
        });
      }

      console.log(' isPagesMenuOpen',  isPagesMenuOpen);

      function makejs(value) {
        console.log('value!!!!!', value);

      }


      function togglePagesMenu() {
        isPagesMenuOpen.value = !isPagesMenuOpen.value;
      }

        return {
          modal,
          isDarkMode,
          openModal,
          toggleDarkMode,
          isSideMenuOpen,
          isPagesMenuOpen,
          togglePagesMenu,
          makejs
        }
    }
})
.use(plugin, defaultConfig)
.use(autoAnimatePlugin)
.use(pinia)
.mount('#app')