module.exports = {

    /**
     * Get request
     *
     * @param  {String}   url     The URL to get
     * @param  {Function} success Callback to run on success
     * @param  {Function} error   Callback to run on error
     * @return {void}
     */
    get: function(url, success, error) {
        // Feature detection
        if (!window.XMLHttpRequest) return;

        // Create new request
        var request = new XMLHttpRequest();

        // Setup callbacks
        request.onreadystatechange = function () {

            // If the request is complete
            if (request.readyState === 4) {

                // If the request failed
                if (request.status !== 200) {
                    if (error && typeof error === 'function') {
                        error(JSON.parse(request.responseText), request);
                    }
                    return;
                }

                // If the request succeeded
                if (success && typeof success === 'function') {
                    success(JSON.parse(request.responseText), request);
                }
            }
        }

        request.open('GET', url);
        request.send();
    }
    
}
