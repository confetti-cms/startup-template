import { defineStore } from 'pinia';
import {ref} from 'vue';

export const useDataStore = defineStore('data', {
  state: () => ({
    formData: {}
  }),
  actions: {
    updateFormData(key, data) {
      this.formData[key] = data;
    },
    getFormValue(key) {
      return this.formData[key];
    }
  },
});
