export const doFetch = async (
    url: string,
    method: string = 'GET',
    params: Object = {}
) => {
    const init = {
        method,
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken,
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
        .then(async r => {
            const json = await r.json()
            return { code: r.status, message: r.statusText, ...json };
        })
        .then(r => r)
        .catch(r => console.error(r));
};