const body = document.body;
const header = document.querySelector('[data-header]');
const nav = document.querySelector('[data-nav]');
const navToggle = document.querySelector('[data-nav-toggle]');
const yearFields = document.querySelectorAll('[data-year]');
const contactForm = document.querySelector('[data-contact-form]');

const setHeaderState = () => {
    header?.classList.toggle('is-scrolled', window.scrollY > 24);
};

const closeNavigation = () => {
    body.classList.remove('nav-open');
    navToggle?.setAttribute('aria-expanded', 'false');
    navToggle?.setAttribute('aria-label', 'Abrir menu');
};

setHeaderState();
window.addEventListener('scroll', setHeaderState, { passive: true });

navToggle?.addEventListener('click', () => {
    const isOpen = body.classList.toggle('nav-open');
    navToggle.setAttribute('aria-expanded', String(isOpen));
    navToggle.setAttribute('aria-label', isOpen ? 'Fechar menu' : 'Abrir menu');
});

nav?.addEventListener('click', (event) => {
    if (event.target instanceof HTMLAnchorElement) {
        closeNavigation();
    }
});

document.addEventListener('click', (event) => {
    const anchor = event.target instanceof Element ? event.target.closest('a[href^="#"]') : null;

    if (!(anchor instanceof HTMLAnchorElement)) {
        return;
    }

    const hash = anchor.getAttribute('href');
    const target = hash && hash.length > 1 ? document.querySelector(hash) : null;

    if (!target) {
        return;
    }

    event.preventDefault();
    closeNavigation();

    const headerOffset = (header?.offsetHeight ?? 0) + 24;
    const top = Math.max(0, target.getBoundingClientRect().top + window.scrollY - headerOffset);

    window.scrollTo({ top, behavior: 'smooth' });
    history.pushState(null, '', hash);
}, true);

const revealItems = document.querySelectorAll('.focus-card, .project-card, .timeline__item, .skill-list li, .workflow__item');

if ('IntersectionObserver' in window) {
    revealItems.forEach((item) => item.classList.add('is-revealable'));

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.18 });

    revealItems.forEach((item) => observer.observe(item));
}

yearFields.forEach((field) => {
    field.textContent = new Date().getFullYear();
});

if (contactForm instanceof HTMLFormElement) {
    const alertBox = contactForm.querySelector('[data-form-alert]');
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    contactForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const name = contactForm.elements.namedItem('name');
        const email = contactForm.elements.namedItem('email');
        const message = contactForm.elements.namedItem('message');
        const errors = {};

        contactForm.querySelectorAll('[aria-invalid="true"]').forEach((field) => {
            field.removeAttribute('aria-invalid');
        });

        contactForm.querySelectorAll('[data-error-for]').forEach((errorField) => {
            errorField.textContent = '';
        });

        if (!(name instanceof HTMLInputElement) || name.value.trim() === '') {
            errors.name = 'Informe seu nome.';
        }

        if (!(email instanceof HTMLInputElement) || !emailPattern.test(email.value.trim())) {
            errors.email = 'Informe um e-mail válido.';
        }

        if (!(message instanceof HTMLTextAreaElement) || message.value.trim().length < 10) {
            errors.message = 'Escreva uma mensagem com pelo menos 10 caracteres.';
        }

        Object.entries(errors).forEach(([fieldName, text]) => {
            const field = contactForm.elements.namedItem(fieldName);
            const errorField = contactForm.querySelector(`[data-error-for="${fieldName}"]`);

            if (field instanceof HTMLElement) {
                field.setAttribute('aria-invalid', 'true');
            }

            if (errorField) {
                errorField.textContent = text;
            }
        });

        if (alertBox) {
            alertBox.hidden = false;
            alertBox.className = `form-alert ${Object.keys(errors).length ? 'form-alert--error' : 'form-alert--success'}`;
            alertBox.textContent = Object.keys(errors).length
                ? 'Confira os campos destacados e tente novamente.'
                : 'Mensagem preparada. Obrigado por escrever.';
        }

        if (Object.keys(errors).length) {
            const firstInvalid = contactForm.querySelector('[aria-invalid="true"]');
            firstInvalid?.focus();
            return;
        }

        contactForm.reset();
    });
}
