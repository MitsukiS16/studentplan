DELETE FROM SCHOOL;
DELETE FROM USERS;
DELETE FROM ENROLLED;
DELETE FROM COURSE;
DELETE FROM SUBJECTSTUDENT;
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
    'school example',
    'address example',
    'websiteschool.com'
);


INSERT INTO USERS VALUES ( 
    1,
    1,
    1,
    1,
    'admin',
    'admin@gmail.com',
    '$2y$10$CmA8X7Dxwq6FFJbyLfdjNuVrQLtCyrmHkdeVZcf9pssozaCM3rdyK',
    'admin',
    'admin',
    'https://icons-for-free.com/iconfiles/png/512/man+person+profile+user+worker+icon-1320190557331309792.png',
    'admin',
    '2023-01-01'
);

INSERT INTO ENROLLED VALUES ( 
    1,
    1,
    1
);

INSERT INTO COURSE VALUES ( 
    1,
    'primaria',
    1
);

INSERT INTO SUBJECTSTUDENT VALUES ( 
    1,
    1,
    'matematica',
    30,
    4,
    TRUE
);

INSERT INTO COURSESUBJECT VALUES (
    1,
    1
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
    'sara'
);


INSERT INTO STUDENTREPORT VALUES ( 
    1,
    3,
    10,
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


