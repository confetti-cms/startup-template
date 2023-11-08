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
    toaster: null
  }),
  actions: {
    toggleDarkMode() {
      this.isDarkMode = !this.isDarkMode;
      darkModeLS.set(this.isDarkMode);
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
