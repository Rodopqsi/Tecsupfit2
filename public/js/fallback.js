/* Fallback JavaScript for when Vite assets are not compiled */

// Basic polyfill for older browsers
if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype.msMatchesSelector || 
                                Element.prototype.webkitMatchesSelector;
}

if (!Element.prototype.closest) {
    Element.prototype.closest = function(s) {
        var el = this;
        do {
            if (Element.prototype.matches.call(el, s)) return el;
            el = el.parentElement || el.parentNode;
        } while (el !== null && el.nodeType === 1);
        return null;
    };
}

// Basic utility functions
window.TecSupFit = {
    // Basic DOM ready function
    ready: function(callback) {
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", callback);
        } else {
            callback();
        }
    },

    // Basic form validation
    validateForm: function(form) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(function(field) {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });
        
        return isValid;
    },

    // Basic show/hide functions
    show: function(element) {
        if (typeof element === 'string') {
            element = document.querySelector(element);
        }
        if (element) {
            element.classList.remove('hidden');
        }
    },

    hide: function(element) {
        if (typeof element === 'string') {
            element = document.querySelector(element);
        }
        if (element) {
            element.classList.add('hidden');
        }
    },

    // Basic toggle function
    toggle: function(element) {
        if (typeof element === 'string') {
            element = document.querySelector(element);
        }
        if (element) {
            element.classList.toggle('hidden');
        }
    }
};

// Initialize basic functionality when DOM is ready
window.TecSupFit.ready(function() {
    // Add basic form validation to all forms
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!window.TecSupFit.validateForm(form)) {
                e.preventDefault();
            }
        });
    });

    // Add basic click handlers for common elements
    const toggleButtons = document.querySelectorAll('[data-toggle]');
    toggleButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const target = button.getAttribute('data-toggle');
            window.TecSupFit.toggle(target);
        });
    });

    // Basic fade-in animation for elements with 'fade-in' class
    const fadeElements = document.querySelectorAll('.fade-in');
    fadeElements.forEach(function(element) {
        element.style.opacity = '0';
        element.style.transition = 'opacity 0.5s ease-in-out';
        setTimeout(function() {
            element.style.opacity = '1';
        }, 100);
    });

    console.log('TecSupFit fallback scripts loaded');
});