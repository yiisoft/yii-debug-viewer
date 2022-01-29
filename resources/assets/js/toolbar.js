(function () {
    'use strict';

    let findToolbar = function () {
            return document.querySelector('#yii-debug-toolbar');
        },
        ajax = function (url, settings) {
            const xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            settings = settings || {};
            xhr.open(settings.method || 'GET', url, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Accept', settings.accept || 'text/html');
            xhr.setRequestHeader('Content-Type', settings.accept || 'text/html');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200 && settings.success) {
                        settings.success(xhr);
                    } else if (xhr.status !== 200 && settings.error) {
                        settings.error(xhr);
                    }
                }
            };
            xhr.send(settings.data || '');
        },
        toolbarEl = findToolbar(),
        toolbarAnimatingClass = 'yii-debug-toolbar_animating',
        logoSelector = '.yii-debug-toolbar__logo',
        barSelector = '.yii-debug-toolbar__bar',
        viewSelector = '.yii-debug-toolbar__view',
        blockSelector = '.yii-debug-toolbar__block',
        toggleSelector = '.yii-debug-toolbar__toggle',
        externalSelector = '.yii-debug-toolbar__external',

        CACHE_KEY = 'yii-debug-toolbar',
        ACTIVE_STATE = 'active',

        animationTime = 300,

        activeClass = 'yii-debug-toolbar_active',
        iframeActiveClass = 'yii-debug-toolbar_iframe_active',
        iframeAnimatingClass = 'yii-debug-toolbar_iframe_animating',
        titleClass = 'yii-debug-toolbar__title',
        blockClass = 'yii-debug-toolbar__block',
        ignoreClickClass = 'yii-debug-toolbar__ignore_click',
        blockActiveClass = 'yii-debug-toolbar__block_active',
        requestStack = [];

    let initToolbar = function (toolbarUrl, debugUrl, position = 'bottom') {
        let $this = this;
        ajax(debugUrl, {
            success: function (xhr) {
                const response = JSON.parse(xhr.response);
                $this.sessions = response.data;
                $this.currentSession = $this.sessions[0] ? $this.sessions[0].id : '';
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
            accept: 'application/json'
        })
        if (!toolbarEl) {
            ajax(toolbarUrl, {
                success: function (xhr) {
                    let div = document.createElement('div');
                    div.innerHTML = xhr.responseText;
                    div.firstElementChild.classList.add('yii-debug-toolbar_position_' + position);
                    let scripts = div.getElementsByTagName('script');
                    for (let i = 0; i < scripts.length; i++) {
                        let script = document.createElement('script');
                        script.async = false
                        if (scripts[i].src !== '') {
                            script.src = scripts[i].src;
                        } else {
                            script.defer = true
                            script.src = `data:text/javascript;base64, ${btoa(scripts[i].innerHTML)}`;
                        }
                        scripts[i].remove();
                        div.appendChild(script);
                    }
                    if (position === 'bottom') {
                        document.body.appendChild(div);
                    } else {
                        document.body.insertAdjacentElement('beforebegin', div);
                    }

                    showToolbar(findToolbar());

                    let event;
                    if (typeof (Event) === 'function') {
                        event = new Event('yii.debug.toolbar_attached', {'bubbles': true});
                    } else {
                        event = document.createEvent('Event');
                        event.initEvent('yii.debug.toolbar_attached', true, true);
                    }

                    div.dispatchEvent(event);
                },
                error: function (xhr) {
                    toolbarEl.innerText = xhr.responseText;
                }
            });
        }
    }

    function showToolbar(toolbarEl) {
        var barEl = toolbarEl.querySelector(barSelector),
            viewEl = toolbarEl.querySelector(viewSelector),
            toggleEl = toolbarEl.querySelector(toggleSelector),
            externalEl = toolbarEl.querySelector(externalSelector),
            blockEls = barEl.querySelectorAll(blockSelector),
            blockLinksEls = document.querySelectorAll(blockSelector + ':not(.' + titleClass + ') a'),
            iframeEl = viewEl.querySelector('iframe'),
            iframeHeight = function () {
                return (window.innerHeight * (toolbarEl.dataset.height / 100) - barEl.clientHeight) + 'px';
            },
            isIframeActive = function () {
                return toolbarEl.classList.contains(iframeActiveClass);
            },
            resizeIframe = function (mouse) {
                const availableHeight = window.innerHeight - barEl.clientHeight;
                viewEl.style.height = Math.min(availableHeight, availableHeight - mouse.y) + "px";
            },
            showIframe = function (href) {
                toolbarEl.classList.add(iframeAnimatingClass);
                toolbarEl.classList.add(iframeActiveClass);

                iframeEl.src = externalEl.href = href;
                iframeEl.removeAttribute('tabindex');

                viewEl.style.height = iframeHeight();
                setTimeout(function () {
                    toolbarEl.classList.remove(iframeAnimatingClass);
                }, animationTime);
            },
            hideIframe = function () {
                toolbarEl.classList.add(iframeAnimatingClass);
                toolbarEl.classList.remove(iframeActiveClass);
                iframeEl.setAttribute("tabindex", "-1");
                removeActiveBlocksCls();

                externalEl.href = '#';
                viewEl.style.height = '';
                setTimeout(function () {
                    toolbarEl.classList.remove(iframeAnimatingClass);
                }, animationTime);
            },
            removeActiveBlocksCls = function () {
                [].forEach.call(blockEls, function (el) {
                    el.classList.remove(blockActiveClass);
                });
            },
            toggleToolbarClass = function (className) {
                toolbarEl.classList.add(toolbarAnimatingClass);
                if (toolbarEl.classList.contains(className)) {
                    toolbarEl.classList.remove(className);
                    [].forEach.call(blockLinksEls, function (el) {
                        el.setAttribute('tabindex', "-1");
                    });
                } else {
                    [].forEach.call(blockLinksEls, function (el) {
                        el.removeAttribute('tabindex');
                    });
                    toolbarEl.classList.add(className);
                }
                setTimeout(function () {
                    toolbarEl.classList.remove(toolbarAnimatingClass);
                }, animationTime);
            },
            toggleStorageState = function (key, value) {
                if (window.localStorage) {
                    const item = localStorage.getItem(key);

                    if (item) {
                        localStorage.removeItem(key);
                    } else {
                        localStorage.setItem(key, value);
                    }
                }
            },
            restoreStorageState = function (key) {
                if (window.localStorage) {
                    return localStorage.getItem(key);
                }
            },
            togglePosition = function () {
                if (isIframeActive()) {
                    hideIframe();
                } else {
                    toggleToolbarClass(activeClass);
                    toggleStorageState(CACHE_KEY, ACTIVE_STATE);
                }
            };

        if (restoreStorageState(CACHE_KEY) === ACTIVE_STATE) {
            const transition = toolbarEl.style.transition;
            toolbarEl.style.transition = 'none';
            toolbarEl.classList.add(activeClass);
            setTimeout(function () {
                toolbarEl.style.transition = transition;
            }, animationTime);
        } else {
            [].forEach.call(blockLinksEls, function (el) {
                el.setAttribute('tabindex', "-1");
            });
        }

        toolbarEl.style.display = 'block';

        window.onresize = function () {
            if (toolbarEl.classList.contains(iframeActiveClass)) {
                viewEl.style.height = iframeHeight();
            }
        };

        toolbarEl.addEventListener("mousedown", function (e) {
            if (isIframeActive() && (e.y - toolbarEl.offsetTop < 4 /* 4px click zone */)) {
                document.addEventListener("mousemove", resizeIframe, false);
            }
        }, false);

        document.addEventListener("mouseup", function () {
            if (isIframeActive()) {
                document.removeEventListener("mousemove", resizeIframe, false);
            }
        }, false);

        barEl.onclick = function (e) {
            let target = e.target;
            const block = findAncestor(target, blockClass);

            if (
                block
                && !block.classList.contains(titleClass)
                && !block.classList.contains(ignoreClickClass)
                && e.which !== 2 && !e.ctrlKey // not mouse wheel and not ctrl+click
            ) {
                while (target !== this) {
                    if (target.href) {
                        removeActiveBlocksCls();
                        block.classList.add(blockActiveClass);
                        showIframe(target.href);
                    }
                    target = target.parentNode;
                }

                e.preventDefault();
            }
        };

        toggleEl.onclick = togglePosition;
    }

    function findAncestor(el, cls) {
        while ((el = el.parentElement) && !el.classList.contains(cls)) {
        }
        return el;
    }

    function renderAjaxRequests() {
        const requestCounter = document.getElementsByClassName('yii-debug-toolbar__ajax_counter');
        if (!requestCounter.length) {
            return;
        }
        const ajaxToolbarPanel = document.querySelector('.yii-debug-toolbar__ajax');
        const tbodies = document.getElementsByClassName('yii-debug-toolbar__ajax_requests');
        let state = 'ok';
        if (tbodies.length) {
            const tbody = tbodies[0];
            const rows = document.createDocumentFragment();
            if (requestStack.length) {
                const firstItem = requestStack.length > 20 ? requestStack.length - 20 : 0;
                for (let i = firstItem; i < requestStack.length; i++) {
                    const request = requestStack[i];
                    const row = document.createElement('tr');
                    rows.appendChild(row);

                    const methodCell = document.createElement('td');
                    methodCell.innerHTML = request.method;
                    row.appendChild(methodCell);

                    const statusCodeCell = document.createElement('td');
                    const statusCode = document.createElement('span');
                    if (request.statusCode < 300) {
                        statusCode.setAttribute('class', 'yii-debug-toolbar__ajax_request_status yii-debug-toolbar__label_success');
                    } else if (request.statusCode < 400) {
                        statusCode.setAttribute('class', 'yii-debug-toolbar__ajax_request_status yii-debug-toolbar__label_warning');
                    } else {
                        statusCode.setAttribute('class', 'yii-debug-toolbar__ajax_request_status yii-debug-toolbar__label_error');
                    }
                    statusCode.textContent = request.statusCode || '-';
                    statusCodeCell.appendChild(statusCode);
                    row.appendChild(statusCodeCell);

                    const pathCell = document.createElement('td');
                    pathCell.className = 'yii-debug-toolbar__ajax_request_url';
                    pathCell.innerHTML = request.url;
                    pathCell.setAttribute('title', request.url);
                    row.appendChild(pathCell);

                    const durationCell = document.createElement('td');
                    durationCell.className = 'yii-debug-toolbar__ajax_request_duration';
                    if (request.duration) {
                        durationCell.innerText = request.duration + " ms";
                    } else {
                        durationCell.innerText = '-';
                    }
                    row.appendChild(durationCell);
                    row.appendChild(document.createTextNode(' '));

                    const profilerCell = document.createElement('td');
                    if (request.profilerUrl) {
                        const profilerLink = document.createElement('a');
                        profilerLink.setAttribute('href', request.profilerUrl);
                        profilerLink.innerText = request.profile;
                        profilerCell.appendChild(profilerLink);
                    } else {
                        profilerCell.innerText = 'n/a';
                    }
                    row.appendChild(profilerCell);

                    if (request.error) {
                        if (state !== "loading" && i > requestStack.length - 4) {
                            state = 'error';
                        }
                    } else if (request.loading) {
                        state = 'loading'
                    }
                    row.className = 'yii-debug-toolbar__ajax_request';
                }
                while (tbody.firstChild) {
                    tbody.removeChild(tbody.firstChild);
                }
                tbody.appendChild(rows);
            }
            ajaxToolbarPanel.style.display = 'block';
        }
        requestCounter[0].innerText = requestStack.length;
        let className = 'yii-debug-toolbar__label yii-debug-toolbar__ajax_counter';
        if (state === 'ok') {
            className += ' yii-debug-toolbar__label_success';
        } else if (state === 'error') {
            className += ' yii-debug-toolbar__label_error';
        }
        requestCounter[0].className = className;
    }

    /**
     * Should AJAX request to be logged in debug panel
     *
     * @param requestUrl
     * @returns {boolean}
     */
    function shouldTrackRequest(requestUrl) {
        if (requestUrl.includes('/debug')) {
            return false;
        }
        const a = document.createElement('a');
        a.href = requestUrl;
        const skipAjaxRequestUrls = toolbarEl ? JSON.parse(toolbarEl.getAttribute('data-skip-urls')) : [];
        if (Array.isArray(skipAjaxRequestUrls) && skipAjaxRequestUrls.length && skipAjaxRequestUrls.includes(requestUrl)) {
            return false;
        }
        return a.host === location.host;
    }

    const proxied = XMLHttpRequest.prototype.open;

    XMLHttpRequest.prototype.open = function (method, url, async, user, pass) {
        const self = this;

        if (shouldTrackRequest(url)) {
            const stackElement = {
                loading: true,
                error: false,
                url: url,
                method: method,
                start: new Date()
            };
            requestStack.push(stackElement);
            this.addEventListener('readystatechange', function () {
                if (self.readyState === 4) {
                    stackElement.duration = new Date() - stackElement.start;
                    stackElement.loading = false;
                    stackElement.statusCode = self.status;
                    stackElement.error = self.status < 200 || self.status >= 400;
                    stackElement.profile = self.getResponseHeader('X-Debug-Id');
                    stackElement.profilerUrl = self.getResponseHeader('X-Debug-Link');
                    renderAjaxRequests();
                }
            }, false);
            renderAjaxRequests();
        }
        proxied.apply(this, Array.prototype.slice.call(arguments));
    };

    // catch fetch AJAX requests
    if (window.fetch) {
        const originalFetch = window.fetch;

        window.fetch = function (input, init) {
            let method;
            let url;
            if (typeof input === 'string') {
                method = (init && init.method) || 'GET';
                url = input;
            } else if (window.URL && input instanceof URL) { // fix https://github.com/yiisoft/yii2-debug/issues/296
                method = (init && init.method) || 'GET';
                url = input.href;
            } else if (window.Request && input instanceof Request) {
                method = input.method;
                url = input.url;
            }
            let promise = originalFetch(input, init);

            if (shouldTrackRequest(url)) {
                const stackElement = {
                    loading: true,
                    error: false,
                    url: url,
                    method: method,
                    start: new Date()
                };
                requestStack.push(stackElement);
                promise.then(function (response) {
                    stackElement.duration = new Date() - stackElement.start;
                    stackElement.loading = false;
                    stackElement.statusCode = response.status;
                    stackElement.error = response.status < 200 || response.status >= 400;
                    stackElement.profile = response.headers.get('X-Debug-Id');
                    stackElement.profilerUrl = response.headers.get('X-Debug-Link');
                    renderAjaxRequests();

                    return response;
                }).catch(function (error) {
                    stackElement.loading = false;
                    stackElement.error = true;
                    renderAjaxRequests();

                    throw error;
                });
                renderAjaxRequests();
            }

            return promise;
        };
    }
    if (window.YiiDebug) {
        window.YiiDebug.initToolbar = initToolbar;
    } else {
        window.YiiDebug = {
            targetHost: '',
            baseUrl: '',
            initToolbar,
            currentSession: {},
            sessions: [],
            collectors: []
        }
    }
})();