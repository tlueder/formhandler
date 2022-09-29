import { TurnstileForm } from './modules/TurnstileForm';

document.addEventListener('DOMContentLoaded', () => {
  if (typeof turnstile === 'undefined') {
    document.querySelector('#turnstilScript')?.addEventListener('load', () => {
      runInit();
    });
  } else {
    // fallback if user returns to page
    runInit();
  }

  function runInit() {
    const forms = document.querySelectorAll(
      'form'
    ) as NodeListOf<HTMLFormElement>;
    if (forms !== null) {
      new TurnstileForm(forms);
    }
  }
});
