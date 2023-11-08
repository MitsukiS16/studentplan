DELETE FROM SCHOOL;
DELETE FROM USERS;
DELETE FROM ENROLLED;
DELETE FROM COURSE;
DELETE FROM SUBJECTS;
DELETE FROM COURSESUBJECT;
DELETE FROM EVALUATION;
DELETE FROM SUBJECTEVALUATION;
DELETE FROM GRADE ;
DELETE FROM EVALUATIONGRADE;
DELETE FROM TEACHER;
DELETE FROM REPORTCARD;
DELETE FROM REPORTCARDSUBJECTS;


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
    0,
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
    4,
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
INSERT INTO ENROLLED VALUES ( 
    4,
    2,
    1
);
INSERT INTO ENROLLED VALUES ( 
    5,
    2,
    2
);
INSERT INTO ENROLLED VALUES ( 
    6,
    2,
    3
);


INSERT INTO COURSE VALUES ( 
    1,
    'primeiro ciclo'
);
INSERT INTO COURSE VALUES ( 
    2,
    'segundo ciclo'
);
INSERT INTO COURSE VALUES ( 
    3,
    'terceiro ciclo'
);
INSERT INTO COURSE VALUES ( 
    4,
    'secundário'
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
INSERT INTO SUBJECTS VALUES ( 
    4,
    1,
    'educação física'
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
INSERT INTO COURSESUBJECT VALUES (
    1,
    4
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

INSERT INTO REPORTCARD VALUES ( 
    1,
    2,
    1,
    1,
    '2023-01-01 00:00:00',
    '2023-01-01 00:00:01',
    'report card of first year on primary school'
);

INSERT INTO REPORTCARD VALUES ( 
    2,
    2,
    1,
    1,
    '2023-01-01 00:00:00',
    '2023-01-01 00:00:01',
    'report card of second year on primary school'
);


INSERT INTO REPORTCARDSUBJECTS VALUES (
    1,
    1,
    FALSE
); 
INSERT INTO REPORTCARDSUBJECTS VALUES (
    1,
    2,
    FALSE
); 
INSERT INTO REPORTCARDSUBJECTS VALUES (
    1,
    3,
    FALSE
); 
INSERT INTO REPORTCARDSUBJECTS VALUES (
    1,
    4,
    FALSE
); 

INSERT INTO REPORTCARDSUBJECTS VALUES (
    2,
    1,
    TRUE
); 
INSERT INTO REPORTCARDSUBJECTS VALUES (
    2,
    2,
    TRUE
); 
INSERT INTO REPORTCARDSUBJECTS VALUES (
    2,
    3,
    TRUE
); 
INSERT INTO REPORTCARDSUBJECTS VALUES (
    2,
    4,
    TRUE
); 



