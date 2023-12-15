import { defineStore } from 'pinia';

export const useDataStore = defineStore('data', {
  state: () => ({
    currentFooter: '/view/footers/footer.blade.php',
  }),
  actions: {

  }
});
