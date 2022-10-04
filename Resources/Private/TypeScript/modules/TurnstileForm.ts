export class TurnstileForm {
  constructor(containerList: NodeListOf<HTMLFormElement>) {
    containerList.forEach((container) => {
      const captchaDiv = container.querySelector(
        '#turnstileDiv'
      ) as HTMLDivElement;

      const sitekey = String(captchaDiv?.dataset.sitekey);
      if (!captchaDiv || !sitekey) {
        return;
      }

      const formId = container.getAttribute('id') ?? 'default';

      this.initCaptcha(captchaDiv, sitekey, formId);
    });
  }

  private initCaptcha(
    captchaDiv: HTMLElement,
    sitekey: string,
    formId: string
  ) {
    const widgetId = turnstile.render(captchaDiv, {
      sitekey: sitekey,
      action: formId,
      callback: () => {
        const captchaInput = captchaDiv.querySelector(
          'input'
        ) as HTMLInputElement;
        captchaInput.setAttribute('name', 'formhandler[Turnstile]');

        setTimeout(() => turnstile.reset(widgetId), 300000);
      },
      theme: 'light',
    });
  }
}
