;'use strict';

if (!navigator.cookieEnabled) {
    alert('Для продолжения работы необходимо включить куки.');
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
       // $('#download-data-button').remove();
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

    $(document).on('click', '#get-content', function () {
        getContent(false);
    });

    $(document).on('click', '#get-recommended-content', function () {
        getContent(true);
    });

    function createParamsButton() {
        $('#speed-ajax').remove();
        $('.div-footer').append('<button type="button" class="btn btn-danger" id="speed-ajax">Get parameters</button>');
    }

    function createDownloadButton() {
        $('#download-data-button').remove();
        $('.div-footer').append('<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" id="download-data-button">\n' +
            'Download date\n' +
            '</button>'
        );
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

    function getContent(recommended) {
        $.ajax({
            headers: headers,
            url: '/getContent',
            method: 'POST',
            data: {
                isRecommended: recommended,
                speed: window.userSpeed,
            },
            success: function (response) {
                $('#div-data-ulr').html('<a href=' + response.data.url + '> download </a>');
            },
            error: function (response) {
                console.log('error', response);
            }
        });
    }
});