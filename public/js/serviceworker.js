let deferredPrompt = null;

const createPWA = async () => {
    if (deferredPrompt === null) return;
    deferredPrompt.prompt();
    const { outcome } = await deferredPrompt.userChoice;
    if(outcome !== 'accepted') return;
    deferredPrompt = null;
    window.reload();
    
}

const RegisterWorker = () => {
    if(typeof window !== 'undefined' ){
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker
            .register(`/js/serviceworker.js`)
            .then(_ => { /* Service worker created */})
            .catch(err => { console.log("Service worker could not be created:", err); });
        }
    
        window.addEventListener('beforeinstallprompt', e => {
            e.preventDefault();

            deferredPrompt = e;
            document.getElementById('CancelInstallPWA')?.addEventListener('click', _ => {
                document.getElementById('InstallPWA')?.remove();
            });
            document.getElementById('ConfirmInstallPWA')?.addEventListener('click', _ => createPWA());
        });
    }
}