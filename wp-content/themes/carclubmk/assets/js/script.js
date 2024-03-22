const nonce = carclubmk.nonce;
const CCMK_REST_ROUTE = carclubmk.CCMK_REST_ROUTE;

const route = '/wp-json/' + CCMK_REST_ROUTE + '/';
const carResults = document.querySelector('.car-results');

const handleSubmit = async ( term ) => {
    const url = 'filter-cars';

    const data = {
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
        body: JSON.stringify({
            term: term
        })
    }
    
    // Default options are marked with *
    const response = await fetch( route + url, data);
    
    if (response.ok) {
        response.json().then( data => {
            // do something with the response data
            if( data.response ) {
                carResults.innerHTML = data.posts;
            }
            else {
                carResults.innerHTML = 'No results';
            }

        });
    }
};


const carFilters = document.querySelectorAll('.car-filters span');

carFilters.forEach( (element) => {

    element.addEventListener('click', () => {

        const value = element.dataset.year;
        

        handleSubmit( value );
    })

} )