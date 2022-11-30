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
      const formValuePrefix =
        captchaDiv.dataset.formvalueprefix ?? 'formhandler';

      this.initCaptcha(captchaDiv, sitekey, formId, formValuePrefix);
    });
  }

  private initCaptcha(
    captchaDiv: HTMLElement,
    sitekey: string,
    formId: string,
    formValuePrefix: string
  ) {
    const widgetId = turnstile.render(captchaDiv, {
      sitekey: sitekey,
      action: formId,
      callback: () => {
        const captchaInput = captchaDiv.querySelector(
          'input'
        ) as HTMLInputElement;
        captchaInput.setAttribute('name', `${formValuePrefix}[Turnstile]`);

        setTimeout(() => turnstile.reset(widgetId), 300000);
      },
      theme: 'light',
    });
  }
}
