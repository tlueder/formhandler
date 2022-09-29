// tslint:disable-next-line
import { turnstile } from './definitions/turnstile';

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
      callback: function (token: string) {
        console.log(token);
      },
      theme: 'light',
    });
  });
});
