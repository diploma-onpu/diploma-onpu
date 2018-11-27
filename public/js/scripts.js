;'use strict';

if (!navigator.cookieEnabled) {
    alert('To continue work, you may enable cookies.');
}

$(document).ready(function () {
    var headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    $('#content-ajax').on('click', function () {
        $.ajax({
            headers: headers,
            url: '/params',
            method: 'POST',
            data: {
                device: JSON.stringify(getDeviceParams()),
            },
            success: function (response) {
                let paramsArray = response['data'];

                $('#os').html(paramsArray['platform']);
                $('#browser').html(paramsArray['browser_name']);
                $('#browser-width').html(paramsArray['browser_size']['real_width'] + ' px');
                $('#browser-height').html(paramsArray['browser_size']['real_height'] + ' px');
                $('#screen-width').html(paramsArray['screen']['screen_width'] + ' px');
                $('#screen-height').html(paramsArray['screen']['screen_height'] + ' px');

                createParamsButton();
            },
            error: function (response) {
                console.log('error', response);
            }
        });
    });

    $(document).on('click', '#speed-ajax', function () {
        $.ajax({
            headers: headers,
            url: '/determine-speed',
            method: 'POST',
            success: function (response) {
                var tH = Math.round(new Date().getTime()),
                    tSrv = JSON.parse(response)[0];
                var spentTime = (tH - tSrv) / 1000;
                let speed = 3 / spentTime;
                speed = speed.toFixed(2);
                $('#speed').html(Math.abs(speed) + ' MB');
                window.userSpeed = speed;

                createDownloadButton();
            },
            error: function (response) {
                console.log('error', response);
            }
        });
    });

    function createParamsButton() {
        if (!Object.keys($('#speed-ajax')).length) {
            $('.div-footer').append('<button type="button" class="btn btn-danger" id="speed-ajax">Check speed</button>');
        }
    }

    function createDownloadButton() {
        deactivateLinks();

        if (!Object.keys($('#download-data-button')).length) {
            $('.div-footer').append('<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" id="download-data-button">\n' +
                'Download date\n</button>'
            );
        }
    }

    function getDeviceParams() {
        return {
            browser_name: getNameBrowser(),
            browser_size: {
                real_width: (window.innerWidth ?
                    window.innerWidth : (document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.offsetWidth)),
                real_height: (window.innerHeight ?
                    window.innerHeight : (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.offsetHeight))
            },
            screen: {
                screen_width: window.screen.width,
                screen_height: window.screen.height
            },
            lang: navigator.languages,
            platform: navigator.platform
        }
    }

    function getNameBrowser() {
        let ua = navigator.userAgent;

        if (ua.search(/Chrome/) > 0) {
            return 'Google Chrome';
        }

        if (ua.search(/Firefox/) > 0) {
            return 'Firefox';
        }

        if (ua.search(/Opera/) > 0) {
            return 'Opera';
        }

        if (ua.search(/Safari/) > 0) {
            return 'Safari';
        }

        if (ua.search(/MSIE/) > 0) {
            return 'Internet Explorer';
        }

        return 'Undefined';
    }

    $(document).on('click', '#get-content', function () {
        deactivateLinks();
        activateLink($("#div-data-fast>a"), "/content/fast.zip");
    });

    $(document).on('click', '#get-recommended-content', function () {
        deactivateLinks();
        if (window.userSpeed >= 100) {
            activateLink($("#div-data-fast>a"), "/content/fast.zip");
        } else if (window.userSpeed > 50 && window.userSpeed < 100) {
            activateLink($("#div-data-middle>a"), "/content/middle.zip");
        } else {
            activateLink($("#div-data-min>a"), "/content/slow.zip");
        }
    });

    function deactivateLinks() {
        let fast = $("#div-data-fast>a");
        changeHref(fast);
        changeColor(fast, 'gray', 'default', 'none');

        let middle = $("#div-data-middle>a");
        changeHref(middle);
        changeColor(middle, 'gray', 'default', 'none');

        let slow = $("#div-data-min>a");
        changeHref(slow);
        changeColor(slow, 'gray', 'default', 'none');
    }

    function changeHref(element) {
        element.attr('href', "javascript: void(0);");
    }

    function changeColor(element, color, pointer, underline) {
        element.css({
            'color': color,
            'cursor': pointer,
            'text-decoration': underline
        });
    }

    function deactivateLinks1() {
        $("#div-data-fast>a").attr('href', "javascript: void(0);");
        $("#div-data-middle>a").attr('href', "javascript: void(0);");
        $("#div-data-min>a").attr('href', "javascript: void(0);");
    }

    function activateLink(element, url) {
        element.attr('href', url);
        changeColor(element, '#3385ff', 'pointer', 'underline');
    }
});