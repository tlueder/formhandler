declare global {
  const turnstile: turnstile;
}

export interface turnstile {
  render: (container: string | Element, parameters: IRenderParameters) => void;
}

export declare interface IRenderParameters {
  sitekey: string;
  callback?: (token: string) => void;
  theme?: string;
}
