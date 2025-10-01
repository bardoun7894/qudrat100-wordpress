# 🔧 دليل حل المشاكل - qudrat100.com

## التشخيص السريع

### اختبر هذه الروابط:

1. **الصفحة الرئيسية:**
   - https://qudrat100.com/

2. **ملف CSS:**
   - https://qudrat100.com/wp-content/themes/custom-theme/style.css
   - يجب أن ترى كود CSS كامل

3. **ملف JS:**
   - https://qudrat100.com/wp-content/themes/custom-theme/js/custom.js
   - يجب أن ترى كود JavaScript

4. **الصور:**
   - https://qudrat100.com/wp-content/themes/custom-theme/images/iconword.png
   - https://qudrat100.com/wp-content/themes/custom-theme/images/course-brochure.jpg

---

## إذا حصلت على خطأ 404:

**المشكلة:** الملفات لم يتم رفعها بشكل صحيح

**الحل:** رفع يدوي عبر cPanel

---

## الحل النهائي الأضمن: رفع عبر cPanel

### الطريقة الصحيحة:

#### 1. ادخل cPanel

**جرب هذه الروابط:**
- https://qudrat100.com:2083
- https://qudrat100.com/cpanel
- أو الرابط من مزود الاستضافة

#### 2. افتح File Manager

**في cPanel:**
- ابحث عن أيقونة "File Manager"
- اضغط عليها

#### 3. اذهب إلى مجلد الثيم

**المسار:**
```
public_html/
└── wp-content/
    └── themes/
        └── custom-theme/
```

#### 4. احذف المحتويات القديمة

**في مجلد `custom-theme`:**
- حدد جميع الملفات (Ctrl+A)
- اضغط Delete
- أكد الحذف

#### 5. ارفع الملفات الجديدة

**من جهازك:**
```
c:\Users\Chairi\wordpress\wp-content\themes\custom-theme\
```

**ارفع:**
- جميع ملفات PHP (9 ملفات):
  - footer.php
  - front-page.php
  - functions.php
  - header.php
  - index.php
  - page-landing.php
  - page.php
  - single.php
  
- style.css

**ثم أنشئ المجلدات:**

**6. أنشئ مجلد `images`:**
- في custom-theme، اضغط "+ Folder"
- اسم المجلد: `images`
- ادخل المجلد
- ارفع:
  - iconword.png
  - course-brochure.jpg

**7. أنشئ مجلد `js`:**
- ارجع لمجلد custom-theme
- اضغط "+ Folder"
- اسم المجلد: `js`
- ادخل المجلد
- ارفع:
  - custom.js

#### 8. تحقق من الصلاحيات

**لكل مجلد:**
- images/ → 755
- js/ → 755

**لكل ملف:**
- *.php → 644
- *.css → 644
- *.js → 644
- *.png → 644
- *.jpg → 644

---

## بعد الرفع:

### 1. امسح الكاش
```
- WordPress: في لوحة التحكم → أي plugin للكاش
- متصفح: Ctrl + Shift + Delete
- Cloudflare: إذا كان مفعّل
```

### 2. حدّث Permalinks
```
Settings → Permalinks → Save Changes
```

### 3. تحقق من التفعيل
```
Appearance → Themes
→ تأكد أن "الاستعداد للقدرات - Qudrat100" مفعّل
```

### 4. اضبط الصفحة الرئيسية
```
Settings → Reading
→ A static page
→ Homepage: Front Page
→ Save
```

---

## اختبار النتيجة النهائية:

### افتح Developer Tools (F12):

**Console Tab:**
```
يجب أن ترى:
✅ "Custom theme JavaScript loaded successfully!"
❌ لا أخطاء حمراء
```

**Network Tab:**
```
ابحث عن:
- style.css → Status: 200
- custom.js → Status: 200
- iconword.png → Status: 200
- course-brochure.jpg → Status: 200
```

**Elements Tab:**
```
تحقق من <head>:
✅ <link rel="stylesheet" href=".../style.css">
✅ <script src=".../custom.js">
```

---

## إذا ما زالت المشكلة موجودة:

### تحقق من:

1. **اسم الثيم:**
   - يجب أن يكون `custom-theme` بالضبط
   - ليس `custom-theme-1` أو أي اسم آخر

2. **المسار الكامل:**
   ```
   /public_html/wp-content/themes/custom-theme/
   ```

3. **ملف style.css:**
   - يجب أن يبدأ بتعليق WordPress:
   ```css
   /*
   Theme Name: الاستعداد للقدرات - Qudrat100
   ...
   */
   ```

4. **functions.php:**
   - يجب أن يحتوي على `wp_enqueue_script` للـ JS

---

## الأخطاء الشائعة وحلولها:

### خطأ 1: "style.css is missing"
**السبب:** ملف style.css ليس في جذر مجلد الثيم
**الحل:** تأكد أن style.css في:
```
/custom-theme/style.css
وليس
/custom-theme/css/style.css
```

### خطأ 2: الصور لا تظهر (404)
**السبب:** مجلد images غير موجود أو فارغ
**الحل:** 
- أنشئ مجلد images/
- ارفع الصورتين

### خطأ 3: JS لا يعمل
**السبب:** ملف custom.js غير موجود
**الحل:**
- أنشئ مجلد js/
- ارفع custom.js

### خطأ 4: CSS موجود لكن لا يتم تطبيقه
**السبب:** كاش أو تعارض
**الحل:**
- امسح جميع أنواع الكاش
- حدّث Permalinks
- تحقق من أولوية CSS في Developer Tools

---

## اتصل للدعم:

إذا جربت كل شيء ولم ينجح، أرسل:

1. Screenshot من صفحة https://qudrat100.com/
2. Screenshot من Console (F12)
3. Screenshot من Network tab (F12)
4. Screenshot من مجلد custom-theme في cPanel

---

**آخر تحديث:** 30 سبتمبر 2025  
**الإصدار:** 1.0


