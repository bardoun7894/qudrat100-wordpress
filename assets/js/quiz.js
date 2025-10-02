// Quiz JavaScript Functionality
class QuizApp {
    constructor() {
        this.questions = [];
        this.currentQuestion = 0;
        this.userAnswers = [];
        this.timeRemaining = 30 * 60; // 30 minutes in seconds
        this.timerInterval = null;
        this.quizStarted = false;
        this.quizCompleted = false;
        
        this.init();
    }
    
    init() {
        this.loadQuestions();
        this.setupEventListeners();
        this.startTimer();
    }
    
    async loadQuestions() {
        try {
            const response = await fetch('api/get_questions.php');
            const data = await response.json();
            
            if (data.success) {
                this.questions = data.questions;
                this.displayQuestion();
                this.updateProgress();
            } else {
                this.showError('فشل في تحميل الأسئلة. يرجى المحاولة مرة أخرى.');
            }
        } catch (error) {
            console.error('Error loading questions:', error);
            this.showError('حدث خطأ في تحميل الأسئلة. يرجى التحقق من الاتصال بالإنترنت.');
        }
    }
    
    displayQuestion() {
        if (this.currentQuestion >= this.questions.length) {
            this.completeQuiz();
            return;
        }
        
        const question = this.questions[this.currentQuestion];
        const container = document.getElementById('question-container');
        
        if (!container) return;
        
        let imageHtml = '';
        if (question.image_path && question.image_path.trim() !== '') {
            imageHtml = `<img src="${question.image_path}" alt="صورة السؤال" class="question-image">`;
        }
        
        container.innerHTML = `
            <div class="question-number">
                السؤال ${this.currentQuestion + 1} من ${this.questions.length}
            </div>
            <div class="question-text">
                ${question.question_text}
            </div>
            ${imageHtml}
            <div class="options-container">
                <div class="option" data-option="A">
                    <span class="option-label">أ)</span>
                    ${question.option_a}
                </div>
                <div class="option" data-option="B">
                    <span class="option-label">ب)</span>
                    ${question.option_b}
                </div>
                <div class="option" data-option="C">
                    <span class="option-label">ج)</span>
                    ${question.option_c}
                </div>
                <div class="option" data-option="D">
                    <span class="option-label">د)</span>
                    ${question.option_d}
                </div>
            </div>
        `;
        
        // Restore previous answer if exists
        if (this.userAnswers[this.currentQuestion]) {
            const selectedOption = container.querySelector(`[data-option="${this.userAnswers[this.currentQuestion]}"]`);
            if (selectedOption) {
                selectedOption.classList.add('selected');
            }
        }
        
        this.updateNavigationButtons();
    }
    
    setupEventListeners() {
        // Option selection
        document.addEventListener('click', (e) => {
            if (e.target.closest('.option')) {
                this.selectOption(e.target.closest('.option'));
            }
        });
        
        // Navigation buttons
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('submit-btn');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => this.previousQuestion());
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', () => this.nextQuestion());
        }
        
        if (submitBtn) {
            submitBtn.addEventListener('click', () => this.completeQuiz());
        }
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (this.quizCompleted) return;
            
            switch(e.key) {
                case 'ArrowLeft':
                    this.nextQuestion();
                    break;
                case 'ArrowRight':
                    this.previousQuestion();
                    break;
                case '1':
                case 'أ':
                    this.selectOptionByKey('A');
                    break;
                case '2':
                case 'ب':
                    this.selectOptionByKey('B');
                    break;
                case '3':
                case 'ج':
                    this.selectOptionByKey('C');
                    break;
                case '4':
                case 'د':
                    this.selectOptionByKey('D');
                    break;
            }
        });
    }
    
    selectOption(optionElement) {
        if (this.quizCompleted) return;
        
        // Remove previous selection
        const container = document.getElementById('question-container');
        const options = container.querySelectorAll('.option');
        options.forEach(opt => opt.classList.remove('selected'));
        
        // Add selection to clicked option
        optionElement.classList.add('selected');
        
        // Store answer
        const selectedOption = optionElement.getAttribute('data-option');
        this.userAnswers[this.currentQuestion] = selectedOption;
        
        // Auto-advance after a short delay (optional)
        setTimeout(() => {
            if (this.currentQuestion < this.questions.length - 1) {
                this.nextQuestion();
            }
        }, 500);
    }
    
    selectOptionByKey(option) {
        const container = document.getElementById('question-container');
        const optionElement = container.querySelector(`[data-option="${option}"]`);
        if (optionElement) {
            this.selectOption(optionElement);
        }
    }
    
    nextQuestion() {
        if (this.currentQuestion < this.questions.length - 1) {
            this.currentQuestion++;
            this.displayQuestion();
            this.updateProgress();
        }
    }
    
    previousQuestion() {
        if (this.currentQuestion > 0) {
            this.currentQuestion--;
            this.displayQuestion();
            this.updateProgress();
        }
    }
    
    updateProgress() {
        const progressBar = document.querySelector('.quiz-progress-bar');
        if (progressBar) {
            const progress = ((this.currentQuestion + 1) / this.questions.length) * 100;
            progressBar.style.width = `${progress}%`;
        }
        
        const questionInfo = document.querySelector('.question-info');
        if (questionInfo) {
            questionInfo.textContent = `السؤال ${this.currentQuestion + 1} من ${this.questions.length}`;
        }
    }
    
    updateNavigationButtons() {
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('submit-btn');
        
        if (prevBtn) {
            prevBtn.style.display = this.currentQuestion > 0 ? 'inline-flex' : 'none';
        }
        
        if (nextBtn) {
            nextBtn.style.display = this.currentQuestion < this.questions.length - 1 ? 'inline-flex' : 'none';
        }
        
        if (submitBtn) {
            submitBtn.style.display = this.currentQuestion === this.questions.length - 1 ? 'inline-flex' : 'none';
        }
    }
    
    startTimer() {
        this.updateTimerDisplay();
        
        this.timerInterval = setInterval(() => {
            this.timeRemaining--;
            this.updateTimerDisplay();
            
            if (this.timeRemaining <= 0) {
                this.completeQuiz();
            }
        }, 1000);
    }
    
    updateTimerDisplay() {
        const timerElement = document.querySelector('.quiz-timer');
        if (timerElement) {
            const minutes = Math.floor(this.timeRemaining / 60);
            const seconds = this.timeRemaining % 60;
            timerElement.innerHTML = `
                <i class="fas fa-clock"></i>
                الوقت المتبقي: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}
            `;
            
            // Change color when time is running low
            if (this.timeRemaining <= 300) { // 5 minutes
                timerElement.style.background = 'linear-gradient(135deg, #e74c3c, #c0392b)';
            } else if (this.timeRemaining <= 600) { // 10 minutes
                timerElement.style.background = 'linear-gradient(135deg, #f39c12, #e67e22)';
            }
        }
    }
    
    async completeQuiz() {
        if (this.quizCompleted) return;
        
        this.quizCompleted = true;
        clearInterval(this.timerInterval);
        
        // Calculate results
        const results = this.calculateResults();
        
        // Save results to database
        await this.saveResults(results);
        
        // Display results
        this.displayResults(results);
    }
    
    calculateResults() {
        let correctAnswers = 0;
        let totalQuestions = this.questions.length;
        
        for (let i = 0; i < totalQuestions; i++) {
            if (this.userAnswers[i] === this.questions[i].correct_answer) {
                correctAnswers++;
            }
        }
        
        const percentage = Math.round((correctAnswers / totalQuestions) * 100);
        const timeSpent = (30 * 60) - this.timeRemaining;
        
        return {
            correct: correctAnswers,
            total: totalQuestions,
            percentage: percentage,
            timeSpent: timeSpent,
            answers: this.userAnswers
        };
    }
    
    async saveResults(results) {
        try {
            const response = await fetch('api/save_results.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    correct_answers: results.correct,
                    total_questions: results.total,
                    percentage: results.percentage,
                    time_spent: results.timeSpent,
                    answers: results.answers
                })
            });
            
            const data = await response.json();
            if (!data.success) {
                console.error('Failed to save results:', data.message);
            }
        } catch (error) {
            console.error('Error saving results:', error);
        }
    }
    
    displayResults(results) {
        const container = document.getElementById('quiz-container');
        if (!container) return;
        
        let performanceMessage = '';
        let performanceClass = '';
        
        if (results.percentage >= 90) {
            performanceMessage = 'ممتاز! أداء رائع جداً';
            performanceClass = 'excellent';
        } else if (results.percentage >= 80) {
            performanceMessage = 'جيد جداً! أداء مميز';
            performanceClass = 'very-good';
        } else if (results.percentage >= 70) {
            performanceMessage = 'جيد! يمكنك التحسن أكثر';
            performanceClass = 'good';
        } else if (results.percentage >= 60) {
            performanceMessage = 'مقبول، تحتاج لمزيد من التدريب';
            performanceClass = 'acceptable';
        } else {
            performanceMessage = 'يحتاج لمزيد من الدراسة والتدريب';
            performanceClass = 'needs-improvement';
        }
        
        const timeSpentMinutes = Math.floor(results.timeSpent / 60);
        const timeSpentSeconds = results.timeSpent % 60;
        
        container.innerHTML = `
            <div class="quiz-results ${performanceClass}">
                <h2 class="quiz-title">نتائج الاختبار</h2>
                <div class="results-score">${results.percentage}%</div>
                <div class="results-message">${performanceMessage}</div>
                
                <div class="results-details">
                    <div class="result-item">
                        <div class="result-value">${results.correct}</div>
                        <div class="result-label">إجابات صحيحة</div>
                    </div>
                    <div class="result-item">
                        <div class="result-value">${results.total - results.correct}</div>
                        <div class="result-label">إجابات خاطئة</div>
                    </div>
                    <div class="result-item">
                        <div class="result-value">${results.total}</div>
                        <div class="result-label">إجمالي الأسئلة</div>
                    </div>
                    <div class="result-item">
                        <div class="result-value">${timeSpentMinutes}:${timeSpentSeconds.toString().padStart(2, '0')}</div>
                        <div class="result-label">الوقت المستغرق</div>
                    </div>
                </div>
                
                <div class="quiz-navigation">
                    <a href="quiz.php" class="btn btn-primary">
                        <i class="fas fa-redo"></i> إعادة الاختبار
                    </a>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-home"></i> العودة للرئيسية
                    </a>
                    <button onclick="window.print()" class="btn btn-success">
                        <i class="fas fa-print"></i> طباعة النتائج
                    </button>
                </div>
            </div>
        `;
    }
    
    showError(message) {
        const container = document.getElementById('quiz-container');
        if (container) {
            container.innerHTML = `
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>حدث خطأ</h3>
                    <p>${message}</p>
                    <a href="quiz.php" class="btn btn-primary">
                        <i class="fas fa-redo"></i> إعادة المحاولة
                    </a>
                </div>
            `;
        }
    }
}

// Initialize quiz when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Only initialize if we're on the quiz page
    if (document.getElementById('quiz-container')) {
        new QuizApp();
    }
});

// Prevent page refresh during quiz
window.addEventListener('beforeunload', function(e) {
    if (window.quizApp && !window.quizApp.quizCompleted) {
        e.preventDefault();
        e.returnValue = 'هل أنت متأكد من أنك تريد مغادرة الصفحة؟ ستفقد تقدمك في الاختبار.';
        return e.returnValue;
    }
});

// Utility functions
function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;
    return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle"></i>
        ${message}
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}