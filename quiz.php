<?php
$page_title = "الاختبار التجريبي - اختبر قدراتك المعرفية";
$page_description = "اختبار تجريبي شامل لقياس القدرات المعرفية والاستعداد لاختبارات القدرات";
$additional_css = ['assets/css/quiz.css'];
$additional_js = ['assets/js/quiz.js'];

include 'includes/header.php';
?>

<style>
/* Quiz Specific Styles */
.quiz-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 40px 20px;
}

.quiz-header {
    text-align: center;
    margin-bottom: 40px;
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.quiz-header h1 {
    font-size: 2.5rem;
    color: #1e293b;
    margin-bottom: 15px;
    font-weight: 700;
}

.quiz-header p {
    font-size: 1.2rem;
    color: #64748b;
    margin-bottom: 30px;
}

.quiz-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.info-item {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    border-left: 4px solid #2563EB;
}

.info-item i {
    font-size: 2rem;
    color: #2563EB;
    margin-bottom: 10px;
    display: block;
}

.info-item h3 {
    font-size: 1.1rem;
    color: #1e293b;
    margin-bottom: 5px;
    font-weight: 600;
}

.info-item p {
    color: #64748b;
    margin: 0;
    font-size: 0.95rem;
}

.quiz-progress {
    background: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.progress-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.progress-bar {
    width: 100%;
    height: 12px;
    background: #e9ecef;
    border-radius: 6px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: #2563EB;
    border-radius: 6px;
    transition: width 0.3s ease;
    width: 0%;
}

.question-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border-top: 5px solid #2563EB;
}

.question-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 25px;
}

.question-number {
    background: #2563EB;
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1.1rem;
}

.question-category {
    background: #e3f2fd;
    color: #1976d2;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
}

.question-text {
    font-size: 1.3rem;
    color: #1e293b;
    margin-bottom: 25px;
    line-height: 1.8;
    font-weight: 500;
}

.question-image {
    max-width: 100%;
    height: auto;
    border-radius: 15px;
    margin: 20px 0;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.options-container {
    display: grid;
    gap: 15px;
    margin-bottom: 30px;
}

.option {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 15px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 15px;
    font-size: 1.1rem;
}

.option:hover {
    background: #eff6ff;
    border-color: #2563EB;
    transform: translateX(-5px);
}

.option.selected {
    background: #2563EB;
    color: white;
    border-color: #2563EB;
}

.option.correct {
    background: #d4edda;
    border-color: #28a745;
    color: #155724;
}

.option.incorrect {
    background: #f8d7da;
    border-color: #dc3545;
    color: #721c24;
}

.option-letter {
    background: white;
    color: #2563EB;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.option.selected .option-letter {
    background: white;
    color: #2563EB;
}

.option.correct .option-letter {
    background: #28a745;
    color: white;
}

.option.incorrect .option-letter {
    background: #dc3545;
    color: white;
}

.quiz-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
    flex-wrap: wrap;
    gap: 20px;
}

.timer {
    background: #fff3cd;
    color: #856404;
    padding: 15px 25px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1.1rem;
    border: 2px solid #ffeaa7;
}

.timer.warning {
    background: #f8d7da;
    color: #721c24;
    border-color: #f5c6cb;
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.explanation {
    background: #e8f5e8;
    border: 2px solid #28a745;
    border-radius: 15px;
    padding: 25px;
    margin-top: 20px;
    display: none;
}

.explanation.show {
    display: block;
    animation: fadeIn 0.5s ease;
}

.explanation h4 {
    color: #155724;
    margin-bottom: 15px;
    font-size: 1.2rem;
    font-weight: 600;
}

.explanation p {
    color: #155724;
    line-height: 1.8;
    margin: 0;
}

.quiz-results {
    background: white;
    border-radius: 20px;
    padding: 40px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: none;
}

.results-score {
    font-size: 4rem;
    font-weight: 700;
    color: #2563EB;
    margin-bottom: 20px;
}

.results-message {
    font-size: 1.5rem;
    color: #1e293b;
    margin-bottom: 30px;
    font-weight: 600;
}

.results-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 30px 0;
}

.result-item {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 15px;
    border-left: 4px solid #2563EB;
}

.result-item h4 {
    color: #1e293b;
    margin-bottom: 10px;
    font-size: 1.1rem;
    font-weight: 600;
}

.result-item p {
    color: #64748b;
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
}

/* Responsive Design */
@media (max-width: 768px) {
    .quiz-container {
        padding: 20px 10px;
    }
    
    .quiz-header {
        padding: 30px 20px;
    }
    
    .quiz-header h1 {
        font-size: 2rem;
    }
    
    .question-card {
        padding: 25px 20px;
    }
    
    .question-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .quiz-controls {
        flex-direction: column;
        align-items: stretch;
    }
    
    .timer {
        text-align: center;
    }
    
    .results-score {
        font-size: 3rem;
    }
}
</style>

<main class="main-content">
    <div class="quiz-container">
        <!-- Quiz Header -->
        <div class="quiz-header">
            <h1><i class="fas fa-brain"></i> الاختبار التجريبي</h1>
            <p>اختبر قدراتك المعرفية واستعد لاختبارات القدرات الفعلية</p>
            
            <div class="quiz-info">
                <div class="info-item">
                    <i class="fas fa-question-circle"></i>
                    <h3>عدد الأسئلة</h3>
                    <p>20 سؤال</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <h3>المدة الزمنية</h3>
                    <p>30 دقيقة</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-chart-line"></i>
                    <h3>نوع الاختبار</h3>
                    <p>قدرات معرفية</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-award"></i>
                    <h3>النتيجة</h3>
                    <p>فورية</p>
                </div>
            </div>
            
            <button id="startQuiz" class="btn btn-primary mt-20">
                <i class="fas fa-play"></i> ابدأ الاختبار
            </button>
        </div>

        <!-- Quiz Progress -->
        <div id="quizProgress" class="quiz-progress" style="display: none;">
            <div class="progress-header">
                <span id="progressText">السؤال 1 من 20</span>
                <span id="timer" class="timer">30:00</span>
            </div>
            <div class="progress-bar">
                <div id="progressFill" class="progress-fill"></div>
            </div>
        </div>

        <!-- Quiz Question -->
        <div id="quizQuestion" class="question-card" style="display: none;">
            <div class="question-header">
                <span id="questionNumber" class="question-number">السؤال 1</span>
                <span id="questionCategory" class="question-category">القدرة اللفظية</span>
            </div>
            
            <div id="questionText" class="question-text">
                <!-- Question text will be inserted here -->
            </div>
            
            <div id="questionImage" style="display: none;">
                <img class="question-image" alt="صورة السؤال">
            </div>
            
            <div id="optionsContainer" class="options-container">
                <!-- Options will be inserted here -->
            </div>
            
            <div id="explanation" class="explanation">
                <h4><i class="fas fa-lightbulb"></i> شرح الإجابة:</h4>
                <p id="explanationText"></p>
            </div>
            
            <div class="quiz-controls">
                <button id="prevBtn" class="btn btn-secondary" style="display: none;">
                    <i class="fas fa-arrow-right"></i> السؤال السابق
                </button>
                <button id="nextBtn" class="btn btn-primary" disabled>
                    <i class="fas fa-arrow-left"></i> السؤال التالي
                </button>
                <button id="finishBtn" class="btn btn-primary" style="display: none;">
                    <i class="fas fa-check"></i> إنهاء الاختبار
                </button>
            </div>
        </div>

        <!-- Quiz Results -->
        <div id="quizResults" class="quiz-results">
            <h2><i class="fas fa-trophy"></i> نتائج الاختبار</h2>
            <div id="resultsScore" class="results-score">85%</div>
            <div id="resultsMessage" class="results-message">أداء ممتاز! استمر في التدريب</div>
            
            <div class="results-details">
                <div class="result-item">
                    <h4>الإجابات الصحيحة</h4>
                    <p id="correctAnswers">17</p>
                </div>
                <div class="result-item">
                    <h4>الإجابات الخاطئة</h4>
                    <p id="wrongAnswers">3</p>
                </div>
                <div class="result-item">
                    <h4>الوقت المستغرق</h4>
                    <p id="timeSpent">25:30</p>
                </div>
                <div class="result-item">
                    <h4>النسبة المئوية</h4>
                    <p id="percentage">85%</p>
                </div>
            </div>
            
            <div style="margin-top: 40px;">
                <button id="retakeQuiz" class="btn btn-primary">
                    <i class="fas fa-redo"></i> إعادة الاختبار
                </button>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-home"></i> العودة للرئيسية
                </a>
            </div>
        </div>
    </div>
</main>

<script>
// Quiz Data - Sample questions
const quizData = [
    {
        id: 1,
        question: "ما هو الرقم التالي في هذه السلسلة: 2, 4, 8, 16, ؟",
        options: ["24", "32", "30", "28"],
        correct: 1,
        category: "القدرة الكمية",
        explanation: "هذه سلسلة هندسية حيث كل رقم يضاعف الرقم السابق. 16 × 2 = 32"
    },
    {
        id: 2,
        question: "أي من الكلمات التالية لا تنتمي للمجموعة؟",
        options: ["قلم", "كتاب", "مسطرة", "تفاحة"],
        correct: 3,
        category: "القدرة اللفظية",
        explanation: "تفاحة هي الوحيدة التي ليست من الأدوات المكتبية"
    },
    {
        id: 3,
        question: "إذا كان 3x + 5 = 14، فما قيمة x؟",
        options: ["2", "3", "4", "5"],
        correct: 1,
        category: "القدرة الكمية",
        explanation: "3x + 5 = 14، إذن 3x = 9، وبالتالي x = 3"
    },
    {
        id: 4,
        question: "ما هو المرادف الأقرب لكلمة 'متقن'؟",
        options: ["مهمل", "ماهر", "بطيء", "ضعيف"],
        correct: 1,
        category: "القدرة اللفظية",
        explanation: "متقن تعني ماهر أو خبير في عمله"
    },
    {
        id: 5,
        question: "أكمل النمط: △ ○ □ △ ○ ؟",
        options: ["△", "○", "□", "◇"],
        correct: 2,
        category: "التفكير المنطقي",
        explanation: "النمط يتكرر كل ثلاثة رموز: مثلث، دائرة، مربع"
    }
];

let currentQuestion = 0;
let userAnswers = [];
let startTime;
let timerInterval;
let timeRemaining = 30 * 60; // 30 minutes in seconds

// Quiz functionality
document.getElementById('startQuiz').addEventListener('click', startQuiz);
document.getElementById('nextBtn').addEventListener('click', nextQuestion);
document.getElementById('prevBtn').addEventListener('click', prevQuestion);
document.getElementById('finishBtn').addEventListener('click', finishQuiz);
document.getElementById('retakeQuiz').addEventListener('click', retakeQuiz);

function startQuiz() {
    document.querySelector('.quiz-header').style.display = 'none';
    document.getElementById('quizProgress').style.display = 'block';
    document.getElementById('quizQuestion').style.display = 'block';
    
    startTime = new Date();
    startTimer();
    showQuestion(0);
}

function startTimer() {
    timerInterval = setInterval(() => {
        timeRemaining--;
        updateTimerDisplay();
        
        if (timeRemaining <= 0) {
            finishQuiz();
        } else if (timeRemaining <= 300) { // Last 5 minutes
            document.getElementById('timer').classList.add('warning');
        }
    }, 1000);
}

function updateTimerDisplay() {
    const minutes = Math.floor(timeRemaining / 60);
    const seconds = timeRemaining % 60;
    document.getElementById('timer').textContent = 
        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
}

function showQuestion(index) {
    const question = quizData[index];
    currentQuestion = index;
    
    // Update progress
    document.getElementById('progressText').textContent = `السؤال ${index + 1} من ${quizData.length}`;
    document.getElementById('progressFill').style.width = `${((index + 1) / quizData.length) * 100}%`;
    
    // Update question
    document.getElementById('questionNumber').textContent = `السؤال ${index + 1}`;
    document.getElementById('questionCategory').textContent = question.category;
    document.getElementById('questionText').textContent = question.question;
    
    // Hide image by default
    document.getElementById('questionImage').style.display = 'none';
    
    // Create options
    const optionsContainer = document.getElementById('optionsContainer');
    optionsContainer.innerHTML = '';
    
    question.options.forEach((option, i) => {
        const optionElement = document.createElement('div');
        optionElement.className = 'option';
        optionElement.innerHTML = `
            <div class="option-letter">${String.fromCharCode(65 + i)}</div>
            <span>${option}</span>
        `;
        
        optionElement.addEventListener('click', () => selectOption(i));
        optionsContainer.appendChild(optionElement);
    });
    
    // Update navigation buttons
    document.getElementById('prevBtn').style.display = index > 0 ? 'block' : 'none';
    document.getElementById('nextBtn').style.display = index < quizData.length - 1 ? 'block' : 'none';
    document.getElementById('finishBtn').style.display = index === quizData.length - 1 ? 'block' : 'none';
    
    // Restore previous answer if exists
    if (userAnswers[index] !== undefined) {
        selectOption(userAnswers[index], false);
    }
    
    // Hide explanation
    document.getElementById('explanation').classList.remove('show');
}

function selectOption(optionIndex, updateAnswer = true) {
    // Remove previous selection
    document.querySelectorAll('.option').forEach(opt => opt.classList.remove('selected'));
    
    // Add selection to clicked option
    document.querySelectorAll('.option')[optionIndex].classList.add('selected');
    
    if (updateAnswer) {
        userAnswers[currentQuestion] = optionIndex;
    }
    
    // Enable next button
    document.getElementById('nextBtn').disabled = false;
    document.getElementById('finishBtn').disabled = false;
}

function nextQuestion() {
    if (currentQuestion < quizData.length - 1) {
        showQuestion(currentQuestion + 1);
    }
}

function prevQuestion() {
    if (currentQuestion > 0) {
        showQuestion(currentQuestion - 1);
    }
}

function finishQuiz() {
    clearInterval(timerInterval);
    
    // Calculate results
    let correctCount = 0;
    quizData.forEach((question, index) => {
        if (userAnswers[index] === question.correct) {
            correctCount++;
        }
    });
    
    const percentage = Math.round((correctCount / quizData.length) * 100);
    const endTime = new Date();
    const timeSpent = Math.round((endTime - startTime) / 1000);
    const timeSpentFormatted = `${Math.floor(timeSpent / 60)}:${(timeSpent % 60).toString().padStart(2, '0')}`;
    
    // Show results
    document.getElementById('quizProgress').style.display = 'none';
    document.getElementById('quizQuestion').style.display = 'none';
    document.getElementById('quizResults').style.display = 'block';
    
    document.getElementById('resultsScore').textContent = `${percentage}%`;
    document.getElementById('correctAnswers').textContent = correctCount;
    document.getElementById('wrongAnswers').textContent = quizData.length - correctCount;
    document.getElementById('timeSpent').textContent = timeSpentFormatted;
    document.getElementById('percentage').textContent = `${percentage}%`;
    
    // Update message based on score
    let message = '';
    if (percentage >= 90) {
        message = 'ممتاز جداً! أداء استثنائي';
    } else if (percentage >= 80) {
        message = 'أداء ممتاز! استمر في التدريب';
    } else if (percentage >= 70) {
        message = 'أداء جيد، يمكنك التحسن أكثر';
    } else if (percentage >= 60) {
        message = 'أداء مقبول، تحتاج لمزيد من التدريب';
    } else {
        message = 'تحتاج لمراجعة المفاهيم والتدريب أكثر';
    }
    
    document.getElementById('resultsMessage').textContent = message;
}

function retakeQuiz() {
    // Reset quiz state
    currentQuestion = 0;
    userAnswers = [];
    timeRemaining = 30 * 60;
    
    // Show quiz header
    document.querySelector('.quiz-header').style.display = 'block';
    document.getElementById('quizProgress').style.display = 'none';
    document.getElementById('quizQuestion').style.display = 'none';
    document.getElementById('quizResults').style.display = 'none';
    
    // Reset timer display
    document.getElementById('timer').classList.remove('warning');
    updateTimerDisplay();
}

// Load questions from MySQL database
async function loadQuestions() {
    try {
        const response = await fetch('api/get_questions.php?limit=20');
        if (response.ok) {
            const serverQuestions = await response.json();
            if (serverQuestions && serverQuestions.length > 0) {
                // Use database questions instead of sample data
                quizData.length = 0;
                quizData.push(...serverQuestions);
                console.log(`Loaded ${serverQuestions.length} questions from database`);
            } else {
                console.log('No questions found in database, using sample questions');
            }
        }
    } catch (error) {
        console.log('Error loading questions, using sample questions:', error);
    }
}

// Initialize quiz
loadQuestions();
</script>

<?php include 'includes/footer.php'; ?>