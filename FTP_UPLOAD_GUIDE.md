# 📤 دليل رفع الثيم عبر FTP - qudrat100.com

## الطريقة الأولى: FileZilla (موصى بها)

### 1. تحميل وتثبيت FileZilla

**الرابط:**
https://filezilla-project.org/download.php?type=client

**اختر:** FileZilla Client (مجاني)

**ملاحظة:** تجاهل العروض الإضافية أثناء التثبيت

---

### 2. الحصول على بيانات FTP

**تحتاج:**
- Host (المضيف)
- Username (اسم المستخدم)
- Password (كلمة المرور)
- Port (المنفذ - عادة 21)

**مصادر الحصول على البيانات:**

#### أ. البريد الإلكتروني من الاستضافة
ابحث في بريدك عن:
- "Welcome to hosting"
- "FTP credentials"
- رسائل من مزود الاستضافة

#### ب. لوحة تحكم الاستضافة
إذا كان عندك لوحة تحكم أخرى (غير cPanel):
- ابحث عن "FTP Accounts"
- أو "File Transfer"

#### ج. اتصل بالدعم الفني
اطلب: "FTP credentials for my account"

---

### 3. الاتصال بالسيرفر

**في FileZilla:**

1. **أعلى الشاشة، أدخل:**
   ```
   Host: ftp.qudrat100.com (أو عنوان IP من الاستضافة)
   Username: اسم المستخدم من الاستضافة
   Password: كلمة المرور من الاستضافة
   Port: 21
   ```

2. **اضغط "Quickconnect"**

3. **إذا ظهرت رسالة Certificate:**
   - اختر "OK" أو "Trust this certificate"

4. **ستظهر لك شاشة مقسومة:**
   - **الجانب الأيسر:** جهازك (Local site)
   - **الجانب الأيمن:** السيرفر (Remote site)

---

### 4. الذهاب إلى مجلد الثيم

**في الجانب الأيمن (السيرفر):**

انقر المجلدات بالترتيب:
```
1. public_html (أو www أو httpdocs)
2. wp-content
3. themes
4. custom-theme
```

**إذا لم تجد مجلد `custom-theme`:**
- انقر بزر الفأرة الأيمن في مجلد `themes`
- Create directory
- اسم المجلد: `custom-theme`
- ادخل المجلد

---

### 5. رفع الملفات

#### أ. افتح مجلد الثيم على جهازك

**في الجانب الأيسر (جهازك):**
```
اذهب إلى:
c:\Users\Chairi\wordpress\wp-content\themes\custom-theme\
```

#### ب. حدد جميع الملفات

**يجب أن تشمل:**
```
✓ footer.php
✓ front-page.php
✓ functions.php
✓ header.php
✓ index.php
✓ page-landing.php
✓ page.php
✓ single.php
✓ style.css
✓ مجلد images/ (مع الصورتين بداخله)
✓ مجلد js/ (مع custom.js بداخله)
```

#### ج. ارفع الملفات

**طريقة 1 (السحب والإفلات):**
- حدد جميع الملفات والمجلدات
- اسحبها من اليسار إلى اليمين
- انتظر حتى يكتمل الرفع

**طريقة 2 (القائمة):**
- حدد جميع الملفات
- انقر بزر الفأرة الأيمن
- اختر "Upload"

**مهم:**
- ✅ تأكد أن المجلدات (images/ و js/) تم رفعها مع محتوياتها
- ✅ انتظر حتى تظهر جميع الملفات في الجانب الأيمن
- ✅ تأكد أن الأحجام متطابقة

---

### 6. التحقق من الرفع

**في الجانب الأيمن (السيرفر):**

**يجب أن ترى:**
```
/public_html/wp-content/themes/custom-theme/
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── index.php
├── page-landing.php
├── page.php
├── single.php
├── style.css
├── images/
│   ├── iconword.png
│   └── course-brochure.jpg
└── js/
    └── custom.js
```

**عدد الملفات المتوقع:**
- 9 ملفات PHP
- 1 ملف CSS
- 2 صورة (في مجلد images)
- 1 ملف JS (في مجلد js)
- **المجموع:** 13 ملف + 2 مجلد

---

## بعد الرفع:

### 1. تحقق من الثيم في WordPress

```
https://qudrat100.com/wp-admin/themes.php
→ يجب أن ترى "الاستعداد للقدرات - Qudrat100"
→ إذا لم يكن مفعّل، فعّله
```

### 2. اضبط الإعدادات

**أ. الصفحة الرئيسية:**
```
Settings → Reading
→ A static page
→ Homepage: Front Page
→ Save
```

**ب. Permalinks:**
```
Settings → Permalinks
→ Save Changes (لا تغير شيء!)
```

### 3. امسح الكاش

```
- متصفح: Ctrl + Shift + Delete
- WordPress: أي plugin للكاش
- أغلق المتصفح وافتحه من جديد
```

### 4. تحقق من النتيجة

```
https://qudrat100.com/
→ يجب أن ترى التصميم الجديد كاملاً
```

---

## المشاكل الشائعة وحلولها

### المشكلة 1: لا أستطيع الاتصال بـ FTP

**الأسباب المحتملة:**
- بيانات FTP خطأ
- Firewall يحجب الاتصال
- المنفذ خطأ (جرب 21 أو 22)

**الحل:**
- تحقق من البيانات
- جرب SFTP بدلاً من FTP (المنفذ 22)
- اتصل بالدعم الفني

### المشكلة 2: الاتصال بطيء جداً

**الحل:**
- استخدم اتصال إنترنت أسرع
- ارفع الملفات على دفعات
- جرب في وقت آخر

### المشكلة 3: "Permission denied" عند الرفع

**الحل:**
- تأكد أن اسم المستخدم لديه صلاحيات الكتابة
- اتصل بالدعم الفني لإعطائك الصلاحيات

### المشكلة 4: الملفات تم رفعها لكن الثيم لا يعمل

**الحل:**
- تحقق أن الملفات في المسار الصحيح:
  ```
  /public_html/wp-content/themes/custom-theme/
  ```
- تأكد أن style.css في جذر مجلد custom-theme
- تحقق أن المجلدات (images, js) تم رفعها مع محتوياتها

---

## الطريقة الثانية: WordPress File Manager Plugin

**إذا لم يعمل FTP:**

### 1. ثبّت Plugin

```
https://qudrat100.com/wp-admin/plugin-install.php?s=file%20manager
→ ثبّت "File Manager" من mirrored
→ فعّله
```

### 2. افتح File Manager

```
في WordPress:
→ WP File Manager → File Manager
```

### 3. اذهب إلى مجلد الثيم

```
wp-content → themes → custom-theme
```

### 4. احذف الملفات القديمة

```
حدد الكل → Delete
```

### 5. ارفع الملفات الجديدة

```
Upload → اختر الملفات من جهازك
```

**ملاحظة:** قد تحتاج لرفع الملفات واحدة واحدة أو على دفعات صغيرة

---

## الطريقة الثالثة: مساعدة الدعم الفني

**إذا لم تنجح الطرق السابقة:**

### اكتب للدعم الفني:

```
Subject: Need help uploading WordPress theme files

مرحباً،

أحتاج رفع ملفات ثيم WordPress جديد إلى موقعي.

المسار المطلوب:
/public_html/wp-content/themes/custom-theme/

الملفات تشمل:
- 9 ملفات PHP
- 1 ملف CSS  
- مجلد images (مع صورتين)
- مجلد js (مع ملف JavaScript)

هل يمكنكم:
1. إما رفع الملفات نيابة عني
2. أو إعطائي بيانات FTP الصحيحة
3. أو تفعيل صلاحية رفع الملفات عبر cPanel

شكراً
```

---

## ملاحظات مهمة:

1. **احتفظ بنسخة احتياطية:**
   - قبل الرفع، احفظ الملفات القديمة
   - أو اطلب من الاستضافة backup

2. **لا تحذف ملفات WordPress الأساسية:**
   - فقط احذف/عدّل مجلد custom-theme
   - لا تمس wp-admin أو wp-includes

3. **تحقق من الصلاحيات:**
   - الملفات: 644
   - المجلدات: 755

4. **امسح الكاش بعد كل تعديل:**
   - متصفح + WordPress + CDN (إن وجد)

---

**آخر تحديث:** 30 سبتمبر 2025  
**الإصدار:** 2.0


