# Skill Orbit - Interactive Web-Based Learning

**Minor Project • 2025**

Skill Orbit is a web-based platform designed to make learning programming simple, interactive, and enjoyable. Users can write and execute code directly in their browser without installing any software.

> "Practice instantly. Understand deeply. Learn with confidence."

## 👥 Team Members
- **Rijan Mahat** - Product Owner
- **Pranisha Shrestha** - UX Designer
- **Adarshan Bikram Rana** - Technical Lead
- **Prakrati Giri** - Content Lead

---

## 🚀 The Challenge
Traditional learning methods often fail due to:
- **Boring & Confusing Material:** Textbooks and long videos lack engagement.
- **No Immediate Practice:** Students cannot practice concepts right away.
- **Loss of Motivation:** Learners believe programming is too difficult.
- **Lack of Interactivity:** Existing platforms are often complex or require paid subscriptions.

## 💡 Our Solution
**Interactive, In-Browser Learning**
We empower learners to code with confidence and joy through:
- **In-Browser Editor:** Write and execute code directly without software installation.
- **Real-time Feedback:** Instant output on code execution.
- **Step-by-step Tutorials:** Structured lessons and hands-on exercises.
- **Gamification:** Interactive quizzes and coding challenges.

---

## 🎯 Project Goals
1.  **Accessibility:** Make learning accessible to everyone, especially beginners.
2.  **Engagement:** Make learning fun through challenges and interactivity.
3.  **Effectiveness:** Enable online practice without setup.
4.  **Progress Tracking:** Allow users to monitor their learning journey.

## 🛠️ Technical Stack
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL (SQLite used for local development)
- **Version Control:** Git & GitHub

---

## 📦 Installation & Setup

1.  **Clone the repository**
    ```bash
    git clone https://github.com/yourusername/skill-orbit.git
    cd skill-orbit
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    ```

3.  **Initialize Database**
    The application uses SQLite for development. The database file is created automatically in `database/database.sqlite`.
    To reset the database:
    ```bash
    sqlite3 database/database.sqlite < database/schema.sql
    ```

4.  **Run the Application**
    Start the built-in PHP development server:
    ```bash
    php -S localhost:8000 -t public
    ```

5.  **Access the App**
    Open your browser and navigate to: `http://localhost:8000`

---

## 🗺️ Roadmap
- [x] **Phase 1: Analysis** - Requirement gathering
- [x] **Phase 2: Design** - UI/UX and Database design
- [x] **Phase 3: Development** - Frontend & Backend implementation (MVP Complete)
- [ ] **Phase 4: Integration** - System testing
- [ ] **Phase 5: Launch** - Deployment

---

**Contact:** Skill Orbit Team