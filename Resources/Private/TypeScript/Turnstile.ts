document.addEventListener('DOMContentLoaded', () => {
  const submitButton = document.querySelector(
    "[type='submit']"
  ) as HTMLInputElement;
  const div = document.querySelector('#turnstileDiv') as HTMLDivElement;
  const sitekey = div.dataset.sitekey as string;

  submitButton.addEventListener('click', (ev) => {
    ev.preventDefault();

    turnstile.render(div, {
      sitekey: sitekey,
      callback: function () {
        const captchaDiv = div.querySelector('input') as HTMLInputElement;
        captchaDiv.setAttribute('name', 'formhandler[Turnstil]');
      },
      theme: 'light',
    });
  });
});
