;'use strict';

if (!navigator.cookieEnabled) {
    alert('To continue work, you may enable cookies.');
}

$(document).ready(function () {
    var headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};
    var params = {};

    $('#content-ajax').on('click', function () {
        $.ajax({
            headers: headers,
            url: '/params',
            method: 'POST',
            data: {
                device: JSON.stringify(getDeviceParams()),
            },
            success: function (response, params) {
                let paramsArray = response['data'];
                window.userParamsArray = paramsArray;

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
        let value = window.lang == 'ua' ? 'Перевiрити швидкiсть' : 'Check speed';
        if (!Object.keys($('#speed-ajax')).length) {
            $('.div-footer').append('<button type="button" class="btn btn-danger" id="speed-ajax">' + value + '</button>');
        }
    }

    function createDownloadButton() {
        deactivateLinks();
        let value = window.lang == 'ua' ? 'Завантажити' : 'Download date';
        if (!Object.keys($('#download-data-button')).length) {
            $('.div-footer').append('<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" id="download-data-button">' +
                 value + '</button>'
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

        if (ua.search(/Chrome/) > 0) return 'Google Chrome';
        if (ua.search(/Firefox/) > 0) return 'Firefox';
        if (ua.search(/Opera/) > 0) return 'Opera';
        if (ua.search(/Safari/) > 0) return 'Safari';
        if (ua.search(/MSIE/) > 0) return 'Internet Explorer';

        return 'Undefined';
    }

    $(document).on('click', '#get-content', function () {
        deactivateLinks();
        activateLink($("#div-data-fast>a"), "/content/fast.zip");

        sendParamsData(params);
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

        sendParamsData(params);
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

    function sendParamsData() {
        window.userParamsArray['speed'] = window.userSpeed;
        $.ajax({
            headers: headers,
            url: '/save_params',
            method: 'POST',
            data: {
                params: window.userParamsArray
            },
            success: function (response) {

            },
            error: function (response) {
                console.log('error', response);
            }
        });
    }

    let cookies = document.cookie.split(';');
    cookies.map(function (el) {
        if (el.includes('systemLanguage')) {
            let lang = el.split('=')[1];
            if (lang == 'ua') {
                window.lang = 'ua';
                $('#lang-ua').addClass('lang-checked');
                $('#lang-en').removeClass('lang-checked')
            } else {
                window.lang = 'en';
                $('#lang-en').addClass('lang-checked');
                $('#lang-ua').removeClass('lang-checked')
            }
        }
    });

    var diploma = 'q';
    var theme = 'w';

    if (window.lang == 'ua') {
        var diploma = 'Дипломна робота';
        var theme = 'на тему: "Інформаційна технологія адаптивного керування прийомом-передачею контенту"';
    } else {
        var diploma = 'Diploma';
        var theme = 'on the theme: "Information technology of adaptive control of reception and transmission of content"';
    }

    $('#welcome-h2').text(diploma);
    $('#welcome-h3').html(theme);
});
