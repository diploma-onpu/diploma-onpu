<?php
/**
 * Created by PhpStorm.
 * User: ff
 * Date: 11/29/18
 * Time: 8:11 PM
 */

namespace App\Traits;


use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

trait TranslateTrait
{
    /**
     * @param $token
     * @return null
     */
    public static function trans($token)
    {
        try {
            $lang = Session::get('locale') ?: Cookie::get('systemLanguage');
        } catch (\Exception $e) {
            $lang = 'ua';
        }

        if (!in_array($lang, ['ua', 'en'])) {
            return $token;
        }

        $translatedTokenArray = null;
        if (key_exists($token, self::translations())) {
            $translatedTokenArray = self::translations()[$token];
        }

        return $translatedTokenArray[$lang];
    }

    /**
     * @return array
     */
    private static function translations()
    {
        return [
            'register' => [
                'en' => 'Register',
                'ua' => 'Pеєстрація',
            ],
            'login' => [
                'en' => 'Login',
                'ua' => 'Логiн',
            ],
            'logout' => [
                'en' => 'Logout',
                'ua' => 'Вийти',
            ],
            'name' => [
                'en' => 'Name',
                'ua' => 'Им\'я',
            ],
            'email' => [
                'en' => 'E-Mail Address',
                'ua' => 'Електронна адреса',
            ],
            'password' => [
                'en' => 'Password',
                'ua' => 'Пароль',
            ],
            'confirm_password' => [
                'en' => 'Confirm Password',
                'ua' => 'Пiдтвердити пароль',
            ],
            'remember_me' => [
                'en' => 'Remember Me',
                'ua' => 'Запам\'ятати',
            ],
            'forgot_password' => [
                'en' => 'Forgot Your Password?',
                'ua' => 'Напам\'ятати пароль?',
            ],
            'reset_password' => [
                'en' => 'Reset Password',
                'ua' => 'Скинути пароль',
            ],
            'dashboard' => [
                'en' => 'Dashboard',
                'ua' => 'Панель iнформацiї',
            ],
            'parameter' => [
                'en' => 'Parameter',
                'ua' => 'Назва параметру',
            ],
            'operation_system' => [
                'en' => 'Operation system',
                'ua' => 'Операційна система',
            ],
            'browser' => [
                'en' => 'Browser',
                'ua' => 'Браузер',
            ],
            'browser_width' => [
                'en' => 'Browser width',
                'ua' => 'Ширина браузера',
            ],
            'browser_height' => [
                'en' => 'Browser height',
                'ua' => 'Висота браузера',
            ],
            'screen_width' => [
                'en' => 'Screen width',
                'ua' => 'Ширина екрана',
            ],
            'screen_height' => [
                'en' => 'Screen height',
                'ua' => 'Висота екрана',
            ],
            'speed' => [
                'en' => 'Speed',
                'ua' => 'Швидкість',
            ],
            'get_params' => [
                'en' => 'Get params',
                'ua' => 'Отримати параметри',
            ],
            'check_speed' => [
                'en' => 'Check speed',
                'ua' => 'Перевірте швидкість',
            ],
            'value' => [
                'en' => 'Value',
                'ua' => 'Значення',
            ],
            'download_data' => [
                'en' => 'Download data',
                'ua' => 'Завантажити дані',
            ],
            'downloads' => [
                'en' => 'Downloads',
                'ua' => 'Завантаження',
            ],
            'download_maximum_size_of_data' => [
                'en' => 'Download maximum size of data',
                'ua' => 'Завантажити максимальний розмір даних',
            ],
            'download_medium_size_of_data' => [
                'en' => 'Download medium size of data',
                'ua' => 'Завантажити середній розмір даних',
            ],
            'download_minimum_size_of_data' => [
                'en' => 'Download minimum size of data',
                'ua' => 'Завантажити мінімальний розмір даних',
            ],
            'get_content_max_size' => [
                'en' => 'Max. size',
                'ua' => 'Макс. pозмір',
            ],
            'get_recommended_content' => [
                'en' => 'Recommended content',
                'ua' => 'Рекомендований розмiр',
            ],
            'close' => [
                'en' => 'Close',
                'ua' => 'Закрити',
            ],
            'required' => [
                'en' => 'Must be filled',
                'ua' => 'необхідно заповнити',
            ],
            'onpu' => [
                'en' => 'ONPU',
                'ua' => 'ОНПУ',
            ],
            'home' => [
                'en' => 'Home',
                'ua' => 'Домашня',
            ],
            'on_the_theme' => [
                'en' => 'on the theme: "Information technology of adaptive control of reception and transmission of content"',
                'ua' => 'на тему: "Інформаційна технологія адаптивного керування прийомом-передачею контенту"',
            ],
            'diploma' => [
                'en' => 'Diploma',
                'ua' => 'Дипломна робота',
            ],
            'link' => [
                'en' => 'link',
                'ua' => 'посилання',
            ],
            'send_password_reset_link' => [
                'en' => 'Send Password Reset Link',
                'ua' => 'Вислати посилання для встановлення паролю',
            ],
            'statistics' => [
                'en' => 'Statistic',
                'ua' => 'Статистика',
            ],
        ];
    }
}
