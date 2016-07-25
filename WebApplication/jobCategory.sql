SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
 
--
-- Database: `fuzzyahp`
--
 
-- --------------------------------------------------------
 
--
-- Table structure for table `job_cat`
--
 
CREATE TABLE IF NOT EXISTS `job_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;
 
--
-- Dumping data for table `job_cat`
--
 
INSERT INTO `job_cat` (`name`) VALUES
('Academic Jobs Australia'),
('Academic Jobs Europe'),
('Accountancy'),
('Administrative Assistant Jobs'),
('Administrative Officer Jobs'),
('Admissions Officer Jobs'),
('Aeronautical Engineering'),
('Africa'),
('Agriculture and Food'),
('America'),
('Anatomy'),
('Anthropology'),
('Applied Social Work'),
('Architecture, Building and Planning'),
('Asia'),
('Assistant Professor Jobs'),
('Astronomy'),
('Australasia'),
('Biochemistry'),
('Bioinformatician Jobs'),
('Biology'),
('Biomedical Scientist Jobs'),
('Biophysics'),
('Biotechnology'),
('Botany'),
('Building'),
('Business and Administration'),
('Business Development Manager Jobs'),
('Careers Advisor Jobs'),
('Catering'),
('Chemical Engineering'),
('Chemistry'),
('Civil Engineering'),
('Classics'),
('Clinical Research Associate Jobs'),
('Clinical Trial Jobs'),
('Communication Studies'),
('Computer Science'),
('Computing'),
('Country Planning'),
('Creative Arts and Design'),
('Design'),
('Drama'),
('Economics'),
( 'Economist'),
(     'Education'),
(     'Education Studies'),
(     'Electrical Engineering'),
(     'Engineer'),
(     'Engineering and Technology'),
(     'Europe'),
(     'Faculty Jobs'),
(     'Fine Art'),
(     'Forestry'),
(     'Further Education'),
(     'General Research'),
(     'General Social Sciences'),
(     'Genetics'),
(     'Geography'),
(     'Geology'),
(     'Government'),
(     'Graduate'),
(     'Hardware'),
(     'Health and Medical'),
(     'History'),
(     'History of Art'),
(     'Hotel'),
(     'HR'),
(     'Human Geography'),
(     'Human Resources'),
(     'Humanities'),
(     'Information Management'),
(     'Information Science'),
(     'International Office Jobs'),
(     'Internet'),
(     'Jobs in UAE'),
(     'Journalism'),
(     'KTP Associate Jobs'),
(     'Laboratory Technician Jobs'),
(     'Land Management'),
(     'Languages'),
(     'Law'),
(     'Lecturer Jobs'),
(     'Leisure'),
(     'Leisure Management'),
(     'Librarianship'),
(     'Librarianship'),
(     'Library Assistant Jobs'),
(     'Linguistics'),
(     'Literature'),
(     'London Jobs'),
(     'Management'),
(     'Maritime Technology'),
(     'Marketing'),
(     'Materials Science'),
(     'Mathematics'),
(     'Mechanical Engineering'),
(     'Media and Communications'),
(     'Medical Technician Jobs'),
(     'Medical Technology'),
(     'Medicine'),
(     'Microbiology'),
(     'Midlands'),
(     'Minerals Technology'),
(     'Modern Languages'),
(     'Molecular Biology'),
(     'Music'),
(     'Northern England'),
(     'Northern Ireland'),
(     'Nursing'),
(     'Nutrition'),
(     'Oceanography'),
(     'Personnel'),
(     'Pharmacology'),
(     'Pharmacy'),
(     'PhD Bursary Jobs'),
(     'PhD Jobs'),
(     'PhD Research Studentship Jobs'),
(     'PhD Scholarships'),
(     'PhD Studentships'),
(     'Philosophy'),
(     'Physical Sciences'),
(     'Physics'),
(     'Physiology'),
(     'Politics and Government'),
(     'Postdoc'),
(     'Postdoctoral Research Assistant Jobs'),
(     'Postdoctoral Research Associate Jobs'),
(     'Postdoctoral Research Fellow Jobs'),
(     'Postdoctoral Researcher Jobs'),
(     'Postdoctoral Scientist Jobs'),
(     'Production Engineering'),
(     'Professor Jobs'),
(     'Programme Administrator Jobs'),
(     'Programme Manager Jobs'),
(     'Programming'),
(     'Project Manager Jobs'),
(     'Project Officer Jobs'),
(     'Property Management'),
(     'Psychology'),
(     'Public Sector'),
(     'Publishing'),
(     'Religion'),
(     'Republic of Ireland'),
(     'Research Administrator Jobs'),
(     'Research Assistant Jobs'),
(     'Research Associate Jobs'),
(     'Research Fellow'),
(     'Research Manager Jobs'),
(     'Research Nurse Jobs'),
(     'Research Officer Jobs'),
(     'Research Scientist Jobs'),
(     'Research Technician Jobs'),
(     'Researcher Jobs'),
(     'Science'),
(     'Science Technician Jobs'),
(     'Scientific'),
(     'Scotland'),
(     'Senior Academic Jobs'),
(     'Senior Lecturer Jobs'),
(     'Senior Research Assistant Jobs'),
(     'Senior Research Associate Jobs'),
(     'Senior Research Fellow Jobs'),
(     'Social Administration'),
(     'Social Policy'),
(     'Social Sciences and Social Care'),
(     'Sociology'),
(     'Software Engineering'),
(     'South East England'),
(     'South West England'),
(     'Sport and Leisure'),
(     'Sports Coaching'),
(     'Sports Management'),
(     'Sports Science'),
(     'Statistician Jobs'),
(     'Statistics'),
(     'Student Recruitment Jobs'),
(     'Student Support Jobs'),
(     'Teach English'),
(     'Teacher Training'),
(     'Teaching'),
(     'Teaching Fellow Jobs'),
(     'Technician Jobs'),
(     'TEFL'),
(     'TESL'),
(     'TESOL'),
(     'Theology'),
(     'Town Planning'),
(     'Travel'),
(     'TV'),
(     'University'),
(     'University Administration Jobs'),
(     'University Admissions Jobs'),
(     'University Jobs Abroad'),
(     'University Jobs Australia'),
(     'University Marketing Jobs'),
(     'University Teaching UK'),
(     'Veterinary Science'),
(     'Visiting Professor Jobs and Visiting Lecturer Jobs'),
(     'Wales'),
(     'Zoology');





























