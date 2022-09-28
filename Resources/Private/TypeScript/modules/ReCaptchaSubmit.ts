import { load } from 'recaptcha-v3';

export class ReCaptchaSubmit {
  private containerList: NodeListOf<HTMLFormElement>;

  constructor(container: NodeListOf<HTMLFormElement>) {
    this.containerList = container;

    this.containerList.forEach((container) => {
      const sitekey = String(
        (<HTMLInputElement>container.querySelector('#ReCaptchaField'))?.dataset
          .sitekey
      );
      const submitButton = document.querySelector(
        "[type='submit']"
      ) as HTMLInputElement;

      if (!sitekey) {
        return;
      }

      submitButton.addEventListener('click', (ev) =>
        this.handler(ev, container, sitekey)
      );
    });
  }

  private handler(event: Event, container: HTMLFormElement, sitekey: string) {
    event.preventDefault();
    const captchaField = container.querySelector(
      '#ReCaptchaField'
    ) as HTMLInputElement;
    load(sitekey).then((recaptcha) => {
      recaptcha.execute('submit').then((token) => {
        captchaField.value = token;

        container.submit();
      });
    });
  }
}
