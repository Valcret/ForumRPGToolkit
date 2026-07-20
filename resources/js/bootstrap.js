// CSRF token pour les formulaires Laravel
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.csrfToken = token.content;
}
