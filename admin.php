<?php
$page_title = "لوحة الإدارة - إدارة الأسئلة والصور";
$page_description = "لوحة تحكم لإضافة وتعديل أسئلة الاختبارات والصور";
$additional_css = ['assets/css/admin.css'];
$additional_js = ['assets/js/admin.js'];

// Enhanced authentication with IP logging
session_start();
$admin_password = "admin123"; // Change this to a secure password

// Limit login attempts (basic protection)
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

// Reset attempts after 15 minutes
if (time() - $_SESSION['last_attempt_time'] > 900) {
    $_SESSION['login_attempts'] = 0;
}

if (isset($_POST['login'])) {
    // Check if too many attempts
    if ($_SESSION['login_attempts'] >= 5) {
        $login_error = "تم تجاوز عدد المحاولات المسموحة. يرجى المحاولة بعد 15 دقيقة";
    } elseif ($_POST['password'] === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['login_attempts'] = 0;
        $_SESSION['admin_login_time'] = time();
        $_SESSION['admin_ip'] = $_SERVER['REMOTE_ADDR'];
    } else {
        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = time();
        $login_error = "كلمة المرور غير صحيحة. المحاولات المتبقية: " . (5 - $_SESSION['login_attempts']);
    }
}

// Auto logout after 2 hours of inactivity
if (isset($_SESSION['admin_logged_in']) && isset($_SESSION['admin_login_time'])) {
    if (time() - $_SESSION['admin_login_time'] > 7200) {
        session_destroy();
        header("Location: admin.php");
        exit;
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

// Database connection
$conn = null;
if (isset($_SESSION['admin_logged_in'])) {
    $conn = include 'includes/db_connection.php';
}

// Handle question submission
if (isset($_POST['add_question']) && isset($_SESSION['admin_logged_in']) && $conn) {
    // Handle image upload
    $image_path = '';
    if (isset($_FILES['question_image']) && $_FILES['question_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES['question_image']['name'], PATHINFO_EXTENSION);
        $file_name = uniqid() . '.' . $file_extension;
        $image_path = $upload_dir . $file_name;
        
        if (!move_uploaded_file($_FILES['question_image']['tmp_name'], $image_path)) {
            $image_path = '';
        }
    }
    
    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO quiz_questions (question_text, image_path, option_a, option_b, option_c, option_d, correct_answer, explanation, category, difficulty) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssssssss", 
        $_POST['question_text'],
        $image_path,
        $_POST['option_a'],
        $_POST['option_b'],
        $_POST['option_c'],
        $_POST['option_d'],
        $_POST['correct_answer'],
        $_POST['explanation'],
        $_POST['category'],
        $_POST['difficulty']
    );
    
    if ($stmt->execute()) {
        $success_message = "تم إضافة السؤال بنجاح إلى قاعدة البيانات!";
    } else {
        $error_message = "حدث خطأ في حفظ السؤال: " . $stmt->error;
    }
    
    $stmt->close();
}

// Handle question deletion
if (isset($_POST['delete_question']) && isset($_SESSION['admin_logged_in']) && $conn) {
    $question_id = (int)$_POST['question_id'];
    
    // Get image path before deleting
    $stmt = $conn->prepare("SELECT image_path FROM quiz_questions WHERE id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Delete image file if exists
        if (!empty($row['image_path']) && file_exists($row['image_path'])) {
            unlink($row['image_path']);
        }
    }
    $stmt->close();
    
    // Delete question from database
    $stmt = $conn->prepare("DELETE FROM quiz_questions WHERE id = ?");
    $stmt->bind_param("i", $question_id);
    
    if ($stmt->execute()) {
        $success_message = "تم حذف السؤال بنجاح!";
    } else {
        $error_message = "حدث خطأ في حذف السؤال: " . $stmt->error;
    }
    
    $stmt->close();
}

// Load existing questions for display
$existing_questions = [];
if (isset($_SESSION['admin_logged_in']) && $conn) {
    $result = $conn->query("SELECT * FROM quiz_questions ORDER BY id DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $existing_questions[] = [
                'id' => $row['id'],
                'question' => $row['question_text'],
                'image' => $row['image_path'],
                'options' => [
                    $row['option_a'],
                    $row['option_b'],
                    $row['option_c'],
                    $row['option_d']
                ],
                'correct' => (int)$row['correct_answer'],
                'explanation' => $row['explanation'],
                'category' => $row['category'],
                'difficulty' => $row['difficulty'],
                'created_at' => $row['created_at']
            ];
        }
    }
}

include 'includes/header.php';
?>

<style>
/* Admin-specific styles */
.admin-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.login-form {
    max-width: 400px;
    margin: 100px auto;
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    padding: 20px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.admin-tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 30px;
    background: white;
    padding: 10px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.tab-button {
    padding: 15px 25px;
    border: none;
    background: transparent;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
    color: #6c757d;
}

.tab-button.active {
    background: #2563EB;
    color: white;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #1e293b;
}

.form-control {
    width: 100%;
    padding: 15px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: 'Cairo', sans-serif;
}

.form-control:focus {
    border-color: #2563EB;
    outline: none;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.question-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(15, 23, 42, 0.08);
    border-right: 5px solid #2563EB;
}

.question-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.question-meta {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}

.meta-badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.category-badge {
    background: #e3f2fd;
    color: #1976d2;
}

.difficulty-badge {
    background: #fff3e0;
    color: #f57c00;
}

.options-list {
    list-style: none;
    margin: 15px 0;
}

.options-list li {
    padding: 8px 15px;
    margin: 5px 0;
    border-radius: 8px;
    background: #f8f9fa;
}

.options-list li.correct {
    background: #d4edda;
    color: #155724;
    font-weight: 600;
}

.question-image {
    max-width: 200px;
    height: auto;
    border-radius: 10px;
    margin: 15px 0;
}

.alert {
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-weight: 600;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.btn-danger {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 0.9rem;
}

.btn-danger:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .admin-header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .admin-tabs {
        flex-direction: column;
    }
}
</style>

<main class="main-content">
    <div class="admin-container">
        <?php if (!isset($_SESSION['admin_logged_in'])): ?>
            <!-- Login Form -->
            <div class="login-form">
                <h2 class="text-center mb-20">تسجيل دخول الإدارة</h2>
                
                <?php if (isset($login_error)): ?>
                    <div class="alert alert-error"><?php echo $login_error; ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="form-group">
                        <label for="password">كلمة المرور:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-sign-in-alt"></i> دخول
                    </button>
                </form>
            </div>
        <?php else: ?>
            <!-- Admin Dashboard -->
            <div class="admin-header">
                <h1><i class="fas fa-cogs"></i> لوحة إدارة الأسئلة</h1>
                <form method="POST" style="margin: 0;">
                    <button type="submit" name="logout" class="btn btn-secondary">
                        <i class="fas fa-sign-out-alt"></i> خروج
                    </button>
                </form>
            </div>

            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-error"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <!-- Admin Tabs -->
            <div class="admin-tabs">
                <button class="tab-button active" onclick="showTab('add-question')">
                    <i class="fas fa-plus"></i> إضافة سؤال جديد
                </button>
                <button class="tab-button" onclick="showTab('manage-questions')">
                    <i class="fas fa-list"></i> إدارة الأسئلة (<?php echo count($existing_questions); ?>)
                </button>
            </div>

            <!-- Add Question Tab -->
            <div id="add-question" class="tab-content active">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-plus-circle"></i> إضافة سؤال جديد</h2>
                        <p class="card-subtitle">أضف سؤالاً جديداً إلى بنك الأسئلة</p>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="question_text">نص السؤال:</label>
                            <textarea id="question_text" name="question_text" class="form-control" rows="3" required placeholder="اكتب نص السؤال هنا..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="question_image">صورة السؤال (اختيارية):</label>
                            <input type="file" id="question_image" name="question_image" class="form-control" accept="image/*">
                            <small style="color: #6c757d; margin-top: 5px; display: block;">يمكنك إضافة صورة توضيحية للسؤال (PNG, JPG, GIF)</small>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="option_a">الخيار أ:</label>
                                <input type="text" id="option_a" name="option_a" class="form-control" required placeholder="الخيار الأول">
                            </div>
                            <div class="form-group">
                                <label for="option_b">الخيار ب:</label>
                                <input type="text" id="option_b" name="option_b" class="form-control" required placeholder="الخيار الثاني">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="option_c">الخيار ج:</label>
                                <input type="text" id="option_c" name="option_c" class="form-control" required placeholder="الخيار الثالث">
                            </div>
                            <div class="form-group">
                                <label for="option_d">الخيار د:</label>
                                <input type="text" id="option_d" name="option_d" class="form-control" required placeholder="الخيار الرابع">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="correct_answer">الإجابة الصحيحة:</label>
                                <select id="correct_answer" name="correct_answer" class="form-control" required>
                                    <option value="">اختر الإجابة الصحيحة</option>
                                    <option value="0">الخيار أ</option>
                                    <option value="1">الخيار ب</option>
                                    <option value="2">الخيار ج</option>
                                    <option value="3">الخيار د</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">التصنيف:</label>
                                <select id="category" name="category" class="form-control" required>
                                    <option value="">اختر التصنيف</option>
                                    <option value="verbal">القدرة اللفظية</option>
                                    <option value="quantitative">القدرة الكمية</option>
                                    <option value="logical">التفكير المنطقي</option>
                                    <option value="spatial">القدرة المكانية</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="difficulty">مستوى الصعوبة:</label>
                            <select id="difficulty" name="difficulty" class="form-control" required>
                                <option value="">اختر مستوى الصعوبة</option>
                                <option value="easy">سهل</option>
                                <option value="medium">متوسط</option>
                                <option value="hard">صعب</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="explanation">شرح الإجابة:</label>
                            <textarea id="explanation" name="explanation" class="form-control" rows="3" placeholder="اكتب شرحاً مفصلاً للإجابة الصحيحة..."></textarea>
                        </div>

                        <button type="submit" name="add_question" class="btn btn-primary">
                            <i class="fas fa-save"></i> حفظ السؤال
                        </button>
                    </form>
                </div>
            </div>

            <!-- Manage Questions Tab -->
            <div id="manage-questions" class="tab-content">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-list"></i> إدارة الأسئلة الموجودة</h2>
                        <p class="card-subtitle">عرض وإدارة جميع الأسئلة المحفوظة</p>
                    </div>

                    <?php if (empty($existing_questions)): ?>
                        <div style="text-align: center; padding: 40px; color: #6c757d;">
                            <i class="fas fa-question-circle" style="font-size: 3rem; margin-bottom: 20px;"></i>
                            <h3>لا توجد أسئلة محفوظة</h3>
                            <p>ابدأ بإضافة أسئلة جديدة من التبويب الأول</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($existing_questions as $question): ?>
                            <div class="question-card">
                                <div class="question-header">
                                    <h4>السؤال رقم <?php echo $question['id']; ?></h4>
                                    <form method="POST" style="margin: 0;" onsubmit="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                                        <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                                        <button type="submit" name="delete_question" class="btn-danger">
                                            <i class="fas fa-trash"></i> حذف
                                        </button>
                                    </form>
                                </div>

                                <div class="question-meta">
                                    <span class="meta-badge category-badge"><?php echo $question['category']; ?></span>
                                    <span class="meta-badge difficulty-badge"><?php echo $question['difficulty']; ?></span>
                                    <small style="color: #6c757d;">تم الإنشاء: <?php echo $question['created_at']; ?></small>
                                </div>

                                <p><strong>السؤال:</strong> <?php echo htmlspecialchars($question['question']); ?></p>

                                <?php if (!empty($question['image'])): ?>
                                    <img src="<?php echo $question['image']; ?>" alt="صورة السؤال" class="question-image">
                                <?php endif; ?>

                                <ul class="options-list">
                                    <?php foreach ($question['options'] as $index => $option): ?>
                                        <li class="<?php echo $index === $question['correct'] ? 'correct' : ''; ?>">
                                            <?php echo chr(65 + $index); ?>. <?php echo htmlspecialchars($option); ?>
                                            <?php if ($index === $question['correct']): ?>
                                                <i class="fas fa-check" style="margin-right: 10px;"></i>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <?php if (!empty($question['explanation'])): ?>
                                    <p><strong>شرح الإجابة:</strong> <?php echo htmlspecialchars($question['explanation']); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Show selected tab content
    document.getElementById(tabName).classList.add('active');
    
    // Add active class to clicked button
    event.target.classList.add('active');
}

// Preview image before upload
document.getElementById('question_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Remove existing preview
            const existingPreview = document.querySelector('.image-preview');
            if (existingPreview) {
                existingPreview.remove();
            }
            
            // Create new preview
            const preview = document.createElement('div');
            preview.className = 'image-preview';
            preview.innerHTML = `
                <img src="${e.target.result}" style="max-width: 200px; height: auto; border-radius: 10px; margin-top: 10px;">
                <p style="font-size: 0.9rem; color: #6c757d; margin-top: 5px;">معاينة الصورة</p>
            `;
            
            // Insert preview after file input
            e.target.parentNode.appendChild(preview);
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php include 'includes/footer.php'; ?>