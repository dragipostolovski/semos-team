const route = '/wp-json/ccmk-api/v1/';
const nonce = carclubmk.nonce;

const handleSubmit = () => {
    const url = 'subscribe';
    const data = {};
    
    // Default options are marked with *
    const response = fetch( route + url, {
        method: "post", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, *cors, same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            'Cache-Control': 'no-cache',
            'X-WP-Nonce': nonce,
        },
        redirect: "follow", // manual, *follow, error
        referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        // body: new URLSearchParams(data) // body data type must match "Content-Type" header
        body: JSON.stringify(data)
    });
    
    if (response.ok) {
        response.json().then( data => {
            // do something with the response data
            console.log( data.message );
        });
    }
};