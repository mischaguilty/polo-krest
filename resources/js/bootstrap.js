try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

import ru_locale from 'filepond/locale/ru-ru';
import uk_locale from 'filepond/locale/uk-ua';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
window.Alpine.start();

window.ru_locale = ru_locale;
window.uk_locale = uk_locale;
