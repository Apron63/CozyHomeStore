import { registerVueControllerComponents } from '@symfony/ux-vue';
registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));

import './bootstrap.js';

// enable the interactive UI components from Flowbite
import 'flowbite';

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
