import { autoInitAll } from './search';

// Auto-init live search inputs that have data-live-search="true"
// Keeps auto-init separate so this module can be included only where needed

document.addEventListener('DOMContentLoaded', () => {
    autoInitAll();
});
