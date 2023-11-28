export default function initStorage(storageKey) {
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