<?php

namespace App\Config;

use App\Models\Course;
use App\Models\Lesson;

class DatabaseSeeder {
    
    public function seed() {
        $courseModel = new Course();
        $lessonModel = new Lesson();
        
        if (count($courseModel->getAll()) > 0) {
            return;
        }

        // ============ PYTHON COURSE - 15 COMPREHENSIVE LESSONS ============
        $pyId = $courseModel->create(
            'Python Fundamentals',
            'Master Python from scratch. Learn variables, data types, control flow, functions, and data structures with hands-on exercises.',
            'Python',
            'Beginner'
        );

        // Lesson 1: Introduction to Python
        $l1 = $lessonModel->create($pyId, 'Welcome to Python', 
            "Python is one of the most popular programming languages in the world. It's known for its clean, readable syntax that makes it perfect for beginners.\n\n## Why Python?\n- Easy to learn and read\n- Versatile: web, AI, data science, automation\n- Huge community and libraries\n- High demand in job market\n\n## Your First Program\nThe `print()` function displays output:\n\n```python\nprint(\"Hello, World!\")\n```\n\n## Comments\nUse `#` for single-line comments:\n```python\n# This is a comment\nprint(\"Code runs\")  # Inline comment\n```", 1);
        $lessonModel->createExercise($l1, 
            "Print \"Hello, Python!\" to the console.", 
            "# Write your first Python program\nprint(\"...\")", 
            "Hello, Python!");

        // Lesson 2: Variables and Data Types
        $l2 = $lessonModel->create($pyId, 'Variables & Data Types', 
            "Variables store data in memory. Python automatically detects the type.\n\n## Creating Variables\n```python\nname = \"Alice\"      # String (text)\nage = 25            # Integer (whole number)\nheight = 5.7        # Float (decimal)\nis_student = True   # Boolean (True/False)\n```\n\n## Naming Rules\n- Start with letter or underscore\n- Can contain letters, numbers, underscores\n- Case-sensitive (`Name` ≠ `name`)\n- Use snake_case for readability\n\n## Check Type\n```python\nprint(type(name))  # <class 'str'>\n```", 2);
        $lessonModel->createExercise($l2, 
            "Create a variable `username` with value \"coder123\" and print it.", 
            "# Create a string variable\nusername = ...\nprint(username)", 
            "coder123");

        // Lesson 3: Numbers and Math
        $l3 = $lessonModel->create($pyId, 'Numbers & Arithmetic', 
            "Python excels at mathematical operations.\n\n## Operators\n```python\na = 10\nb = 3\n\nprint(a + b)   # Addition: 13\nprint(a - b)   # Subtraction: 7\nprint(a * b)   # Multiplication: 30\nprint(a / b)   # Division: 3.333...\nprint(a // b)  # Floor division: 3\nprint(a % b)   # Modulo (remainder): 1\nprint(a ** b)  # Exponent: 1000\n```\n\n## Order of Operations\nPython follows PEMDAS:\n```python\nresult = 2 + 3 * 4  # 14, not 20\nresult = (2 + 3) * 4  # 20\n```", 3);
        $lessonModel->createExercise($l3, 
            "Calculate 15 divided by 4 using floor division and print the result.", 
            "# Use floor division //\nresult = 15 ... 4\nprint(result)", 
            "3");

        // Lesson 4: Strings
        $l4 = $lessonModel->create($pyId, 'Working with Strings', 
            "Strings are sequences of characters enclosed in quotes.\n\n## Creating Strings\n```python\nsingle = 'Hello'\ndouble = \"World\"\nmulti = '''Multiple\nlines'''\n```\n\n## String Operations\n```python\nname = \"Python\"\nprint(len(name))        # Length: 6\nprint(name.upper())     # PYTHON\nprint(name.lower())     # python\nprint(name[0])          # First char: P\nprint(name[-1])         # Last char: n\nprint(name[0:3])        # Slice: Pyt\n```\n\n## F-Strings (Formatting)\n```python\nage = 25\nprint(f\"I am {age} years old\")\n```", 4);
        $lessonModel->createExercise($l4, 
            "Create a variable `lang` with value \"Python\" and print its length using len().", 
            "lang = \"Python\"\nprint(...)", 
            "6");

        // Lesson 5: String Methods
        $l5 = $lessonModel->create($pyId, 'String Methods & Formatting', 
            "Strings have many built-in methods for manipulation.\n\n## Common Methods\n```python\ntext = \"  Hello World  \"\n\nprint(text.strip())      # Remove whitespace\nprint(text.replace(\"World\", \"Python\"))\nprint(text.split())      # ['Hello', 'World']\nprint(\"Hello\".startswith(\"He\"))  # True\nprint(\"test@email.com\".find(\"@\"))  # 4\n```\n\n## String Concatenation\n```python\nfirst = \"Hello\"\nlast = \"World\"\nfull = first + \" \" + last  # \"Hello World\"\n```\n\n## Escape Characters\n```python\nprint(\"Line1\\nLine2\")  # Newline\nprint(\"Tab\\there\")     # Tab\n```", 5);
        $lessonModel->createExercise($l5, 
            "Convert the string \"hello world\" to uppercase and print it.", 
            "text = \"hello world\"\nprint(text...)", 
            "HELLO WORLD");

        // Lesson 6: User Input
        $l6 = $lessonModel->create($pyId, 'Getting User Input', 
            "The `input()` function reads user input as a string.\n\n## Basic Input\n```python\nname = input(\"Enter your name: \")\nprint(f\"Hello, {name}!\")\n```\n\n## Converting Input\nInput is always a string. Convert for math:\n```python\nage = int(input(\"Enter age: \"))\nheight = float(input(\"Enter height: \"))\n\nyear_born = 2024 - age\nprint(f\"Born in {year_born}\")\n```\n\n## Input Validation\n```python\nnum = input(\"Number: \")\nif num.isdigit():\n    print(int(num) * 2)\n```", 6);
        $lessonModel->createExercise($l6, 
            "Given num_str = \"42\", convert it to an integer and print its double.", 
            "num_str = \"42\"\nnum = ...(num_str)\nprint(num * 2)", 
            "84");

        // Lesson 7: Conditionals - If Statements
        $l7 = $lessonModel->create($pyId, 'Conditional Statements', 
            "Make decisions in your code with if/elif/else.\n\n## Basic If Statement\n```python\nage = 18\nif age >= 18:\n    print(\"Adult\")\n```\n\n## If-Else\n```python\ntemp = 25\nif temp > 30:\n    print(\"Hot\")\nelse:\n    print(\"Nice\")\n```\n\n## If-Elif-Else\n```python\nscore = 85\nif score >= 90:\n    print(\"A\")\nelif score >= 80:\n    print(\"B\")\nelif score >= 70:\n    print(\"C\")\nelse:\n    print(\"F\")\n```\n\n## Comparison Operators\n`==`, `!=`, `>`, `<`, `>=`, `<=`", 7);
        $lessonModel->createExercise($l7, 
            "Check if number 15 is greater than 10. If true, print \"Big\".", 
            "number = 15\nif number ... 10:\n    print(\"Big\")", 
            "Big");

        // Lesson 8: Logical Operators
        $l8 = $lessonModel->create($pyId, 'Logical Operators', 
            "Combine conditions with logical operators.\n\n## AND Operator\nBoth conditions must be True:\n```python\nage = 25\nhas_license = True\nif age >= 18 and has_license:\n    print(\"Can drive\")\n```\n\n## OR Operator\nAt least one condition must be True:\n```python\nis_weekend = True\nis_holiday = False\nif is_weekend or is_holiday:\n    print(\"Day off!\")\n```\n\n## NOT Operator\nReverses the boolean:\n```python\nis_raining = False\nif not is_raining:\n    print(\"Go outside\")\n```", 8);
        $lessonModel->createExercise($l8, 
            "Check if x=5 is greater than 0 AND less than 10. Print \"Valid\" if true.", 
            "x = 5\nif x > 0 ... x < 10:\n    print(\"Valid\")", 
            "Valid");

        // Lesson 9: Lists
        $l9 = $lessonModel->create($pyId, 'Lists - Storing Collections', 
            "Lists store multiple items in order.\n\n## Creating Lists\n```python\nfruits = [\"apple\", \"banana\", \"cherry\"]\nnumbers = [1, 2, 3, 4, 5]\nmixed = [1, \"hello\", True, 3.14]\n```\n\n## Accessing Elements\n```python\nprint(fruits[0])   # apple (first)\nprint(fruits[-1])  # cherry (last)\nprint(fruits[1:3]) # ['banana', 'cherry']\n```\n\n## Modifying Lists\n```python\nfruits.append(\"orange\")    # Add to end\nfruits.insert(0, \"mango\")  # Insert at index\nfruits.remove(\"banana\")    # Remove by value\nfruits.pop()               # Remove last\n```\n\n## List Info\n```python\nprint(len(fruits))         # Length\nprint(\"apple\" in fruits)   # Check membership\n```", 9);
        $lessonModel->createExercise($l9, 
            "Create a list `colors` with \"red\", \"green\", \"blue\" and print the second item.", 
            "colors = [\"red\", \"green\", \"blue\"]\nprint(colors[...])", 
            "green");

        // Lesson 10: For Loops
        $l10 = $lessonModel->create($pyId, 'For Loops', 
            "Iterate over sequences with for loops.\n\n## Loop Through List\n```python\nfruits = [\"apple\", \"banana\", \"cherry\"]\nfor fruit in fruits:\n    print(fruit)\n```\n\n## Range Function\n```python\nfor i in range(5):      # 0, 1, 2, 3, 4\n    print(i)\n\nfor i in range(2, 6):   # 2, 3, 4, 5\n    print(i)\n\nfor i in range(0, 10, 2):  # 0, 2, 4, 6, 8\n    print(i)\n```\n\n## Enumerate\n```python\nfor index, fruit in enumerate(fruits):\n    print(f\"{index}: {fruit}\")\n```", 10);
        $lessonModel->createExercise($l10, 
            "Print numbers 1 to 5 using a for loop with range().", 
            "for i in range(1, ...):\n    print(i)", 
            "1\n2\n3\n4\n5");

        // Lesson 11: While Loops
        $l11 = $lessonModel->create($pyId, 'While Loops', 
            "Execute code while a condition is True.\n\n## Basic While Loop\n```python\ncount = 0\nwhile count < 5:\n    print(count)\n    count += 1  # Increment\n```\n\n## Break Statement\nExit the loop early:\n```python\nwhile True:\n    text = input(\"Enter (q to quit): \")\n    if text == \"q\":\n        break\n    print(f\"You typed: {text}\")\n```\n\n## Continue Statement\nSkip to next iteration:\n```python\nfor i in range(5):\n    if i == 2:\n        continue  # Skip 2\n    print(i)\n```", 11);
        $lessonModel->createExercise($l11, 
            "Create a while loop that prints numbers 0-2, then stops.", 
            "n = 0\nwhile n < ...:\n    print(n)\n    n += 1", 
            "0\n1\n2");

        // Lesson 12: Functions Basics
        $l12 = $lessonModel->create($pyId, 'Functions - Basics', 
            "Functions are reusable blocks of code.\n\n## Defining Functions\n```python\ndef greet():\n    print(\"Hello!\")\n\ngreet()  # Call the function\n```\n\n## Parameters\n```python\ndef greet(name):\n    print(f\"Hello, {name}!\")\n\ngreet(\"Alice\")  # Hello, Alice!\n```\n\n## Return Values\n```python\ndef add(a, b):\n    return a + b\n\nresult = add(3, 5)\nprint(result)  # 8\n```\n\n## Multiple Parameters\n```python\ndef introduce(name, age):\n    return f\"{name} is {age} years old\"\n```", 12);
        $lessonModel->createExercise($l12, 
            "Create a function `square(n)` that returns n squared. Print square(4).", 
            "def square(n):\n    return n ... 2\n\nprint(square(4))", 
            "16");

        // Lesson 13: Functions Advanced
        $l13 = $lessonModel->create($pyId, 'Functions - Advanced', 
            "Advanced function concepts in Python.\n\n## Default Parameters\n```python\ndef greet(name=\"World\"):\n    print(f\"Hello, {name}!\")\n\ngreet()         # Hello, World!\ngreet(\"Alice\")  # Hello, Alice!\n```\n\n## Keyword Arguments\n```python\ndef info(name, age, city):\n    print(f\"{name}, {age}, {city}\")\n\ninfo(age=25, name=\"Bob\", city=\"NYC\")\n```\n\n## *args (Variable Arguments)\n```python\ndef sum_all(*numbers):\n    return sum(numbers)\n\nprint(sum_all(1, 2, 3, 4))  # 10\n```\n\n## Lambda Functions\n```python\nsquare = lambda x: x ** 2\nprint(square(5))  # 25\n```", 13);
        $lessonModel->createExercise($l13, 
            "Create a function `multiply(a, b=2)` with default b=2. Print multiply(5).", 
            "def multiply(a, b=...):\n    return a * b\n\nprint(multiply(5))", 
            "10");

        // Lesson 14: Dictionaries
        $l14 = $lessonModel->create($pyId, 'Dictionaries', 
            "Dictionaries store key-value pairs.\n\n## Creating Dictionaries\n```python\nperson = {\n    \"name\": \"Alice\",\n    \"age\": 25,\n    \"city\": \"NYC\"\n}\n```\n\n## Accessing Values\n```python\nprint(person[\"name\"])        # Alice\nprint(person.get(\"age\"))     # 25\nprint(person.get(\"job\", \"N/A\"))  # N/A (default)\n```\n\n## Modifying\n```python\nperson[\"age\"] = 26           # Update\nperson[\"job\"] = \"Developer\"  # Add new\ndel person[\"city\"]           # Delete\n```\n\n## Iterating\n```python\nfor key in person:\n    print(key, person[key])\n\nfor key, value in person.items():\n    print(f\"{key}: {value}\")\n```", 14);
        $lessonModel->createExercise($l14, 
            "Create a dict `user` with key \"name\" and value \"John\". Print user[\"name\"].", 
            "user = {\"name\": \"...\"}\nprint(user[\"name\"])", 
            "John");

        // Lesson 15: List Comprehensions & Final Project
        $l15 = $lessonModel->create($pyId, 'List Comprehensions', 
            "Create lists in a concise, Pythonic way.\n\n## Basic Comprehension\n```python\n# Traditional way\nsquares = []\nfor i in range(5):\n    squares.append(i ** 2)\n\n# List comprehension\nsquares = [i ** 2 for i in range(5)]\n# [0, 1, 4, 9, 16]\n```\n\n## With Condition\n```python\nevens = [i for i in range(10) if i % 2 == 0]\n# [0, 2, 4, 6, 8]\n```\n\n## Transform Items\n```python\nnames = [\"alice\", \"bob\"]\nupper = [name.upper() for name in names]\n# ['ALICE', 'BOB']\n```\n\n## Dictionary Comprehension\n```python\nsquares = {x: x**2 for x in range(5)}\n# {0: 0, 1: 1, 2: 4, 3: 9, 4: 16}\n```", 15);
        $lessonModel->createExercise($l15, 
            "Create a list of squares from 1 to 4 using list comprehension. Print it.", 
            "squares = [x**2 for x in range(1, ...)]\nprint(squares)", 
            "[1, 4, 9, 16]");

        // ============ JAVASCRIPT COURSE - 10 LESSONS ============
        $jsId = $courseModel->create(
            'JavaScript Essentials',
            'Master the language of the web. Build interactive websites and understand modern JavaScript concepts.',
            'JavaScript',
            'Beginner'
        );

        $j1 = $lessonModel->create($jsId, 'Introduction to JavaScript', 
            "JavaScript is the programming language of the web.\n\n## What is JavaScript?\n- Runs in browsers (and servers with Node.js)\n- Makes websites interactive\n- One of the most popular languages\n\n## Console Output\n```javascript\nconsole.log(\"Hello, World!\");\nconsole.log(42);\nconsole.log(true);\n```\n\n## Comments\n```javascript\n// Single line comment\n/* Multi-line\n   comment */\n```", 1);
        $lessonModel->createExercise($j1, "Print \"Hello, JavaScript!\" to the console.", 
            "console.log(\"...\");", "Hello, JavaScript!");

        $j2 = $lessonModel->create($jsId, 'Variables: let, const, var', 
            "Modern JavaScript uses `let` and `const` for variables.\n\n## const - Constants\n```javascript\nconst PI = 3.14159;\nconst name = \"Alice\";\n// PI = 3; // Error! Can't reassign\n```\n\n## let - Mutable Variables\n```javascript\nlet score = 0;\nscore = 100;  // OK to reassign\n```\n\n## var (Legacy)\n```javascript\nvar oldStyle = \"Avoid using var\";\n```\n\n## Data Types\n```javascript\nlet str = \"text\";     // String\nlet num = 42;         // Number\nlet bool = true;      // Boolean\nlet empty = null;     // Null\nlet undef;            // Undefined\n```", 2);
        $lessonModel->createExercise($j2, "Create a const `language` with value \"JavaScript\" and log it.", 
            "const language = \"...\";\nconsole.log(language);", "JavaScript");

        $j3 = $lessonModel->create($jsId, 'Strings & Template Literals', 
            "JavaScript has powerful string handling.\n\n## String Basics\n```javascript\nlet single = 'Hello';\nlet double = \"World\";\nlet length = \"Test\".length;  // 4\n```\n\n## Template Literals (Backticks)\n```javascript\nlet name = \"Alice\";\nlet age = 25;\nlet message = `${name} is ${age} years old`;\nconsole.log(message);\n```\n\n## String Methods\n```javascript\nlet text = \"JavaScript\";\nconsole.log(text.toUpperCase());  // JAVASCRIPT\nconsole.log(text.toLowerCase());  // javascript\nconsole.log(text.includes(\"Script\"));  // true\nconsole.log(text.slice(0, 4));  // Java\n```", 3);
        $lessonModel->createExercise($j3, "Use template literal to print \"5 + 3 = 8\" using variables.", 
            "let a = 5;\nlet b = 3;\nconsole.log(`${a} + ${b} = ${...}`);", "5 + 3 = 8");

        $j4 = $lessonModel->create($jsId, 'Conditionals', 
            "Control program flow with conditions.\n\n## If Statement\n```javascript\nlet age = 20;\nif (age >= 18) {\n    console.log(\"Adult\");\n}\n```\n\n## If-Else\n```javascript\nlet score = 75;\nif (score >= 90) {\n    console.log(\"A\");\n} else if (score >= 80) {\n    console.log(\"B\");\n} else {\n    console.log(\"C\");\n}\n```\n\n## Ternary Operator\n```javascript\nlet status = age >= 18 ? \"Adult\" : \"Minor\";\n```\n\n## Logical Operators\n```javascript\nif (age >= 18 && hasLicense) { }\nif (isWeekend || isHoliday) { }\nif (!isRaining) { }\n```", 4);
        $lessonModel->createExercise($j4, "Check if num=10 is even (num % 2 === 0). If true, log \"Even\".", 
            "let num = 10;\nif (num % 2 ... 0) {\n    console.log(\"Even\");\n}", "Even");

        $j5 = $lessonModel->create($jsId, 'Arrays', 
            "Arrays store ordered collections of data.\n\n## Creating Arrays\n```javascript\nlet fruits = [\"apple\", \"banana\", \"cherry\"];\nlet numbers = [1, 2, 3, 4, 5];\nlet mixed = [1, \"hello\", true];\n```\n\n## Accessing & Modifying\n```javascript\nconsole.log(fruits[0]);  // apple\nfruits[1] = \"mango\";\nfruits.push(\"orange\");   // Add to end\nfruits.pop();            // Remove last\n```\n\n## Array Methods\n```javascript\nfruits.length;           // 3\nfruits.includes(\"apple\"); // true\nfruits.indexOf(\"banana\"); // 1\nfruits.join(\", \");       // \"apple, banana, cherry\"\n```", 5);
        $lessonModel->createExercise($j5, "Create array `nums` with [10, 20, 30] and log the last element.", 
            "let nums = [10, 20, 30];\nconsole.log(nums[...]);", "30");

        $j6 = $lessonModel->create($jsId, 'Loops', 
            "Repeat code with loops.\n\n## For Loop\n```javascript\nfor (let i = 0; i < 5; i++) {\n    console.log(i);\n}\n```\n\n## For...of (Arrays)\n```javascript\nlet fruits = [\"apple\", \"banana\"];\nfor (let fruit of fruits) {\n    console.log(fruit);\n}\n```\n\n## While Loop\n```javascript\nlet count = 0;\nwhile (count < 3) {\n    console.log(count);\n    count++;\n}\n```\n\n## Array forEach\n```javascript\nfruits.forEach((fruit, index) => {\n    console.log(index, fruit);\n});\n```", 6);
        $lessonModel->createExercise($j6, "Use a for loop to print numbers 0 to 2.", 
            "for (let i = 0; i < ...; i++) {\n    console.log(i);\n}", "0\n1\n2");

        $j7 = $lessonModel->create($jsId, 'Functions', 
            "Functions are reusable code blocks.\n\n## Function Declaration\n```javascript\nfunction greet(name) {\n    return \"Hello, \" + name;\n}\nconsole.log(greet(\"Alice\"));\n```\n\n## Arrow Functions\n```javascript\nconst add = (a, b) => a + b;\nconst square = x => x * x;\nconsole.log(add(2, 3));  // 5\n```\n\n## Default Parameters\n```javascript\nfunction greet(name = \"World\") {\n    return `Hello, ${name}!`;\n}\n```", 7);
        $lessonModel->createExercise($j7, "Create arrow function `double` that returns n*2. Log double(7).", 
            "const double = n => n * ...;\nconsole.log(double(7));", "14");

        $j8 = $lessonModel->create($jsId, 'Objects', 
            "Objects store key-value pairs.\n\n## Creating Objects\n```javascript\nconst person = {\n    name: \"Alice\",\n    age: 25,\n    isStudent: true\n};\n```\n\n## Accessing Properties\n```javascript\nconsole.log(person.name);      // Alice\nconsole.log(person[\"age\"]);    // 25\n```\n\n## Modifying Objects\n```javascript\nperson.age = 26;\nperson.city = \"NYC\";\ndelete person.isStudent;\n```\n\n## Object Methods\n```javascript\nconst user = {\n    name: \"Bob\",\n    greet() {\n        return `Hi, I'm ${this.name}`;\n    }\n};\nconsole.log(user.greet());\n```", 8);
        $lessonModel->createExercise($j8, "Create object `car` with property `brand` = \"Tesla\". Log car.brand.", 
            "const car = { brand: \"...\" };\nconsole.log(car.brand);", "Tesla");

        $j9 = $lessonModel->create($jsId, 'Array Methods', 
            "Powerful methods for array manipulation.\n\n## map - Transform\n```javascript\nconst nums = [1, 2, 3];\nconst doubled = nums.map(n => n * 2);\n// [2, 4, 6]\n```\n\n## filter - Select\n```javascript\nconst evens = nums.filter(n => n % 2 === 0);\n// [2]\n```\n\n## reduce - Accumulate\n```javascript\nconst sum = nums.reduce((acc, n) => acc + n, 0);\n// 6\n```\n\n## find & findIndex\n```javascript\nconst users = [{name: \"A\"}, {name: \"B\"}];\nconst found = users.find(u => u.name === \"B\");\n```", 9);
        $lessonModel->createExercise($j9, "Use map to create squares of [1,2,3]. Log the result.", 
            "const nums = [1, 2, 3];\nconst squares = nums.map(n => n ** ...);\nconsole.log(squares);", "[1, 4, 9]");

        $j10 = $lessonModel->create($jsId, 'Destructuring & Spread', 
            "Modern syntax for working with data.\n\n## Array Destructuring\n```javascript\nconst [first, second] = [1, 2, 3];\nconsole.log(first);  // 1\n```\n\n## Object Destructuring\n```javascript\nconst {name, age} = {name: \"Alice\", age: 25};\nconsole.log(name);  // Alice\n```\n\n## Spread Operator\n```javascript\nconst arr1 = [1, 2];\nconst arr2 = [...arr1, 3, 4];  // [1, 2, 3, 4]\n\nconst obj1 = {a: 1};\nconst obj2 = {...obj1, b: 2};  // {a: 1, b: 2}\n```\n\n## Rest Parameters\n```javascript\nfunction sum(...numbers) {\n    return numbers.reduce((a, b) => a + b, 0);\n}\n```", 10);
        $lessonModel->createExercise($j10, "Use destructuring to get `x` from {x: 10, y: 20}. Log x.", 
            "const {x} = {x: 10, y: 20};\nconsole.log(...);", "10");

        // Seed quiz questions
        $this->seedQuizQuestions($pyId, $jsId);
        
        // Seed code templates
        $this->seedCodeTemplates();
    }

    private function seedQuizQuestions($pythonCourseId, $jsCourseId) {
        $db = (new Database())->connect();
        
        // Python Quiz Questions
        $pythonQuestions = [
            ["How do you print text in Python?", "multiple_choice", '["echo()", "print()", "console.log()", "printf()"]', "1", "In Python, print() is the built-in function to output text to the console."],
            ["Which keyword is used to define a function?", "multiple_choice", '["function", "func", "def", "define"]', "2", "In Python, functions are defined using the 'def' keyword."],
            ["What is the output of: len(\"Python\")?", "multiple_choice", '["5", "6", "7", "Error"]', "1", "len() returns the number of characters in a string. 'Python' has 6 characters."],
            ["Which operator is used for floor division?", "multiple_choice", '["/", "//", "%", "**"]', "1", "The // operator performs floor division, returning the integer part of the division."],
            ["How do you create a list in Python?", "multiple_choice", '["list = (1, 2, 3)", "list = [1, 2, 3]", "list = {1, 2, 3}", "list = <1, 2, 3>"]', "1", "Lists in Python are created using square brackets []."],
            ["What does 'elif' stand for?", "multiple_choice", '["else if", "element if", "elif", "else in"]', "0", "elif is short for 'else if' and is used for multiple conditions."],
            ["Which method adds an item to the end of a list?", "multiple_choice", '["add()", "append()", "insert()", "push()"]', "1", "append() adds a single element to the end of a list."],
            ["What is a dictionary in Python?", "multiple_choice", '["An ordered list", "A key-value pair collection", "A set of unique items", "A tuple"]', "1", "Dictionaries store data as key-value pairs using curly braces {}."],
            ["How do you start a for loop?", "multiple_choice", '["for i in range(5):", "for (i = 0; i < 5; i++)", "foreach i in range(5)", "loop i from 0 to 5"]', "0", "Python for loops use the syntax: for variable in iterable:"],
            ["What is the output of: 10 % 3?", "multiple_choice", '["3", "1", "3.33", "0"]', "1", "The modulo operator % returns the remainder. 10 divided by 3 has remainder 1."]
        ];

        foreach ($pythonQuestions as $q) {
            $stmt = $db->prepare("INSERT INTO quiz_questions (course_id, question, question_type, options, correct_answer, explanation) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$pythonCourseId, $q[0], $q[1], $q[2], $q[3], $q[4]]);
        }

        // JavaScript Quiz Questions
        $jsQuestions = [
            ["How do you declare a constant in JavaScript?", "multiple_choice", '["var x = 5", "let x = 5", "const x = 5", "constant x = 5"]', "2", "const is used for values that should not be reassigned."],
            ["Which method outputs to the browser console?", "multiple_choice", '["print()", "console.log()", "document.write()", "alert()"]', "1", "console.log() outputs messages to the browser's developer console."],
            ["What is the result of: typeof []?", "multiple_choice", '["array", "object", "list", "undefined"]', "1", "In JavaScript, arrays are technically objects, so typeof returns 'object'."],
            ["How do you write an arrow function?", "multiple_choice", '["function => {}", "() => {}", "=> function()", "arrow() {}"]', "1", "Arrow functions use the syntax: (params) => { body } or param => expression"],
            ["Which loop is best for iterating over array elements?", "multiple_choice", '["for...in", "for...of", "while", "do...while"]', "1", "for...of is designed to iterate over iterable objects like arrays."],
            ["What does '===' check?", "multiple_choice", '["Value only", "Type only", "Value and type", "Reference"]', "2", "=== is the strict equality operator that checks both value and type."],
            ["How do you access object property 'name'?", "multiple_choice", '["obj->name", "obj.name", "obj:name", "obj[name]"]', "1", "Dot notation (obj.name) or bracket notation (obj['name']) can be used."],
            ["What method removes the last array element?", "multiple_choice", '["shift()", "pop()", "splice()", "remove()"]', "1", "pop() removes and returns the last element of an array."],
            ["What is template literal syntax?", "multiple_choice", '["'text'", "\"text\"", "`text`", "(text)"]', "2", "Template literals use backticks (`) and allow embedded expressions with ${}."],
            ["What does the spread operator (...) do?", "multiple_choice", '["Multiplies values", "Expands iterables", "Creates loops", "Defines functions"]', "1", "The spread operator (...) expands an iterable into individual elements."]
        ];

        foreach ($jsQuestions as $q) {
            $stmt = $db->prepare("INSERT INTO quiz_questions (course_id, question, question_type, options, correct_answer, explanation) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$jsCourseId, $q[0], $q[1], $q[2], $q[3], $q[4]]);
        }
    }

    private function seedCodeTemplates() {
        $db = (new Database())->connect();
        
        $templates = [
            ['Python Hello World', 'python', '# Python Hello World\nprint("Hello, World!")\n\n# Try modifying the message!', 1],
            ['Python Variables', 'python', "# Variables in Python\nname = \"Your Name\"\nage = 25\nheight = 5.9\nis_student = True\n\nprint(f\"Name: {name}\")\nprint(f\"Age: {age}\")\nprint(f\"Height: {height}\")\nprint(f\"Student: {is_student}\")", 1],
            ['Python List Operations', 'python', "# List Operations\nfruits = [\"apple\", \"banana\", \"cherry\"]\n\n# Add item\nfruits.append(\"orange\")\n\n# Loop through\nfor fruit in fruits:\n    print(fruit)\n\n# List comprehension\nupper_fruits = [f.upper() for f in fruits]\nprint(upper_fruits)", 1],
            ['JavaScript Hello World', 'javascript', '// JavaScript Hello World\nconsole.log("Hello, World!");\n\n// Try modifying the message!', 1],
            ['JavaScript Variables', 'javascript', "// Variables in JavaScript\nconst name = \"Your Name\";\nlet age = 25;\nconst isStudent = true;\n\nconsole.log(`Name: \${name}`);\nconsole.log(`Age: \${age}`);\nconsole.log(`Student: \${isStudent}`);", 1],
            ['JavaScript Array Methods', 'javascript', "// Array Methods\nconst numbers = [1, 2, 3, 4, 5];\n\n// Map - transform\nconst doubled = numbers.map(n => n * 2);\nconsole.log('Doubled:', doubled);\n\n// Filter - select\nconst evens = numbers.filter(n => n % 2 === 0);\nconsole.log('Evens:', evens);\n\n// Reduce - accumulate\nconst sum = numbers.reduce((acc, n) => acc + n, 0);\nconsole.log('Sum:', sum);", 1],
        ];

        foreach ($templates as $t) {
            $stmt = $db->prepare("INSERT INTO saved_snippets (title, language, code, is_template) VALUES (?, ?, ?, ?)");
            $stmt->execute($t);
        }
    }
}
