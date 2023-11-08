DELETE FROM SCHOOL;
DELETE FROM USERS;
DELETE FROM ENROLLED;
DELETE FROM COURSE;
DELETE FROM SUBJECTS;
DELETE FROM SUBJECTUSER;
DELETE FROM COURSESUBJECT;
DELETE FROM EVALUATION;
DELETE FROM SUBJECTEVALUATION;
DELETE FROM GRADE ;
DELETE FROM EVALUATIONGRADE;
DELETE FROM TEACHER;
DELETE FROM STUDENTREPORT;
DELETE FROM REPORTCARD;
DELETE FROM STUDENTREPORTCARD;


VACUUM;

INSERT INTO SCHOOL VALUES ( 
    1,
    'school1',
    'address example 1',
    'websiteschool1.pt'
);
INSERT INTO SCHOOL VALUES ( 
    2,
    'school2',
    'address example 1',
    'websiteschool2.pt'
);



INSERT INTO USERS VALUES ( 
    1,
    1,
    1,
    1,
    'admin',
    'admin@gmail.com',
    '$2y$10$Ye//Ghx8aDXJn0n171kcpeLSEmQjZOctTptE/gzFu8ZiO7WFWxYTq',
    'admin',
    'admin',
    'https://icons-for-free.com/iconfiles/png/512/man+person+profile+user+worker+icon-1320190557331309792.png',
    'admin',
    '2023-01-01'
);

INSERT INTO USERS VALUES ( 
    2,
    1,
    1,
    1,
    'sissi',
    'sissi@gmail.com',
    '$2y$10$Ye//Ghx8aDXJn0n171kcpeLSEmQjZOctTptE/gzFu8ZiO7WFWxYTq',
    'sissi',
    'sissi',
    'https://icons-for-free.com/iconfiles/png/512/man+person+profile+user+worker+icon-1320190557331309792.png',
    'student',
    '2023-01-01'
);

INSERT INTO ENROLLED VALUES ( 
    1,
    1,
    1
);
INSERT INTO ENROLLED VALUES ( 
    2,
    1,
    2
);
INSERT INTO ENROLLED VALUES ( 
    3,
    1,
    3
);

INSERT INTO COURSE VALUES ( 
    1,
    'primeiro ciclo',
    8
);
INSERT INTO COURSE VALUES ( 
    2,
    'segundo ciclo',
    8
);
INSERT INTO COURSE VALUES ( 
    3,
    'terceiro ciclo',
    8
);
INSERT INTO COURSE VALUES ( 
    4,
    'secundário',
    8
);

INSERT INTO SUBJECTS VALUES ( 
    1,
    1,
    'matematica'
);
INSERT INTO SUBJECTS VALUES ( 
    2,
    1,
    'portugues'
);
INSERT INTO SUBJECTS VALUES ( 
    3,
    1,
    'ingles'
);


INSERT INTO SUBJECTUSER VALUES (
    2,
    1,
    4,
    TRUE
);
INSERT INTO SUBJECTUSER VALUES (
    2,
    2,
    4,
    TRUE
);
INSERT INTO SUBJECTUSER VALUES (
    2,
    3,
    4,
    TRUE
);

INSERT INTO COURSESUBJECT VALUES (
    1,
    1
);
INSERT INTO COURSESUBJECT VALUES (
    1,
    2
);
INSERT INTO COURSESUBJECT VALUES (
    1,
    3
);

INSERT INTO EVALUATION VALUES ( 
    1,
    'testes 1 periodo',
    'teste'
);

INSERT INTO SUBJECTEVALUATION VALUES (
    1,
    1
);

INSERT INTO GRADE VALUES (
    1,
    1.1,
    2.5

);

INSERT INTO EVALUATIONGRADE VALUES (
    1,
    1,
    '2023-01-01 00:00:00'
);

INSERT INTO TEACHER VALUES ( 
    1,
    'adminteacher'
);
INSERT INTO TEACHER VALUES ( 
    2,
    'clarisse'
);
INSERT INTO TEACHER VALUES ( 
    3,
    'rui'
);


INSERT INTO STUDENTREPORT VALUES ( 
    1,
    'admin organizado',
    '2023-01-01 00:00:00',
    '2023-01-01 00:00:01'
);

INSERT INTO REPORTCARD VALUES ( 
    1,
    1,
    '2023-01-01 00:00:00',
    '2023-01-01 00:00:01',
    'report card admin'
);


INSERT INTO STUDENTREPORTCARD VALUES (
    1,
    1
); 


