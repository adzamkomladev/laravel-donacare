window._ = require("lodash");

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("jquery");

    require("bootstrap");

    // Add vendors
    require("./vendor/bootstrap-notify");
    require("./vendor/now-ui-dashboard");
    require("./vendor/bossware");
    require("./vendor/demo");
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

const recursiveConversionToCamelCase = obj => {
    const traverseArr = arr => {
        arr.forEach(v => {
            if (v) {
                if (v.constructor === Object) {
                    recursiveConversionToCamelCase(v);
                } else if (v.constructor === Array) {
                    traverseArr(v);
                }
            }
        });
    };

    Object.keys(obj).forEach(k => {
        if (obj[k]) {
            if (obj[k].constructor === Object) {
                recursiveConversionToCamelCase(obj[k]);
            } else if (obj[k].constructor === Array) {
                traverseArr(obj[k]);
            }
        }

        const sck = _.camelCase(k);
        if (sck !== k) {
            obj[sck] = obj[k];
            delete obj[k];
        }
    });

    return obj;
};

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.axios.interceptors.request.use(req => {
    const oldData = _.clone(req.data);
    const data = {};

    for (let property in oldData) {
        data[_.snakeCase(property)] = oldData[property];
    }

    req.data = data;

    return req;
});

window.axios.interceptors.response.use(res => {
    const oldData = _.cloneDeep(res.data);

    res.data = recursiveConversionToCamelCase(oldData);

    return res;
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

// $(document).ready(function () {
//     // Javascript method's body can be found in assets/js/demos.js
//     demo.initDashboardPageCharts();

// });
