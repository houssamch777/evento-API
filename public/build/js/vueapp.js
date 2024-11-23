
import axios from 'axios'; // استيراد Axios
// تحميل التبعيات الأخرى
import './bootstrap';
import { createApp } from 'vue';



const app = createApp({});

// تحميل المكونات تلقائيًا
const components = import.meta.glob('./components/*.vue', { eager: true });
console.log(components);



// Register components dynamically


Object.entries(components).forEach(([path, component]) => {
    const componentName = path.split('/').pop().replace('.vue', '');
    const kebabCaseName = componentName
        .replace(/([a-z0-9])([A-Z])/g, '$1-$2') // إضافة شرطة بين الأحرف الكبيرة والصغيرة
        .toLowerCase(); // تحويل الكل إلى حروف صغيرة

    console.log(kebabCaseName); // طباعة اسم المكون بالكاباب كيس
    app.component(kebabCaseName, component.default);
});

app.mount('#app');
