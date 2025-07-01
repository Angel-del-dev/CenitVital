export const isRunningAsPWA = () => 
  window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;