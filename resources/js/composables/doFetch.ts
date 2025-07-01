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
            return r.ok ? { code: r.status, ...json } : { code: r.status, message: json.error }
        })
        .then(r => r)
        .catch(r => console.error(r));
};