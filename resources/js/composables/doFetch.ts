export const doFetch = async (
    url: string,
    method: string = 'GET',
    params: Object = {}
) => {
    const init = {
        method,
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector("[name~=csrf-token][content]").content,
            "Content-Type": 'application/json',
            'accept': 'application/json'
        },
        redirect: 'manual',
        credentials: 'include'
    }

    if(method !== 'GET') init.body = JSON.stringify(params);
    return await fetch(
        url,
        init
    )
        .then(r => r.ok ? { code: r.status, ...r.json() } : { code: r.status, message: 'Uknown error' })
        .then(r => r)
        .catch(r => console.error(r));
};