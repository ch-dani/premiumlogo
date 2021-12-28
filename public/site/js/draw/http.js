const http = new class {
    constructor() { }

    getToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    async post(url, body = {}, headers = {}) {
        return await fetch(`${url}`, { method: 'post', body, headers: { ...headers, 'X-CSRF-TOKEN': this.getToken() } });
    }
    
    async get(url, query = '', headers = {}) {
        return await fetch(`${url}${query ? '?' + query : ''}`, { method: 'get', headers: { ...headers, 'X-CSRF-TOKEN': this.getToken() } });
    }

    async getLogoCategorieslist() {
        return dataStore.categories;
    }
};