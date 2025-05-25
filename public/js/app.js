/**
 * أولاً سنقوم بتحميل جميع الاعتماديات اللازمة لجافاسكريبت في هذا المشروع
 * والتي تشمل Vue ومكتبات أخرى. هذا نقطة انطلاق رائعة عند بناء تطبيقات الويب
 * القوية والمتينة باستخدام Vue و Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * بعد ذلك، سنقوم بإنشاء تطبيق Vue جديد. يمكنك من خلاله البدء في تسجيل المكونات
 * مع مثيل التطبيق حتى يكونوا جاهزين للاستخدام في صفحات تطبيقك. يتم تضمين مثال
 * لك للإشارة.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

/**
 * الكود التالي يستخدم لتسجيل المكونات Vue تلقائياً. يقوم بفحص هذا الدليل
 * تلقائياً للمكونات Vue وتسجيلها تلقائياً باستخدام "اسم الملف الأساسي"
 * لهذه المكونات.
 *
 * مثال: ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Object.entries(import.meta.globEager('./components/*.vue')).forEach(([path, definition]) => {
    const componentName = path.split('/').pop().split('.')[0];
    app.component(componentName, definition.default);
});

/**
 * في النهاية، سنربط مثيل التطبيق بعنصر HTML يحمل "id" بقيمة "app".
 * يتم تضمين هذا العنصر مع نظام "المصادقة" الأساسي. وإلا، ستحتاج إلى إضافة
 * عنصر بنفسك.
 */

app.mount('#app');
