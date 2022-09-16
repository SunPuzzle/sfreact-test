export {};

declare global {
    interface Window {
        resolveReactComponent: (context: any) => any;
    }
}