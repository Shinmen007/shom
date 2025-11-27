# Shinmen - Interactive Coding Learning Platform

![Shinmen Banner](https://img.shields.io/badge/Learn-Code-blue?style=for-the-badge) ![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat-square&logo=php&logoColor=white) ![SQLite](https://img.shields.io/badge/SQLite-07405E?style=flat-square&logo=sqlite&logoColor=white) ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)

**Minor Project • 2025**

Shinmen is a modern, interactive web-based platform that makes learning programming simple, engaging, and accessible. Write and execute code directly in your browser with real-time feedback, structured lessons, gamified progress tracking, and zero setup required.

> "Practice instantly. Understand deeply. Learn with confidence."

---

## ✨ Key Features

### 🚀 **Interactive Code Editor & Playground**
- Browser-based code execution for Python, JavaScript, and more
- Real-time syntax highlighting and output display
- Instant feedback without any local environment setup
- Save and share code snippets

### 📚 **Structured Learning Paths**
- Comprehensive courses from beginner to advanced
- Step-by-step lessons with hands-on exercises
- Interactive coding challenges and quizzes
- Multiple programming languages (Python, JavaScript, Java, C++ coming soon)

### 🎮 **Gamification & Progress Tracking**
- Earn XP points for completing lessons and exercises
- Unlock badges and achievements
- Maintain daily learning streaks
- Visual progress dashboard with statistics

### 👤 **Personalized Experience**
- User authentication and profile management
- Track course completion and learning history
- Personalized learning recommendations
- Save progress across devices

---

## 👥 Team Members
- **Rijan Mahat** - Product Owner
- **Pranisha Shrestha** - UX/UI Designer
- **Adarshan Bikram Rana** - Technical Lead & Backend Developer
- **Prakrati Giri** - Content Lead & Curriculum Designer

---

## 🛠️ Technology Stack

### **Frontend**
- HTML5, CSS3 (Modern Design System)
- JavaScript (ES6+)
- Responsive & Mobile-first Design
- Real-time Syntax Highlighting

### **Backend**
- PHP 8.0+ (PSR-4 Autoloading)
- Custom MVC Router
- RESTful API Endpoints

### **Database**
- SQLite (Development)
- MySQL/PostgreSQL Compatible (Production Ready)
- Comprehensive Schema with Relations

### **Tools & Services**
- Composer (Dependency Management)
- Git & GitHub (Version Control)
- Code Execution API Integration

---

## 📦 Installation & Setup

### **Prerequisites**
- PHP 8.0 or higher
- Composer
- SQLite3 (for development)
- Git

### **Quick Start**

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/shinmen.git
   cd shinmen
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Initialize database**
   ```bash
   # The database file is auto-created at database/database.sqlite
   # To reset or seed the database:
   sqlite3 database/database.sqlite < database/schema.sql
   
   # Optional: Load sample data
   sqlite3 database/database.sqlite < database/seeds/courses.sql
   ```

4. **Start development server**
   ```bash
   php -S localhost:8000 -t public
   ```

5. **Access the application**
   - Open your browser: `http://localhost:8000`
   - Create an account and start learning!

### **Logs**
- PHP server logs: `php_server.log`
- Application errors are logged in the same file

---

## 📂 Project Structure

```
shinmen/
├── public/                  # Web root
│   ├── index.php           # Application entry point & router
│   └── assets/             # CSS, JS, images
├── src/
│   ├── Config/             # Database & app configuration
│   ├── Controllers/        # Request handlers (Auth, Course, Editor, etc.)
│   ├── Models/             # Data models (User, Course, Lesson, etc.)
│   ├── Services/           # Business logic & external APIs
│   └── Views/              # HTML templates (home, courses, editor, etc.)
├── database/
│   ├── schema.sql          # Database structure
│   ├── seeds/              # Sample data
│   └── database.sqlite     # SQLite database file
├── vendor/                 # Composer dependencies
├── composer.json           # PHP dependencies
└── README.md              # This file
```

---

## 🎯 Core Features Explained

### **1. Course System**
- Multiple programming language courses
- Hierarchical structure: Courses → Lessons → Exercises
- Difficulty levels: Beginner, Intermediate, Advanced
- Metadata: Duration estimates, XP rewards, tags

### **2. Progress Tracking**
- Real-time lesson completion status
- Time spent tracking per lesson
- Quiz results and scores history
- Daily activity logs for streak calculation

### **3. Gamification**
- XP system (points for completing lessons, quizzes, exercises)
- Badge/Achievement system
- Daily streak tracking
- Leaderboards (coming soon)

### **4. Code Playground**
- Multi-language support (Python, JavaScript)
- Code execution via secure API
- Save and load code snippets
- Execution history

### **5. Authentication**
- Secure user registration and login
- Password hashing with bcrypt
- Session management
- Avatar support

---

## 🧪 Database Schema

Key tables:
- `users` - User accounts with XP, streaks, and profile data
- `courses` - Programming courses metadata
- `lessons` - Individual lessons within courses
- `exercises` - Coding exercises with test cases
- `quiz_questions` - Quiz questions with multiple choice options
- `user_progress` - Lesson completion tracking
- `quiz_results` - Quiz attempt history
- `user_badges` - Earned achievements
- `user_activity` - Daily activity for streak tracking
- `saved_snippets` - Saved code from playground
- `execution_history` - Code execution logs

---

## 🚀 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/` | Homepage |
| GET | `/courses` | Browse all courses |
| GET | `/course/{id}` | Course overview with lessons |
| GET | `/lesson/{id}` | View specific lesson |
| POST | `/lesson/{id}/complete` | Mark lesson as complete |
| GET | `/course/{id}/quiz` | Take course quiz |
| POST | `/course/{id}/quiz/submit` | Submit quiz answers |
| GET | `/editor` | Code playground |
| POST | `/api/execute` | Execute code |
| GET | `/dashboard` | User dashboard |
| POST | `/login` | User login |
| POST | `/register` | User registration |
| GET | `/logout` | Logout |

---

## 🗺️ Development Roadmap

- [x] **Phase 1: Planning & Analysis** - Requirements gathering, market research
- [x] **Phase 2: Design** - UI/UX wireframes, database schema design
- [x] **Phase 3: Core Development** - MVP with auth, courses, lessons, editor
- [x] **Phase 4: Gamification** - XP system, badges, streaks
- [ ] **Phase 5: Testing & QA** - Unit tests, integration tests, user testing
- [ ] **Phase 6: Optimization** - Performance tuning, SEO, accessibility
- [ ] **Phase 7: Deployment** - Production server setup, CI/CD pipeline
- [ ] **Phase 8: Launch** - Public release and marketing

### **Future Features**
- [ ] Social features (share progress, follow users)
- [ ] Community discussions and forums
- [ ] Code review and mentor system
- [ ] Mobile app (iOS & Android)
- [ ] AI-powered code hints and explanations
- [ ] Certificate generation
- [ ] More languages (TypeScript, Rust, Go, Java, C++)
- [ ] Live coding sessions

---

## 🤝 Contributing

We welcome contributions! To get started:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

## 📞 Contact

**Shinmen Team**  
📧 Email: contact@shinmen.dev  
🌐 Website: [shinmen.dev](https://shinmen.dev)  
💬 Discord: [Join our community](https://discord.gg/shinmen)

---

Made with ❤️ by the Shinmen Team