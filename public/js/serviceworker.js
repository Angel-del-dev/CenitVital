let deferredPrompt = null;

const createPWA = async () => {
    if (deferredPrompt === null) return;
    deferredPrompt.prompt();
    const { outcome } = await deferredPrompt.userChoice;
    if(outcome !== 'accepted') return;
    deferredPrompt = null;
    location.reload();
    
}

const RegisterWorker = () => {
    if(typeof window === 'undefined' ) return;
    if ("serviceWorker" in navigator) {
        navigator.serviceWorker
        .register(`/js/serviceworker.js`)
        .then(_ => { /* Service worker created */})
        .catch(err => { console.log("Service worker could not be created:", err); });
    }
    window.addEventListener('beforeinstallprompt', e => {
        e.preventDefault();
        deferredPrompt = e;
        document.getElementById('ConfirmInstallPWA')?.addEventListener('click', _ => createPWA());
    });
    
}
