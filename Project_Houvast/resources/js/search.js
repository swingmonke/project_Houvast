/**
 * Live search module
 * Usage:
 * import { initLiveSearch, autoInitAll } from './search';
 * initLiveSearch({ input: '#my-input', list: '#my-list', url: '/search', debounce: 300 });
 * - or -
 * Add `data-live-search="true" data-list="#my-list" data-url="/search"` to an input and call `autoInitAll()`
 */

export function initLiveSearch({
    input,
    list,
    url,
    paramName = 'query',
    debounce = 300,
    extraParams = () => ({}), // function returning an object of extra query params
    render = (html, container) => { container.innerHTML = html; },
} = {}) {
    const inputEl = typeof input === 'string' ? document.querySelector(input) : input;
    const listEl = typeof list === 'string' ? document.querySelector(list) : list;

    if (!inputEl || !listEl || !url) {
        // Missing configuration — fail silently
        return null;
    }

    let timeout = null;
    let controller = null;

    const fetchList = (q) => {
        if (controller) controller.abort();
        controller = new AbortController();

        const params = new URLSearchParams({ [paramName]: q, ...extraParams() });
        const fullUrl = url + (url.includes('?') ? '&' : '?') + params.toString();

        return fetch(fullUrl, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            signal: controller.signal,
        })
            .then(res => {
                if (!res.ok) throw new Error('Network response was not ok');
                return res.text();
            })
            .then(html => render(html, listEl))
            .catch(err => {
                if (err.name === 'AbortError') return; // expected on new requests
                // otherwise ignore or log
                // console.error('Live search error', err);
            });
    };

    const onInput = (e) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => fetchList(e.target.value), debounce);
    };

    inputEl.addEventListener('input', onInput);

    return {
        destroy() {
            inputEl.removeEventListener('input', onInput);
            if (controller) controller.abort();
        },
        fetchNow() {
            return fetchList(inputEl.value);
        }
    };
}

export function autoInitAll(selector = '[data-live-search]') {
    const nodes = Array.from(document.querySelectorAll(selector));
    const instances = [];

    nodes.forEach((inputEl) => {
        const list = inputEl.dataset.list || inputEl.getAttribute('aria-controls');
        const url = inputEl.dataset.url;
        const debounce = inputEl.dataset.debounce ? parseInt(inputEl.dataset.debounce, 10) : undefined;
        const param = inputEl.dataset.param || undefined;

        if (!list || !url) return;

        const inst = initLiveSearch({
            input: inputEl,
            list,
            url,
            paramName: param,
            debounce,
        });

        if (inst) instances.push(inst);
    });

    return instances;
}
