declare interface RenderParameters {
  sitekey: string;
  callback?: (token: string) => void;
  theme?: string;
  action?: string;
}
declare class turnstile {
  static render: (
    container: string | Element,
    parameters: RenderParameters
  ) => string;

  static getResponse: (widgetId: string) => void;

  static reset: (widgetId: string) => void;
}
