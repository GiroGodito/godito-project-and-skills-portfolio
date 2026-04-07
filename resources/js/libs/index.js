// // import './turbo';
// import  '@hotwired/turbo';
// import Alpine from 'alpinejs';
// window.Alpine = Alpine;

// document.addEventListener('turbo:load', () => {
//     Alpine.start();
// })

// //Alpine.start();
import '@hotwired/turbo';
import Alpine from 'alpinejs';

// Only initialize Alpine once
if (!window.AlpineInitialized) {
    window.Alpine = Alpine;
    window.AlpineInitialized = true;
    Alpine.start();
}