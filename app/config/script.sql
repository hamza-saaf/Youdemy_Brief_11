-- Create the database
CREATE DATABSE youdemy_db;
USE youdemy_db;
-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'teacher', 'student') NOT NULL,
    `status` ENUM('Activation', 'suspension', 'suppression') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- Create the categories table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- Create the courses table
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    `image` VARCHAR(255),
    `description` VARCHAR(255) NOT NULL,
    content TEXT,
    `video` varchar(255) NOT NULL,
    teacher_id INT NOT NULL,
    category_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);
CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE course_tag (
    course_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (course_id, tag_id),
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

INSERT INTO users (username, email, `password`, `role`, `status`) VALUES
('admin_user', 'admin@example.com', 'hashed_password_1', 'admin', 'Activation'),
('teacher_john', 'john.teacher@example.com', 'hashed_password_2', 'teacher', 'Activation'),
('teacher_mary', 'mary.teacher@example.com', 'hashed_password_3', 'teacher', 'Activation'),
('student_ali', 'ali.student@example.com', 'hashed_password_4', 'student', 'Activation'),
('student_lina', 'lina.student@example.com', 'hashed_password_5', 'student', 'suspension'),
('student_omar', 'omar.student@example.com', 'hashed_password_6', 'student', 'Activation');
INSERT INTO categories (`name`) VALUES
('Web Development'),
('Mobile Development'),
('Data Science'),
('Machine Learning'),
('Design'),
('Marketing'),
('Business'),
('Finance'),
('Languages'),
('Photography');
INSERT INTO tags (`name`) VALUES
('HTML'),
('CSS'),
('JavaScript'),
('Python'),
('React'),
('SQL'),
('Machine Learning'),
('Photoshop'),
('Marketing Strategy'),
('Finance Basics');
INSERT INTO courses (title, `image`, `description`, content, `video`, teacher_id, category_id) VALUES
('HTML for Beginners', 'https://via.placeholder.com/150', 'Learn the basics of HTML.', 'Detailed course content...', 'https://www.youtube.com/embed/dD2EISBDjWM', 2, 1),
('CSS Fundamentals', 'https://via.placeholder.com/150', 'Master the art of CSS.', 'Detailed course content...', 'https://www.youtube.com/embed/1Rs2ND1ryYc', 2, 1),
('JavaScript Essentials', 'https://via.placeholder.com/150', 'Understand JavaScript step by step.', 'Detailed course content...', 'https://www.youtube.com/embed/hdI2bqOjy3c', 2, 1),
('Python for Data Science', 'https://via.placeholder.com/150', 'Analyze data with Python.', 'Detailed course content...', 'https://www.youtube.com/embed/rfscVS0vtbw', 2, 3),
('Machine Learning Basics', 'https://via.placeholder.com/150', 'Introduction to machine learning.', 'Detailed course content...', 'https://www.youtube.com/embed/GwIo3gDZCVQ', 3, 4),
('Intro to React', 'https://via.placeholder.com/150', 'Get started with React.', 'Detailed course content...', 'https://www.youtube.com/embed/w7ejDZ8SWv8', 2, 1),
('Photoshop for Beginners', 'https://via.placeholder.com/150', 'Create stunning designs.', 'Detailed course content...', 'https://www.youtube.com/embed/OlpH66M-0cc', 3, 5),
('Marketing 101', 'https://via.placeholder.com/150', 'Understand marketing strategies.', 'Detailed course content...', 'https://www.youtube.com/embed/z0y5L9Eop4g', 3, 6),
('Finance Basics', 'https://via.placeholder.com/150', 'Learn basic finance principles.', 'Detailed course content...', 'https://www.youtube.com/embed/pqN1Tx_hGxs', 3, 8),
('Mobile Development with Flutter', 'https://via.placeholder.com/150', 'Create mobile apps.', 'Detailed course content...', 'https://www.youtube.com/embed/x0uinJvhNxI', 2, 2),
('SQL for Data Analysis', 'https://via.placeholder.com/150', 'Query data effectively.', 'Detailed course content...', 'https://www.youtube.com/embed/7S_tz1z_5bA', 2, 3),
('Advanced Python', 'https://via.placeholder.com/150', 'Learn advanced Python techniques.', 'Detailed course content...', 'https://www.youtube.com/embed/gfDE2a7MKjA', 2, 3),
('Mastering JavaScript', 'https://via.placeholder.com/150', 'Dive deep into JavaScript.', 'Detailed course content...', 'https://www.youtube.com/embed/PkZNo7MFNFg', 2, 1),
('Intro to Photography', 'https://via.placeholder.com/150', 'Learn photography basics.', 'Detailed course content...', 'https://www.youtube.com/embed/yU7jJ3NbPdA', 3, 10),
('Language Learning Techniques', 'https://via.placeholder.com/150', 'Effective language learning.', 'Detailed course content...', 'https://www.youtube.com/embed/LcCVd3HB9XY', 3, 9),
('Business Strategy', 'https://via.placeholder.com/150', 'Develop a business strategy.', 'Detailed course content...', 'https://www.youtube.com/embed/B-2eEbMDtmI', 3, 7);
INSERT INTO course_tag (course_id, tag_id) VALUES
(1, 1), (1, 2), 
(2, 2), (3, 3), 
(4, 4), (4, 6), 
(5, 7), (6, 5), 
(7, 8), (8, 9), 
(9, 10), (10, 5), 
(11, 6), (12, 4), 
(13, 3), (14, 10), 
(15, 10), (16, 9);
INSERT INTO enrollments (student_id, course_id) VALUES
(4, 1), (4, 2), (4, 3), 
(5, 4), (5, 5), (5, 6), 
(6, 7), (6, 8), (6, 9), 
(4, 10), (5, 11), (6, 12);



-- Insert roles into the users table for testing purposes
-- INSERT INTO users (username, email, password, role) VALUES
-- ('Hamza_Saaf', 'hamzasaaf725@gmail.com', '1234', 'admin'),
-- ('Samir', 'samir500@gmail.com', '1234', 'teacher'),
-- ('Karim', 'karim2000@gmial.com', '1234', 'student');

-- ALTER TABLE users 
-- MODIFY COLUMN `status` ENUM('Activation', 'suspension', 'suppression') NOT NULL;
-- ALTER TABLE courses 
-- Add `video` varchar(255) ;
-- ALTER TABLE courses 
-- MODIFY COLUMN `video` varchar(255) NOT NULL ;