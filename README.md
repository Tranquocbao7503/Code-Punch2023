#Code and Punch Event - EHC Ethical Hacker Club

Introduction
This project is a web-based class management system that supports two main roles: teacher and student. It allows teachers to manage student information, as well as their own, while students can only manage their own information. The system also provides features for viewing user lists, sending messages, submitting and retrieving assignments, and organizing puzzle challenges.

Features
User Roles: The system supports two roles: teacher and student. Each role has basic fields such as username, password, full name, email, and phone number.
User Management
Teacher Management: Teachers can add, edit, and delete student information, as well as manage their own information.
Student Management: Students can add and edit their own information, except for the username and full name fields.
View User List: All users, regardless of their role, can view the list of users on the website and access detailed information about any user.
Messaging
User Messaging: Users can leave messages for other users on their profile pages. Messages can be edited or deleted after being sent.
Assignment Submission and Retrieval
Assignment Management: Teachers can upload assignment files. Students can view the list of assignments and download the corresponding files.
Assignment Submission: Students can upload their solutions for the assigned tasks. Only teachers can view the list of submitted assignments.
Puzzle Challenge
Challenge Creation: Teachers can create puzzle challenges. To create a challenge, teachers need to upload a text file (e.g., a poem or prose) with its content. The file name should be written in lowercase without accents, and words should be separated by a space. Teachers also provide hints about the book associated with the challenge and submit it. (The answer is the file name that the teacher uploaded. The system does not store the answer in a file or a database.)
Answer Submission: Students can view the hints and enter their answers. When a student enters the correct answer, the system displays the content of the poem or prose from the answer file.
Technologies Used
Frontend: HTML, CSS, JavaScript
Backend: Node.js, Express.js
Database: MongoDB
Installation
Clone the repository: git clone https://github.com/your-repo.git
Navigate to the project directory: cd your-repo
Install dependencies: npm install
Set up the MongoDB database connection in the configuration file.
Start the server: npm start
Open your browser and visit http://localhost:3000 to access the application.
##Conclusion
This class management system provides a user-friendly interface for teachers and students to manage their information, communicate, submit and retrieve assignments, and participate in puzzle challenges. It enhances the learning experience and facilitates efficient organization within the educational environment.

Note: This is a fictional project description created for demonstration purposes.
