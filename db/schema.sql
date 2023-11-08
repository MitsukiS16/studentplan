CREATE TABLE IF NOT EXISTS SCHOOL (
    id_school INTEGER NOT NULL PRIMARY KEY,
    name_school VARCHAR(50) NOT NULL,
    address_school VARCHAR(50),
    website VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS USERS (
    id_user INTEGER NOT NULL PRIMARY KEY,
    id_school INTEGER,
    id_course INTEGER ,
    id_enrolled INTEGER ,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    pw_hash BINARY,
    first_name VARCHAR(30) ,
    last_name VARCHAR(30),
    picture BLOB,
    role_type TEXT CHECK(role_type IN ('student', 'teacher', 'admin')) NOT NULL DEFAULT 'student',
    created_at DATETIME DEFAULT (datetime('now')),
    FOREIGN KEY(id_school) REFERENCES SCHOOL(id_school),
    FOREIGN KEY(id_course) REFERENCES COURSE(id_course),
    FOREIGN KEY(id_enrolled) REFERENCES ENROLLED(id_enrolled)
);

CREATE TABLE IF NOT EXISTS ENROLLED (
    id_enrolled INTEGER NOT NULL PRIMARY KEY,
    year_enrolled YEAR NOT NULL,
    trimester_enrolled INT NOT NULL
);

CREATE TABLE IF NOT EXISTS COURSE (
    id_course INTEGER NOT NULL PRIMARY KEY,
    name_course VARCHAR(30),
    number_subject INT
);

CREATE TABLE IF NOT EXISTS SUBJECTSTUDENT (
    id_subject INTEGER NOT NULL PRIMARY KEY,
    id_teacher INTEGER NOT NULL,
    name_subject VARCHAR(30) NOT NULL,
    student_count INT,
    happiness INT,
    subject_status BOOLEAN NOT NULL DEFAULT 'TRUE',
    FOREIGN KEY(id_teacher) REFERENCES TEACHER(id_teacher)
);

CREATE TABLE IF NOT EXISTS COURSESUBJECT (
    id_course INTEGER NOT NULL,
    id_subject INTEGER NOT NULL,
    FOREIGN KEY(id_course) REFERENCES COURSE(id_course),
    FOREIGN KEY(id_subject) REFERENCES SUBJECTSTUDENT(id_subject),
    CONSTRAINT course_subject_pk PRIMARY KEY (id_course, id_subject)
);

CREATE TABLE IF NOT EXISTS EVALUATION (
    id_evaluation INTEGER NOT NULL PRIMARY KEY,
    name_evaluation VARCHAR(30) NOT NULL,
    type_evaluation TEXT CHECK(type_evaluation IN ('teste', 'qa', 'cidadania', 'apresentacao', 'relatorio', 'fichas', 'tpc', 'composição', 'trabalho', 'outro')) NOT NULL
);

CREATE TABLE IF NOT EXISTS SUBJECTEVALUATION (
    id_subject INTEGER NOT NULL,
    id_evaluation INTEGER NOT NULL,
    FOREIGN KEY(id_subject) REFERENCES SUBJECTSTUDENT(id_subject),
    FOREIGN KEY(id_evaluation) REFERENCES EVALUATION(id_evaluation),
    CONSTRAINT subject_evaluation_pk PRIMARY KEY (id_subject, id_evaluation)
);

CREATE TABLE IF NOT EXISTS GRADE (
    id_grade INTEGER NOT NULL PRIMARY KEY,
    score FLOAT,
    expected_score FLOAT
);

CREATE TABLE IF NOT EXISTS EVALUATIONGRADE (
    id_evaluation INTEGER NOT NULL,
    id_grade INTEGER NOT NULL,
    date_evaluation DATETIME,
    FOREIGN KEY(id_evaluation) REFERENCES EVALUATION(id_evaluation),
    FOREIGN KEY(id_grade) REFERENCES GRADE(id_grade),
    CONSTRAINT evalution_grade_pk PRIMARY KEY (id_evaluation, id_grade)
);


CREATE TABLE IF NOT EXISTS TEACHER (
    id_teacher INTEGER NOT NULL PRIMARY KEY,
    name_teacher VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS STUDENTREPORT (
    id_student_report INTEGER NOT NULL PRIMARY KEY,
    average_grade INT,
    class_rank INT,
    description_student_report TEXT,
    created_at DATETIME DEFAULT (datetime('now')),
    updated_at DATETIME DEFAULT (datetime('now'))
);

CREATE TABLE IF NOT EXISTS REPORTCARD (
    id_report_card INTEGER NOT NULL PRIMARY KEY,
    id_subject INTEGER NOT NULL,
    created_at DATETIME DEFAULT (datetime('now')),
    updated_at DATETIME DEFAULT (datetime('now')),
    description_report_card TEXT,
    FOREIGN KEY(id_subject) REFERENCES SUBJECTSTUDENT(id_subject)
);

CREATE TABLE IF NOT EXISTS STUDENTREPORTCARD (
    id_student_report INTEGER NOT NULL,
    id_report_card INTEGER NOT NULL,
    FOREIGN KEY(id_student_report) REFERENCES STUDENTREPORT(id_student_report),
    FOREIGN KEY(id_report_card) REFERENCES REPORTCARD(id_report_card),
    CONSTRAINT student_report_card_pk PRIMARY KEY (id_student_report, id_report_card)
);
