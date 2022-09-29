export class TurnstileForm {
  constructor(container: NodeListOf<HTMLFormElement>) {
    container.forEach((container) => {
      const captchaDiv = container.querySelector(
        '#turnstileDiv'
      ) as HTMLDivElement;

      const sitekey = String(captchaDiv?.dataset.sitekey);
      if (!captchaDiv || !sitekey) {
        return;
      }

      this.initCaptcha(captchaDiv, sitekey);
    });
  }

  private initCaptcha(captchaDiv: HTMLElement, sitekey: string) {
    turnstile.render(captchaDiv, {
      sitekey: sitekey,
      callback: function () {
        const captchaInput = captchaDiv.querySelector(
          'input'
        ) as HTMLInputElement;
        captchaInput.setAttribute('name', 'formhandler[Turnstile]');
      },
      theme: 'light',
    });
  }
}
