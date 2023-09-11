-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 31 Μάη 2022 στις 01:54:25
-- Έκδοση διακομιστή: 10.4.19-MariaDB
-- Έκδοση PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `pegasus`
--

DELIMITER $$
--
-- Συναρτήσεις
--
CREATE DEFINER=`root`@`localhost` FUNCTION `courseID` () RETURNS VARCHAR(20) CHARSET utf8mb4 BEGIN 
DECLARE courseid VARCHAR(20);
SELECT
CASE
WHEN MAX(course_id) IS NULL THEN 'course001'
WHEN MAX(course_id) IS NOT NULL 
THEN concat('course', lpad(cast((cast(substr(MAX(course_id),8) AS unsigned) + 1) AS CHAR),'3','0'))
END
INTO courseid
FROM courses;
RETURN(courseid);
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `gradeID` () RETURNS VARCHAR(20) CHARSET utf8mb4 BEGIN 
DECLARE gradeid VARCHAR(20);
SELECT
CASE
WHEN MAX(grade_id) IS NULL THEN 'grade001'
WHEN MAX(grade_id) IS NOT NULL 
THEN concat('grade', lpad(cast((cast(substr(MAX(grade_id),7) AS unsigned) + 1) AS CHAR),'3','0'))
END
INTO gradeid
FROM grades;
RETURN(gradeid);
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `profID` () RETURNS VARCHAR(20) CHARSET utf8mb4 BEGIN 
DECLARE profid VARCHAR(20);
SELECT
CASE
WHEN MAX(professor_id) IS NULL THEN 'prof001'
WHEN MAX(professor_id) IS NOT NULL 
THEN concat('prof', lpad(cast((cast(substr(MAX(professor_id),6) AS unsigned) + 1) AS CHAR),'3','0'))
END
INTO profid
FROM professors;
RETURN(profid);
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `stateID` () RETURNS VARCHAR(20) CHARSET utf8mb4 BEGIN 
DECLARE stateid VARCHAR(20);
SELECT
CASE
WHEN MAX(statement_id) IS NULL THEN 'state001'
WHEN MAX(statement_id) IS NOT NULL 
THEN concat('state', lpad(cast((cast(substr(MAX(statement_id),7) AS unsigned) + 1) AS CHAR),'3','0'))
END
INTO stateid
FROM course_statements;
RETURN(stateid);
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `studentID` () RETURNS VARCHAR(20) CHARSET utf8mb4 BEGIN 
DECLARE studid VARCHAR(20);
SELECT
CASE
WHEN MAX(student_id) IS NULL THEN 'stud001'
WHEN MAX(student_id) IS NOT NULL 
THEN concat('stud', lpad(cast((cast(substr(MAX(student_id),6) AS unsigned) + 1) AS CHAR),'3','0'))
END
INTO studid
FROM students;
RETURN(studid);
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `studentreqID` () RETURNS VARCHAR(20) CHARSET utf8mb4 BEGIN 
DECLARE reqid VARCHAR(20);
SELECT
CASE
WHEN MAX(student_request_id) IS NULL THEN 'req001'
WHEN MAX(student_request_id) IS NOT NULL 
THEN concat('req', lpad(cast((cast(substr(MAX(student_request_id),5) AS unsigned) + 1) AS CHAR),'3','0'))
END
INTO reqid
FROM student_registration_requests;
RETURN(reqid);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `administrators`
--

CREATE TABLE `administrators` (
  `administrator_id` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role_id` smallint(5) UNSIGNED NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `administrators`
--

INSERT INTO `administrators` (`administrator_id`, `password`, `role_id`, `first_name`, `last_name`, `email`) VALUES
('admin1', 'admin', 3, 'Isidoros', 'Papadopoulos', 'isidoros@aegean.gr'),
('admin2', 'admin', 3, 'Spyridon', 'Papatheodorou', 'spyridon@aegean.gr');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(45) NOT NULL,
  `professor_id` varchar(45) NOT NULL,
  `title` varchar(128) NOT NULL,
  `semester` smallint(5) UNSIGNED NOT NULL,
  `theory_grade_percentage` float NOT NULL,
  `ifThGrStays` int(11) NOT NULL DEFAULT 0,
  `labratory_grade_percentage` float NOT NULL,
  `ifLbGrStays` int(11) NOT NULL DEFAULT 0,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `courses`
--

INSERT INTO `courses` (`course_id`, `professor_id`, `title`, `semester`, `theory_grade_percentage`, `ifThGrStays`, `labratory_grade_percentage`, `ifLbGrStays`, `description`) VALUES
('course001', 'prof003', 'τεστ', 3, 0.2, 0, 0.3, 0, 'τεστ τεστ'),
('course002', 'prof004', 'Αντικειμενοστραφής Προγραμματισμός 1', 2, 0.6, 0, 0.4, 0, 'In this course you are going to learn about the Objective Programming using C++.\r\nIn order to take this course you must have passed the course with title \"Structured Programming\".'),
('course003', 'prof002', 'Αντικειμενοστραφής Προγραμματισμός 2', 3, 0.6, 0, 0.4, 0, 'In this course you are going to learn about the Objective Programming II using Java.\r\nIn order to take this course you must have passed the course with title \"Objective Programming I\".'),
('course004', 'prof003', 'Διακριτά Μαθηματικά 1', 1, 1, 0, 0, 0, 'Propositional calculus, quantitative indicators, evidentiary procedures and elementary number theory.'),
('course005', 'prof005', 'Θεωρία Κυκλωμάτων', 2, 0.5, 0, 0.5, 0, 'Basic principles of electrical circuits - levels of operation removal, analysis techniques\r\nof circuits with resistors, equivalent circuits and transformations, digital logic.'),
('course006', 'prof006', 'Τεχνολογίες Νέφους', 8, 1, 0, 0, 0, 'Cloud technologies, types of services (NaaS, IaaS), development models (private, public,\r\nhybrid), tools (openflow), virtualization of network services and functions (SDN,\r\nNFV),advanced network and b'),
('course007', 'prof007', 'Πρωτόκολλα Διαδικτύου και Αρχιτεκτονικές', 8, 0.6, 0, 0.4, 0, 'The client-server model and peer-to-peer networks, Initialization protocols: DHCP, BOOTP,\r\nThe DNS naming system, Internet Service Quality Protocols\r\n(RSVP, DiffServ), Virtual Private Networks, Portab'),
('course008', 'prof008', 'Σήματα και Συστήματα', 3, 0.7, 0, 0.3, 0, 'Basic definitions of signals and systems, periodic signals, unit step function, percussion function. System categories, static and dynamic systems, causal and non-causal systems, linear and non-linear'),
('course009', 'prof009', 'Προγραμματισμός στο Διαδίκτυο', 6, 0.5, 0, 0.5, 0, '          '),
('course010', 'prof010', 'Προηγμένα Θέματα Γλωσσών Προγραμματισμού', 4, 0.5, 0, 0.5, 0, 'Categories of programming languages. Variables, representations and commands. Types\r\ndata and definition systems. Memory range and commitment time. Procedures. Handling exceptions. Simultaneity. Objec'),
('course011', 'prof004', 'Διακριτά Μαθηματικά 2', 2, 1, 0, 0, 0, 'Sequences: retrospective definition, monotony, convergence. Sums and series. Solution\r\nlinear retrograde equations. Power series. Generator functions. Graphs: basic terminology, isomorphism, Euler and'),
('course100', 'prof003', 'test', 1, 0.7, 1, 0.3, 1, 'test');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `course_requirements`
--

CREATE TABLE `course_requirements` (
  `ifFinalised` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `course_id_main` varchar(45) NOT NULL,
  `course_id_chain` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `course_requirements`
--

INSERT INTO `course_requirements` (`ifFinalised`, `course_id_main`, `course_id_chain`) VALUES
(1, 'course011', 'course004'),
(1, 'course002', 'course001'),
(1, 'course010', 'course003'),
(1, 'course010', 'course002');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `course_statements`
--

CREATE TABLE `course_statements` (
  `statement_id` varchar(45) NOT NULL,
  `statement_semester` smallint(5) UNSIGNED NOT NULL,
  `ifFinalized` smallint(5) UNSIGNED DEFAULT NULL,
  `student_id` varchar(45) NOT NULL,
  `course_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `course_statements`
--

INSERT INTO `course_statements` (`statement_id`, `statement_semester`, `ifFinalized`, `student_id`, `course_id`) VALUES
('state0000001', 1, 1, 'stud001', 'course011'),
('state001', 1, 1, 'stud001', 'course002'),
('state011', 5, 1, 'stud002', 'course001'),
('state012', 5, 1, 'stud002', 'course002'),
('state013', 5, 1, 'stud002', 'course003'),
('state014', 5, 1, 'stud002', 'course004'),
('state015', 5, 1, 'stud002', 'course010'),
('state016', 5, 1, 'stud002', 'course011'),
('state017', 5, 0, 'stud002', 'course007'),
('state018', 5, 0, 'stud002', 'course008'),
('state019', 1, 1, 'stud001', 'course002'),
('state020', 1, 1, 'stud001', 'course011'),
('state021', 1, 1, 'stud001', 'course002'),
('state022', 1, 1, 'stud001', 'course002'),
('state023', 1, 1, 'stud001', 'course011'),
('state024', 1, 1, 'stud001', 'course002'),
('state025', 1, 1, 'stud001', 'course011'),
('state026', 1, 1, 'stud001', 'course002'),
('state027', 1, 1, 'stud001', 'course011'),
('state028', 1, 1, 'stud001', 'course011'),
('state029', 1, 1, 'stud001', 'course002');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `grades`
--

CREATE TABLE `grades` (
  `grade_id` varchar(40) NOT NULL,
  `final_grade` float NOT NULL,
  `theory_grade` float NOT NULL,
  `labratory_grade` float NOT NULL,
  `course_id` varchar(45) NOT NULL,
  `student_id` varchar(45) NOT NULL,
  `ifStays` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `ifFinalized` smallint(5) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `grades`
--

INSERT INTO `grades` (`grade_id`, `final_grade`, `theory_grade`, `labratory_grade`, `course_id`, `student_id`, `ifStays`, `ifFinalized`) VALUES
('grade001', 10, 5, 5, 'course005', 'stud007', 1, 1),
('grade002', 5, 5, 5, 'course002', 'stud005', 1, 1),
('grade004', 6, 6, 6, 'course005', 'stud007', 1, 1),
('grade005', 8, 8, 8, 'course010', 'stud007', 0, 1),
('grade007', 7, 7, 0, 'course006', 'stud008', 1, 1),
('grade008', 10, 6, 4, 'course007', 'stud006', 1, 1),
('grade009', 5, 5, 5, 'course009', 'stud006', 1, 1),
('grade010', 8, 8, 0, 'course011', 'stud007', 1, 1),
('grade012', 10, 5, 1, 'course001', 'stud001', 1, 1),
('grade014', 0, 1, 2, 'course001', 'stud001', 0, 0),
('grade015', 0, 2, 2, 'course001', 'stud002', 0, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `passed_courses`
--

CREATE TABLE `passed_courses` (
  `course_id` varchar(45) NOT NULL,
  `student_id` varchar(45) NOT NULL,
  `semester_passed` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `passed_courses`
--

INSERT INTO `passed_courses` (`course_id`, `student_id`, `semester_passed`) VALUES
('course004', 'stud001', 1),
('course001', 'stud005', 1),
('course002', 'stud005', 2),
('course005', 'stud007', 5),
('course010', 'stud007', 6),
('course006', 'stud008', 3),
('course001', 'stud008', 2),
('course004', 'stud008', 1),
('course007', 'stud006', 8),
('course002', 'stud006', 2),
('course005', 'stud006', 3),
('course010', 'stud006', 6),
('course006', 'stud007', 2),
('course009', 'stud007', 7),
('course011', 'stud007', 4),
('course001', 'stud001', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `professors`
--

CREATE TABLE `professors` (
  `professor_id` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role_id` smallint(5) UNSIGNED NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `vathmida` varchar(255) DEFAULT 'Teacher'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `professors`
--

INSERT INTO `professors` (`professor_id`, `password`, `role_id`, `first_name`, `last_name`, `email`, `vathmida`) VALUES
('prof002', 'prof', 2, 'Stylianos', 'Arvanitis', 'sarvanitis@hotmail.com', 'Teacher'),
('prof003', 'prof', 2, 'Asimakis', 'Leros', 'aleros@aegean.gr', 'Teacher'),
('prof004', 'prof', 2, 'Ergina', 'Kavalieratou', 'kavalieratou@aegean.gr', 'Teacher'),
('prof005', 'prof', 2, 'Charis', 'Mesaritakis', 'cmesar@aegean.gr', 'Teacher'),
('prof006', 'prof', 2, 'Kyriakos', 'Kritikos', 'kkritikos@aegean.gr', 'Teacher'),
('prof007', 'prof', 2, 'Dimitris', 'Skoutas', 'd.skoutas@aegean.gr', 'Teacher'),
('prof008', 'prof', 2, 'Eirini', 'Karympali', 'karybali@aegean.gr', 'Teacher'),
('prof009', 'prof', 2, 'Panagiotis', 'Symeonidis', 'psymeonidis@aegean.gr', 'Teacher'),
('prof010', 'prof', 2, 'Georgios', 'Chrysoloras', 'george@aegean.gr', 'Teacher');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `roles`
--

CREATE TABLE `roles` (
  `role_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `roles`
--

INSERT INTO `roles` (`role_id`, `description`) VALUES
(0, 'Guest'),
(1, 'Student'),
(2, 'Professor'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `students`
--

CREATE TABLE `students` (
  `student_id` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role_id` smallint(5) UNSIGNED NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `students`
--

INSERT INTO `students` (`student_id`, `password`, `role_id`, `first_name`, `last_name`, `email`) VALUES
('stud001', 'stud', 1, ' Vasiliki ', 'giwrgos', ' vasiliki@gmail.com'),
('stud002', 'stud', 1, 'Isidoros', 'Papadopoulos', 'isidoros@gmail.com'),
('stud003', 'stud', 1, 'Spiros', 'Gkatzias', 'sgkatzias@gmail.com'),
('stud004', 'stud', 1, 'Charis', 'Alexiou', 'chalexiou@gmail.com'),
('stud005', 'stud', 1, 'Giwrgos', 'Gewrgiou', 'ggewrgiou@gmail.com'),
('stud006', 'stud', 1, 'Maria', 'Angelou', 'mangelou@gmail.com'),
('stud007', 'stud', 1, 'Eirini', 'Papavasileiou', 'eirinipap@gmail.com'),
('stud008', 'stud', 1, 'Eleni', 'Makri', 'elenima@gmail.com'),
('stud009', 'stud', 1, 'Manos', 'Manousos', 'mmanousos@gmail.com'),
('stud010', 'stud', 1, 'Michalis', 'Minadakis', 'mminadakis@gmail.com');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `student_courses`
--

CREATE TABLE `student_courses` (
  `course_id` varchar(45) NOT NULL,
  `student_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `student_courses`
--

INSERT INTO `student_courses` (`course_id`, `student_id`) VALUES
('course001', 'stud001'),
('course002', 'stud001'),
('course003', 'stud001'),
('course005', 'stud001'),
('course006', 'stud001'),
('course007', 'stud001'),
('course001', 'stud002'),
('course002', 'stud002'),
('course003', 'stud002'),
('course004', 'stud002'),
('course011', 'stud002'),
('course010', 'stud002'),
('course009', 'stud001'),
('course009', 'stud002'),
('course009', 'stud003');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `student_registration_requests`
--

CREATE TABLE `student_registration_requests` (
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `password` varchar(25) NOT NULL,
  `contact_email` varchar(40) NOT NULL,
  `student_request_id` int(11) NOT NULL,
  `role_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `student_registration_requests`
--

INSERT INTO `student_registration_requests` (`first_name`, `last_name`, `password`, `contact_email`, `student_request_id`, `role_id`) VALUES
('Stylianos', 'Arvaniths', 'admin', 'admin@admin', 5, 1);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`administrator_id`),
  ADD UNIQUE KEY `administrator_id` (`administrator_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Ευρετήρια για πίνακα `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_id` (`course_id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Ευρετήρια για πίνακα `course_requirements`
--
ALTER TABLE `course_requirements`
  ADD KEY `course_id_main` (`course_id_main`),
  ADD KEY `course_id_chain` (`course_id_chain`);

--
-- Ευρετήρια για πίνακα `course_statements`
--
ALTER TABLE `course_statements`
  ADD PRIMARY KEY (`statement_id`),
  ADD UNIQUE KEY `statement_id` (`statement_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Ευρετήρια για πίνακα `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD UNIQUE KEY `grade_id` (`grade_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Ευρετήρια για πίνακα `passed_courses`
--
ALTER TABLE `passed_courses`
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Ευρετήρια για πίνακα `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`professor_id`),
  ADD UNIQUE KEY `professor_id` (`professor_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Ευρετήρια για πίνακα `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Ευρετήρια για πίνακα `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Ευρετήρια για πίνακα `student_courses`
--
ALTER TABLE `student_courses`
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Ευρετήρια για πίνακα `student_registration_requests`
--
ALTER TABLE `student_registration_requests`
  ADD PRIMARY KEY (`student_request_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `student_registration_requests`
--
ALTER TABLE `student_registration_requests`
  MODIFY `student_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `administrators`
--
ALTER TABLE `administrators`
  ADD CONSTRAINT `administrators_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Περιορισμοί για πίνακα `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`professor_id`),
  ADD CONSTRAINT `professor_id` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`professor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `course_requirements`
--
ALTER TABLE `course_requirements`
  ADD CONSTRAINT `course_id_chain` FOREIGN KEY (`course_id_chain`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_id_main` FOREIGN KEY (`course_id_main`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_requirements_ibfk_1` FOREIGN KEY (`course_id_main`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `course_requirements_ibfk_2` FOREIGN KEY (`course_id_chain`) REFERENCES `courses` (`course_id`);

--
-- Περιορισμοί για πίνακα `course_statements`
--
ALTER TABLE `course_statements`
  ADD CONSTRAINT `course_statements_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `course_statements_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Περιορισμοί για πίνακα `passed_courses`
--
ALTER TABLE `passed_courses`
  ADD CONSTRAINT `passed_courses_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `passed_courses_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Περιορισμοί για πίνακα `professors`
--
ALTER TABLE `professors`
  ADD CONSTRAINT `professors_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Περιορισμοί για πίνακα `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Περιορισμοί για πίνακα `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `student_courses_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Περιορισμοί για πίνακα `student_registration_requests`
--
ALTER TABLE `student_registration_requests`
  ADD CONSTRAINT `student_registration_requests_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
