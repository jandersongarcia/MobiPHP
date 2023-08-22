class StorageManager {
    constructor(storageType = 'localStorage') {
        this.storage = window[storageType];
    }

    setItem(key, value) {
        try {
            this.storage.setItem(key, JSON.stringify(value));
        } catch (error) {
            throw new Error('Error while setting item: ' + error.message);
        }
    }

    getItem(key) {
        try {
            const item = this.storage.getItem(key);
            return item ? JSON.parse(item) : null;
        } catch (error) {
            throw new Error('Error while getting item: ' + error.message);
        }
    }

    removeItem(key) {
        try {
            this.storage.removeItem(key);
        } catch (error) {
            throw new Error('Error while removing item: ' + error.message);
        }
    }

    clear() {
        try {
            this.storage.clear();
        } catch (error) {
            throw new Error('Error while clearing storage: ' + error.message);
        }
    }
}