/**
 * Wrapper to execute a XMLHttpRequest.
 *
 * @since 2022.02.04
 */
export class AjaxRequest {
    /**
     * Creates a request with a methode, an url and the content.
     *
     * @param {string} method
     * @param {string} url
     * @param [content]
     */
    constructor(method, url, content) {
        this.doneCallback = () => {};
        this.content = content || null;
        this.method = method;
        this.url = url;

        this.eventStateChange = this.eventStateChange.bind(this);

        this.request = new XMLHttpRequest();
        this.request.open(this.method, this.url, true);
    }

    /**
     * Event if the status of the request changed.
     */
    eventStateChange() {
        if (XMLHttpRequest.DONE !== this.request.readyState) {
            return;
        }

        this.doneCallback(this.request);
    }

    /**
     * Sends the request.  The callback will be called when the request is done.
     *
     * @param {Function} callback
     */
    send(callback) {
        this.doneCallback = callback;
        this.request.onreadystatechange = this.eventStateChange;
        this.request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        if (!(this.content instanceof FormData) && 'object' === typeof this.content) {
            this.content = JSON.stringify(this.content);
            this.request.setRequestHeader('Content-Type', 'application/json');
        } else if ('string' === typeof this.content) {
            this.request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        }

        this.request.send(this.content);
    }
}
