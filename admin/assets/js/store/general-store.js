import { defineStore } from 'pinia';

function initStorage(storageKey) {
  const storage = localStorage.getItem(storageKey) ? JSON.parse(localStorage.getItem(storageKey)) : {};
  return {
    get: function(key) {
      return storage[key] || null;
    },
    set: function(key, data) {
      storage[key] = data;

      return localStorage.setItem(storageKey, JSON.stringify(storage));
    },
    setPartial: function(partialKey) {
      const storageFunctions = this;
      return {
        get: function() {
          return storageFunctions.get(partialKey);
        },
        set: function(data) {
          return storageFunctions.set(partialKey, data);
        }
      }
    },
  }
}

const generalStoreLS = initStorage('generalStore');
const darkModeLS = generalStoreLS.setPartial('isDarkMode');

export const useGeneralStore = defineStore('general', {
  state: () => ({
    isSideMenuOpen: false,
    isDarkMode: !!darkModeLS.get(),
    modal: null,
    toaster: null,
    isPagesMenuOpen: false,
    appData: {}
  }),
  actions: {
    toggleDarkMode() {
      this.isDarkMode = !this.isDarkMode;
      darkModeLS.set(this.isDarkMode);
    },
    async initApp() {
      // const response = await fetch('/config.blade.php');
      // if (response.status === 200) {
      //   const apiUrl = await response.json();
      //   console.log('apiUrl', apiUrl);
      //   this.appData['apiUrl'] = apiUrl.api_url;
      //   console.log('this.appData', this.appData);

      //   this.setCookie();
      // } else {
      //   console.log('has error');
      // }
    },
    async setCookie() {
      // console.log('cookie');
      // const apiUrl = this.appData.apiUrl;
      // console.log('apiUrl', apiUrl);
      // if (apiUrl) {
      //   const response = await fetch(`${apiUrl}/confetti-cms/auth/login`);
      //   console.log('response', response);


      //   const {state, redirect_url} = await response.json();
      //   let date = new Date();
      //   date.setTime(date.getTime() + (10 * 60 * 1000));
      //   let expires = "; expires=" + date.toUTCString();
      //   document.cookie = "state=" + state + expires + "; path=/";
      //   // set cookie to redirect to this page after login
      //   document.cookie = "redirect_after_login=" + window.location.href + "; path=/";
      //   window.location.href = redirect_url;

      //   if (response.status === 200) {

      //   }
      // }
    },
    openModal(payload, closeOnConfirm = true) {
      const store = this;

      const defaultModal = {
        title: 'modal',
        icon: '',
        type: 'success',
        message: 'Weet je het zeker?',
        confirmButtonText: 'Ja, ik weet het zeker',
        cancelButtonText: 'Nee, terug',
      }

      const modal = {...defaultModal, ...payload}

      modal['onConfirm'] = () => {
        payload.onConfirm(store);
        if (closeOnConfirm) {
          this.modal = null;
        }
      }

      modal['onCancel'] = () => {
        if (payload.onCancel) {
          payload.onCancel(store);
        }
        this.modal = null;
      }

      this.modal = modal;
    }
  }
});
